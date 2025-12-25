<?php

namespace App\Http\Controllers;

use App\Models\AkunDesa;
use App\Models\ProfileDesa;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DesaController extends Controller
{
    /**
     * Mendapatkan daftar semua desa beserta profilnya
     */
    public function getAllDataDesa()
    {
        try {
            $desa = AkunDesa::with(['profilDesa.provinsi', 'profilDesa.kabupaten', 'profilDesa.kecamatan'])
                ->where('status', '1')
                ->get();
    
            return response()->json([
                'success' => true,
                'message' => 'Daftar desa berhasil dimuat',
                'data' => $desa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar desa: ' . $e->getMessage()
            ], 500);
        }
    }

     /**
     * Mendapatkan detail desa berdasarkan ID
     */
    public function show($id)
    {
        try {
            $desa = AkunDesa::with(['profil', 'profil.provinsi', 'profil.kabupaten', 'profil.kecamatan'])
                ->where('id', $id)
                ->where('status', '1')
                ->first();

            if (!$desa) {
                return response()->json([
                    'success' => false,
                    'message' => 'Desa tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Detail desa berhasil dimuat',
                'data' => $desa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat detail desa: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mencari desa berdasarkan nama desa atau kabupaten/kota
     */
    public function search(Request $request)
    {
        try {
            $keyword = $request->keyword;

            $desa = AkunDesa::with(['profil', 'profil.provinsi', 'profil.kabupaten', 'profil.kecamatan'])
                ->where('status', '1')
                ->whereHas('profil', function ($query) use ($keyword) {
                    $query->where('nama_desa', 'like', "%{$keyword}%")
                        ->orWhereHas('kabupaten', function ($q) use ($keyword) {
                            $q->where('name', 'like', "%{$keyword}%");
                        })
                        ->orWhereHas('kecamatan', function ($q) use ($keyword) {
                            $q->where('name', 'like', "%{$keyword}%");
                        });
                })
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Pencarian desa berhasil',
                'data' => $desa
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mencari desa: ' . $e->getMessage()
            ], 500);
        }
    }
    /**
     * Memunculkan Profil Desa
     */
    
    //  Public function profilDesa($id): JsonResponse
    //  {
    //      try {
    //          $desa = AkunDesa::with('profilDesa')->where('id', $id)->first();
 
    //          if (!$desa) {
    //              return response()->json([
    //                  'success' => false,
    //                  'message' => 'Desa tidak ditemukan'
    //              ], 404);
    //          }
 
    //          return response()->json([
    //              'success' => true,
    //              'message' => 'Profil desa berhasil dimuat',
    //              'data' => $desa->profilDesa
    //          ]);
    //      } catch (\Exception $e) {
    //          Log::error('Error fetching desa profile: ' . $e->getMessage());
    //          return response()->json([
    //              'success' => false,
    //              'message' => 'Gagal memuat profil desa'
    //          ], 500);
    //      }
    //  }
}
