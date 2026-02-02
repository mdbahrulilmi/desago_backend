<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSurat;
use App\Models\Surat;

class SuratController extends Controller
{
    public function index(){
        $data = JenisSurat::all();
        return response()->json($data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat_id' => 'required|integer',
            'data_form' => 'required|array',
            'file_surat' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_surat')) {
            $filePath = $request->file('file_surat')->store('surat', 'public');
        }

        $pengajuan = Surat::create([
            'jenis_surat_id' => $request->jenis_surat_id,
            'subdomain' => $request->subdomain,
            'data_form' => $request->data_form,
            'status' => 'verifikasi',
            'catatan_admin' => null,
            'file_surat' => $filePath,
            'created_by' => $request->created_by,
            'updated_by' => null,
        ]);

        return response()->json([
            'message' => 'Surat berhasil diajukan',
            'data' => $pengajuan
        ], 201);
    }

    public function riwayat($id)
    {
        $pengajuan = Surat::with(['jenisSurat'])->latest()->get();
        return response()->json($pengajuan);
    }

    public function show($id)
    {
        $pengajuan = PengajuanSurat::with(['jenisSurat', 'creator'])->findOrFail($id);
        return response()->json($pengajuan);
    }
}
