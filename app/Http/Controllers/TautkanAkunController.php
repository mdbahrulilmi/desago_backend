<?php

namespace App\Http\Controllers;

use App\Models\BiodataUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TautkanAkunController extends Controller
{
    public function tautkanAkunUserKeDesa(Request $request)
    {
        // Validasi input untuk kolom wajib
        $validator = Validator::make($request->all(), [
            'desa_id' => 'required|exists:app_akun_desa,id',
            'nik' => 'required|string|max:16',
            'nomor_kk' => 'required|string|max:16',
            'foto_wajah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = Auth::user();

            $biodata = BiodataUser::where('user_id', $user->id)->first();
            $isCreate = !$biodata;

            if (!$biodata) {
                $biodata = new BiodataUser();
                $biodata->user_id = $user->id;
            }

            if ($request->hasFile('foto_wajah')) {
                if ($biodata->foto_wajah) {
                    Storage::disk('public')->delete($biodata->foto_wajah);
                }
                $biodata->foto_wajah = $request->file('foto_wajah')->store('biodata/' . $user->id . '/wajah', 'public');
            }

            if ($request->hasFile('foto_ktp')) {
                if ($biodata->foto_ktp) {
                    Storage::disk('public')->delete($biodata->foto_ktp);
                }
                $biodata->foto_ktp = $request->file('foto_ktp')->store('biodata/' . $user->id . '/ktp', 'public');
            }


            if ($request->hasFile('foto_kk')) {
                if ($biodata->foto_kk) {
                    Storage::disk('public')->delete($biodata->foto_kk);
                }
                $biodata->foto_kk = $request->file('foto_kk')->store('biodata/' . $user->id . '/kk', 'public');
            }


            $biodata->desa_id = $request->desa_id;
            $biodata->nik = $request->nik;
            $biodata->nomor_kk = $request->nomor_kk;

            $biodata->nama_lengkap = $request->nama_lengkap ?? null;
            $biodata->jenis_kelamin = $request->jenis_kelamin ?? null;
            $biodata->tempat_lahir = $request->tempat_lahir ?? null;
            $biodata->tanggal_lahir = $request->tanggal_lahir ?? null;
            $biodata->golongan_darah = $request->golongan_darah ?? null;
            $biodata->agama = $request->agama ?? null;
            $biodata->status_perkawinan = $request->status_perkawinan ?? null;
            $biodata->status_hubungan_dalam_keluarga = $request->status_hubungan_dalam_keluarga ?? null;
            $biodata->cacat_fisik_mental = $request->cacat_fisik_mental ?? null;
            $biodata->pendidikan_terakhir = $request->pendidikan_terakhir ?? null;
            $biodata->jenis_pekerjaan = $request->jenis_pekerjaan ?? null;
            $biodata->nik_ibu = $request->nik_ibu ?? null;
            $biodata->nama_ibu_kandung = $request->nama_ibu_kandung ?? null;
            $biodata->nik_ayah = $request->nik_ayah ?? null;
            $biodata->nama_ayah = $request->nama_ayah ?? null;
            $biodata->alamat_sebelumnya = $request->alamat_sebelumnya ?? null;
            $biodata->alamat_sekarang = $request->alamat_sekarang ?? null;
            $biodata->memiliki_akta_kelahiran = $request->memiliki_akta_kelahiran ?? null;
            $biodata->nomor_akta_kelahiran = $request->nomor_akta_kelahiran ?? null;
            $biodata->memiliki_akta_perkawinan = $request->memiliki_akta_perkawinan ?? null;
            $biodata->nomor_akta_perkawinan = $request->nomor_akta_perkawinan ?? null;
            $biodata->tanggal_perkawinan = $request->tanggal_perkawinan ?? null;
            $biodata->memiliki_akta_perceraian = $request->memiliki_akta_perceraian ?? null;
            $biodata->nomor_akta_perceraian = $request->nomor_akta_perceraian ?? null;
            $biodata->save();


            $biodata->load(['desa.profilDesa.provinsi', 'desa.profilDesa.kabupaten', 'desa.profilDesa.kecamatan']);

            return response()->json([
                'success' => true,
                'message' => $isCreate ? 'Biodata berhasil dibuat dan terhubung dengan desa' : 'Biodata berhasil diperbarui',
                'data' => $biodata
            ], $isCreate ? 201 : 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan biodata: ' . $e->getMessage()
            ], 500);
        }
    }
}
