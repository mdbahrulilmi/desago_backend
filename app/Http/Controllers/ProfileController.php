<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //
    public function edit_profile(Request $request)
    {
        try {
            $request->validate([
                'name' => "required|max:255",
                'username' => "required|max:255",
                'phone' => "required|max:13",
                'email' => "required|email",
            ]);
            $user = User::where("email", '=', $request->email)->first();
            //dd($request->email);

            if ($user->username != $request->username) {
                $cekUser = User::where("username", '=', $request->username)->where("id", '!=', $user->id)->first();
                if ($cekUser) {
                    return response()->json([
                        "success" => false,
                        "message" => "Username telah digunakan"
                    ], 442);
                }
            }
            if ($user->phone != $request->phone) {
                $cekUser = User::where("phone", '=', $request->phone)->where("id", '!=', $user->id)->first();
                if ($cekUser) {
                    return response()->json([
                        "success" => false,
                        "message" => "Nomor HP telah digunakan"
                    ], 442);
                }
            }

            // email tidak diupdate karna email udah pasti sama ( di front end di disable edit email )
            $updateUser = DB::table('app_users')->where("id", '=', $user->id)->update([
                "name" => $request->name,
                "phone" => $request->phone,
                "username" => $request->username,
            ]);

            if ($updateUser) {
                return response()->json([
                    "success" => true,
                    "message" => "Berhasil mengubah profile",
                    'data' => $request->all()
                ], 201);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "Gagal mengubah profile",
                ], 442);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }
    }

    public function updateAvatar(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User tidak terautentikasi'
                ], 401);
            }

            if ($request->hasFile('avatar')) {
                $path = 'avatars/' . $user->id;
                $fileName = 'avatar_' . time() . '.' . $request->file('avatar')->getClientOriginalExtension();
                $avatarPath = $request->file('avatar')->storeAs($path, $fileName, 'public');
                $avatarUrl = Storage::url($avatarPath);

                // Hapus avatar lama jika ada
                if ($user->avatar) {
                    $oldAvatarPath = str_replace(Storage::url(''), '', $user->avatar);
                    if (Storage::disk('public')->exists($oldAvatarPath)) {
                        Storage::disk('public')->delete($oldAvatarPath);
                    }
                }
                
                $user->avatar = $avatarUrl;
                $user->save();
                $responseData = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'avatar' => $avatarUrl,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at
                ];

                // Jika model user memiliki relasi dengan socialAccounts
                if (method_exists($user, 'socialAccounts')) {
                    $socialAccounts = $user->socialAccounts;
                    if ($socialAccounts) {
                        $responseData['social_accounts'] = $socialAccounts;
                    }
                }

                return response()->json([
                    'status' => true,
                    'message' => 'Avatar berhasil diperbarui',
                    'data' => $responseData
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Tidak ada file yang diunggah'
            ], 400);
        } catch (\Exception $e) {
            \Log::error('Error updating avatar: ' . $e->getMessage());
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat memperbarui avatar',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
