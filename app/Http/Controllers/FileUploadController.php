<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers;

class FileUploadController extends Controller
{
    
    public function upload(Request $request)
    {
      try {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $path = $request->file('file')->store('', 'public');

        $url = Storage::disk('public')->url($path);

        $filename = basename(parse_url($url, PHP_URL_PATH));

 
        return response()->json([
        'path' => $path, 
        'url' => env('public_ENDPOINT').'object/public/desago_bucket/'.$filename
        ], 201);
      } catch (\Exception $e) {
        return response()->json(['error' => 'File upload failed: ' . $e->getMessage()], 500);
      }
    }


    public function retrieve(Request $request)
    {
        $url = Storage::disk('public')->url($request->input('path'));
        return response()->json(['url' => $url], 200);
    }
}
