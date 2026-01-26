<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapor;
use App\Models\LaporKategori;
use Illuminate\Support\Str;


class LaporController extends Controller
{
    public function index($subdomain){
        $data = Lapor::where('subdomain', $subdomain)
        ->with("kategori")
        ->paginate(10);
        
        return response()->json($data);
    }
    public function category($subdomain){
        $data = LaporKategori::all();
        
        return response()->json($data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'subdomain' => 'required|string|max:255',
            'ditujukan' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required',
            'description' => 'required|string',
            'image' => 'nullable|image|max:5120', // max 5MB
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = Str::uuid() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/lapor'), $imageName);
        }

        $lapor = Lapor::create([
            'subdomain' => $request->subdomain,
            'ditujukan' => $request->ditujukan,
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
            'status' => 'menunggu', 
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Laporan berhasil dibuat',
            'data' => $lapor
        ], 201);
    }
}
