<?php

namespace App\Http\Controllers;

use App\Models\User;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
// resize
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProfileController extends Controller
{
    //
    public function edit_profile(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'phone' => 'required|max:13',
            ]);
        
            $user = auth()->user(); // ambil user login
        
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }
        
            // otomatis ubah ke +62 kalau nomor mulai dengan 0
            $phone = $request->phone;
            if (substr($phone, 0, 1) === '0') {
                $phone = '+62' . substr($phone, 1);
            }
        
            // cek username unik
            if ($request->username !== $user->username) {
                $cekUsername = User::where('username', $request->username)
                    ->where('id', '!=', $user->id)
                    ->exists();
        
                if ($cekUsername) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Username telah digunakan'
                    ], 422);
                }
            }
        
            // cek phone unik
            if ($phone !== $user->phone) {
                $cekPhone = User::where('phone', $phone)
                    ->where('id', '!=', $user->id)
                    ->exists();
        
                if ($cekPhone) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nomor HP telah digunakan'
                    ], 422);
                }
            }
        
            // update user
            $user->update([
                'email' => $request->email,
                'phone' => $phone,
            ]);
        
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mengubah profil',
                'data' => $user
            ], 200);
        
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    public function updateAvatar(Request $request)
    {
        try {
            // 1. Validasi file
            Validator::make($request->all(), [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024', // max 1MB
            ])->validate();
    
            // 2. Auth check
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            // 3. Ambil file avatar
            $file = $request->file('avatar');
    
            // 4. Buat nama file unik
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
    
            // 5. Simpan di folder public/avatar
            $file->move(public_path('avatar'), $filename);
    
            $finalPath = 'avatar/' . $filename;
    
            // 6. Hapus avatar lama kalau ada
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
    
            // 7. Update user
            $user->avatar = $finalPath;
            $user->save();
    
            // 8. Update social account kalau ada
            if (method_exists($user, 'socialAccounts')) {
                $socialAccounts = $user->socialAccounts;
                if ($socialAccounts) {
                    $user->socialAccounts()->update([
                        'avatar' => $finalPath
                    ]);
                }
            }
    
            // 9. Response
            return response()->json([
                'status' => true,
                'message' => 'Berhasil mengubah avatar',
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'avatar' => $finalPath,
                    'email_verified_at' => $user->email_verified_at,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                ]
            ], 200);
    
        } catch (\Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah avatar',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
}
