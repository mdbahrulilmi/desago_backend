<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UMKM;

class UMKMController extends Controller
{
    public function index($subdomain){
     $data = UMKM::where('subdomain', $subdomain)
        ->with("kategori")
        ->paginate(10);
        
    return response()->json($data);
    }
    
    public function carousel($subdomain){
     $data = UMKM::where('subdomain', $subdomain)
        ->with("kategori")
        ->limit(5)
        ->get();
        
    return response()->json($data);
    }
}
