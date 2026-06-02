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
                'username' => 'required|string|max:50',
            ]);

            $user = auth()->user(); // ⬅️ WAJIB

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
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
            if ($request->phone !== $user->phone) {
                $cekPhone = User::where('phone', $request->phone)
                    ->where('id', '!=', $user->id)
                    ->exists();

                if ($cekPhone) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Nomor HP telah digunakan'
                    ], 422);
                }
            }

            // update
            $user->update([
                'email' => $request->email,
                'phone' => $request->phone,
                'username' => $request->username,
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
            // 1. Fail fast: validasi ringan
            Validator::make($request->all(), [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,webp|max:1024', // 1MB
            ])->validate();
    
            // 2. Auth check
            $user = $request->user();
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized'
                ], 401);
            }
    
            // 3. Resize & kompres gambar (hemat bandwidth)
            $manager = new ImageManager(new Driver());
    
            $image = $manager
                ->read($request->file('avatar'))
                ->cover(256, 256)     // ukuran lebih kecil
                ->toWebp(60);         // kompres lebih agresif
    
            // 4. Path final
            $finalPath = 'avatar/avatar_' . $user->id . '_' . time() . '.webp';
    
            // 5. Upload langsung ke Supabase (tanpa tmp file)
            Storage::disk('supabase')->put(
                $finalPath,
                (string) $image,
                'public'
            );
    
            // 6. Hapus avatar lama SETELAH upload sukses
            if ($user->avatar && Storage::disk('supabase')->exists($user->avatar)) {
                Storage::disk('supabase')->delete($user->avatar);
            }

            // 7. Update user
            $user->avatar = $finalPath;
            $user->save();
                if (method_exists($user, 'socialAccounts')) {
                $socialAccounts = $user->socialAccounts;
                if ($socialAccounts) {
                    $user->socialAccounts()->update([
                        'avatar' => $finalPath
                    ]);
                }
            }
            // 8. Response
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
