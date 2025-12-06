<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\socialMedia;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'username' => "required|max:255",
                'password' => "required",
            ]);

            $user = User::where("username", '=', $request->username)->first();
            if (!$user) {
                return response()->json([
                    "success" => false,
                    'message' => "username tidak tersedia"
                ], 422);
            }
            if ($user->email_verified_at == null) {
                return response()->json([
                    "success" => false,
                    'message' => "Email belum terverifikasi"
                ], 422);
            }

            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    "success" => false,
                    'message' => "password salah !"
                ], 422);
            }
            $user->tokens()->delete();


            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "success" => true,
                "message" => "Login Berhasil",
                "user" => $user,
                "token" => $token,
            ], 200);
        } catch (\Exception $e) {
            //throw $th;
            return response()->json([
                "message" => $e->getMessage()
            ], 422);
        }
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => "required|max:255",
                'username' => "required|max:255",
                'phone' => "required|max:13",
                'email' => "required|email",
                'password' => "required",
                'password_confirmation' => "required",
            ]);

            $user = User::where('email', '=', $request->email)->first();
            $phone = User::where('phone', '=', $request->phone)->first();
            $username = User::where('username', '=', $request->username)->first();

            if ($user) {
                return response()->json([
                    "success" => false,
                    'message' => "email tersedia"
                ], 422);
            }
            if ($phone) {
                return response()->json([
                    "success" => false,
                    'message' => "No hp tersedia"
                ], 422);
            }
            if ($phone) {
                return response()->json([
                    "success" => false,
                    'message' => "No hp tersedia"
                ]);
            }
            if ($username) {
                return response()->json([
                    "success" => false,
                    'message' => "username tersedia"
                ], 422);
            }

            if ($request->password_confirmation == $request->password) {

                // ngirim link email
                // Buat token verifikasi
                $verificationToken = Str::random(60);

                // Simpan token verifikasi di session sementara
                Cache::put('register_' . $verificationToken, [
                    'name' => $request->name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                ], now()->addMinutes(15));

                // Buat URL verifikasi
                $verificationUrl = route('insertRegister', ['token' => $verificationToken]);

                // Kirim email verifikasi
                Mail::to($request->email)->send(new VerifyEmail($verificationUrl));

                return response()->json([
                    "success" => true,
                    'message' => "Silakan cek email untuk verifikasi",
                    'data' => [
                        'user' => $request->all(),
                        'token' => $verificationToken
                    ]
                ], 200);
            } else {
                return response()->json([
                    "success" => false,
                    'message' => "password tidak sesuai"
                ], 422);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "message" => $th->getMessage()
            ], 422);
        }
    }

    public function insertRegister(Request $request)
    {
        try {
            $token = $request->token;
            $registerData = Cache::get('register_' . $token);
            //dd($registerData);
            $insert = User::create([
                'name' => $registerData['name'],
                'username' => $registerData['username'],
                'email' => $registerData['email'],
                'phone' => $registerData['phone'],
                'password' => $registerData['password'],
                'email_verified_at' => Carbon::now(),
            ]);
            if ($insert) {
                Cache::forget('register_' . $token);
                $token = $insert->createToken('auth_token')->plainTextToken;
                return view('notifEmail')->with(['success' => true]);
            }
            return view('notifEmail')->with(['success' => false]);
        } catch (\Throwable $th) {
            return view('notifEmail')->with([
                "success" => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:app_users,email',
        ]);

        // Ambil user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Buat token reset password
        $status = Password::createToken($user);

        // Kirim email dengan notifikasi kustom
        $user->notify(new ResetPasswordNotification($status));

        return response()->json([
            'success' => true,
            'message' => 'Email reset password telah dikirim.',
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        try {
            //dd($request->all());
            $request->validate([
                '_token' => 'required',
                'email' => 'nullable|email|exists:app_users,email',
                'phone' => 'nullable|exists:app_users,phone|numeric',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]);
            //dd(7);

            if ($request->password !== $request->password_confirmation) {
                return redirect()->back()->with('error', 'Password tidak sesuai');
            }
            $status = Password::reset(
                $request->only('email', 'phone', 'password', 'password_confirmation', 'token'),
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password),
                        'remember_token' => Str::random(60),
                    ])->save();
                    event(new PasswordReset($user));
                }
            );


            if ($status === Password::PASSWORD_RESET) {
                return redirect()->back()->with('success', 'Password berhasil direset.');
            }
            return redirect()->back()->with('error', 'Gagal mereset password. Silakan coba lagi.');
        } catch (\Throwable $th) {
            //return response()->json([
            //    "message" => $th->getMessage()
            //]);
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function googleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'google_id' => 'required',
            'access_token' => 'required',
            'avatar' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $socialAccount = socialMedia::where('provider', 'google')
                ->where('provider_id', $request->google_id)
                ->first();

            if ($socialAccount) {
                $user = $socialAccount->user;
            } else {
                $user = User::where('email', $request->email)->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $request->name,
                        'username' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'password' => bcrypt(Str::random(16)),
                        'email_verified_at' => Carbon::now(),
                    ]);
                }

                // Buat social account baru
                $user->socialAccounts()->create([
                    'provider' => 'google',
                    'provider_id' => $request->google_id,
                    'avatar' => $request->avatar,
                    'user_id' => $user->id
                ]);
            }

            // Update token social account
            if ($socialAccount) {
                $socialAccount->update([
                    'avatar' => $request->avatar
                ]);
            }

            // Generate token untuk API
            $token = $user->createToken('auth_token')->plainTextToken;

            DB::commit();

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user->load('socialAccounts')
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error during login',
                'error' => $e->getMessage()
            ], 422);
        }
    }



    public function sendMessage(Request $request)
    {
        try {
            // Validasi input
            $validator = Validator::make($request->all(), [
                'phone' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }


            // Ambil user berdasarkan nomor telepon
            $user = User::where('phone', $request->phone)->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => "Nomor telepon tidak terdaftar"
                ], 422);
            }
            // Buat token reset password
            $token = Password::createToken($user);

            $resetUrl = url('/reset-password/' . $token . '?phone=' . $user->phone . '&email=' . $user->email);


            // Konfigurasi UltraMsg
            $instance_id = "instance106886";
            $api_token = "ozdwzvsr9k7urh4u";
            $phone = $request->phone;
            $message = "$resetUrl \n\nGunakan link diatas untuk reset password \nLink akan kadaluarsa selama 60 menit.";

            // Kirim pesan dengan UltraMsg
            $client = new Client();
            $response = $client->post("https://api.ultramsg.com/$instance_id/messages/chat", [
                'form_params' => [
                    'token' => $api_token,
                    'to' => $phone,
                    'body' => $message,
                ],
            ]);

            $body = json_decode($response->getBody()->getContents(), true);

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim',
                'response' => $body
            ], 200);
        } catch (RequestException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan',
                'error' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan',
                'error' => $e->getMessage()
            ], 422);
        }
    }
}
