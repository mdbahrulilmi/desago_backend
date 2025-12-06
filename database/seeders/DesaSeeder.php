<?php

namespace Database\Seeders;

use App\Models\AkunDesa;
use App\Models\ProfileDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $akunDesa = AkunDesa::create([
            'username' => 'desa_geblog',
            'password' => Hash::make('password'),
            'status' => '1',
        ]);

        ProfileDesa::create([
            'akun_desa_id' => $akunDesa->id,
            'nama_desa' => 'Geblog',
            'kode_desa' => '3323062001',
            'provinsi_id' => 33,
            'kabupaten_id' => 3323,
            'kecamatan_id' => 3323070,
            'alamat' => 'Jl. Raya Geblog, Kec. Kaloran, Kab. Temanggung',
            'email' => 'desageblog@example.com',
            'telepon' => '(0293) 123456',
            'website' => 'https://desageblog.example.com',
            'kepala_desa' => 'Budi Santoso',
            'visi' => 'Mewujudkan Desa Geblog yang Maju, Mandiri, dan Sejahtera',
            'misi' => '1. Meningkatkan kualitas sumber daya manusia\n2. Mengembangkan potensi ekonomi desa\n3. Meningkatkan infrastruktur desa\n4. Menjaga kelestarian lingkungan hidup',
            'logo' => 'path/to/logo.png',
        ]);
    }
}
