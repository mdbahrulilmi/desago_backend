<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AkunDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;



class AuthControllerWeb extends Controller
{
    public function login(Request $request)
    {
        try {
            $user = $request->validate([
                'username' => "required",
                'password' => "required",
            ]);

            $user = AkunDesa::where("username", '=', $request->username)->first();
            
            if (!$user) {
                return response()->json([
                    "success" => false,
                    'message' => "username tidak tersedia"
                ], 422);
            }

            if (! Hash::check($request->password, $user->password)) {
                return response()->json([
                    "success" => false,
                    'message' => "password salah"
                ], 422);
            }
            // delete token jika ada device lain
            // $user->tokens()->delete();
            $remember_token = $user->createToken('auth_token')->plainTextToken;
            $user->update(['remember_token' =>$remember_token]);
            // dd( $user->update(['last_login' => $last_login]));
            return response()->json([
                "success" => true,
                "message" => "Login Berhasil",
                "user" => $user,
                "remember_token" => $remember_token
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
            // dd($request->all());
            $request->validate([
                'username' => "required|max:255",
                'password' => "required",
                'password_confirmation'=> "required",
            ]);

            // $email = AkunDesa::where('email', '=', $request->email)->first();
            $username = AkunDesa::where('username', '=', $request->username)->first();

            // if ($email) {
            //     return response()->json([
            //         "success" => false,
            //         'message' => "email tersedia"
            //     ], 422);
            // }
            if ($username) {
                return response()->json([
                    "success" => false,
                    'message' => "username tersedia"
                ], 422);
            }
            if ($request->password_confirmation == $request->password) {
                AkunDesa::create([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'email_verified_at'=>Carbon::now(),
                    
                ]);


                return response()->json([
                    "success" => true,
                    'message' => "Selamat datang! Silakan login.",
                ], 200);


            } 
            else {
    
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
            // dd($registerData);
            $insert = AkunDesa::create([
                'username' => $registerData['username'],
                'password' => $registerData['password'],
            ]);
            if ($insert) {
                Cache::forget('register_' . $token);
                $token = $insert->createToken('auth_token')->plainTextToken;
            // Simpan token ke kolom remember_token
             $insert->update(['remember_token' => $token]);
                //  return view('notifEmail')->with(['success' => true]);
                return response()->json([
                    "success" => true,
                    'message' => "Registrasi berhasil",
                    'user' => $insert,
                    'token' => $token,
                    'remember_token' => $token
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                "success" => false,
                'message' => $th->getMessage()
            ], 422);
        }
    }
}
