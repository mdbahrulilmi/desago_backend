<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BeritaDesa;
use App\Models\AgendaDesa;
use App\Models\CarouselDesa;

class KontenController extends Controller
{
    public function carousel($subdomain)
    {
        $data = CarouselDesa::where('subdomain', $subdomain)
        ->orderBy('no', 'asc')
        ->get();

        return response()->json($data);
    }
    public function berita($subdomain)
    {
        $data = BeritaDesa::where('subdomain', $subdomain)
            ->with('userDesa')
            ->latest('tgl')
            ->paginate(7)
            ->transform(function ($item) {
                $item->isi = $this->cleanHtml($item->isi);
                return $item;
            });
            
        return response()->json($data);
    }
    
    public function beritaCarousel($subdomain)
    {
        $data = BeritaDesa::where('subdomain', $subdomain)
            ->with('userDesa')
            ->latest('tgl')
            ->limit(5)
            ->get()
            ->transform(function ($item) {
                $item->isi = $this->cleanHtml($item->isi);
                return $item;
            });
            
        return response()->json($data);
    }
    
    private function cleanHtml(?string $html): string
    {
        if (!$html) {
            return '';
        }
    
        // Decode entity (&nbsp; dll)
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
        // NORMALISASI LINE BREAK
        $html = str_replace(["\r\n", "\r"], "\n", $html);
    
        // UBAH DIV JADI P (INI PENTING BANGET)
        $html = preg_replace('/<\s*div[^>]*>/i', '<p>', $html);
        $html = preg_replace('/<\/\s*div\s*>/i', '</p>', $html);
    
        // BUANG SPAN & FONT (ISI TETAP)
        $html = preg_replace('/<\s*(span|font)[^>]*>/i', '', $html);
        $html = preg_replace('/<\/\s*(span|font)\s*>/i', '', $html);
    
        // HAPUS SEMUA ATTRIBUTE
        $html = preg_replace('/<(\w+)[^>]*>/', '<$1>', $html);
    
        // HAPUS PARAGRAF KOSONG / DOUBLE
        $html = preg_replace('/<p>\s*(<br\s*\/?>)?\s*<\/p>/i', '', $html);
    
        // GABUNG P YANG KEPECAH
        $html = preg_replace('/<\/p>\s*<p>/', '</p><p>', $html);
    
        // WHITESPACE NORMALIZATION
        $html = preg_replace('/\s{2,}/u', ' ', $html);
    
        // WHITELIST TAG AMAN
        $html = strip_tags($html, '<p><br><b><strong><i><u><ul><ol><li>');
    
        return trim($html);
    }
    
    public function agenda($subdomain)
    {
        $data = AgendaDesa::where('subdomain', $subdomain)
            ->with('kategori')
            ->get();
            
        return response()->json($data);
    }

}
