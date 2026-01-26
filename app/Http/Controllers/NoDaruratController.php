<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NomorDarurat;

class NoDaruratController extends Controller
{
    public function index($subdomain){
     $data = NomorDarurat::where('subdomain', $subdomain)
     ->get();
        
    return response()->json($data);
    }
}
