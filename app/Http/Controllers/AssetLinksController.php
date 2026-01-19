<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetLinksController extends Controller
{
    public function show()
    {
        $jsonContent = json_encode([
            [
                "relation" => ["delegate_permission/common.handle_all_urls"],
                "target" => [
                    "namespace" => "android_app",
                    "package_name" => "com.example.desago",
                    "sha256_cert_fingerprints" => ["6D:37:9B:0A:D6:95:CC:81:47:EB:AB:A1:33:36:4E:FC:91:7D:76:FA:AF:E1:2B:5B:12:76:72:A1:39:9F:BA:FA"]
                ]
            ]
        ]);

        return response($jsonContent, 200)
            ->header('Content-Type', 'application/json');
    }
}

