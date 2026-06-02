<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('app_profil_desa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('akun_desa_id')->constrained('app_akun_desa')->onDelete('cascade')->unique();
            $table->string('nama_desa', 200);
            $table->string('kode_desa', 50);
            
            // Menyesuaikan tipe data dengan tabel provinces, regencies, dan districts
            $table->char('provinsi_id', 2);
            $table->foreign('provinsi_id')->references('id')->on('provinces')->onDelete('restrict');
            
            $table->char('kabupaten_id', 4);
            $table->foreign('kabupaten_id')->references('id')->on('regencies')->onDelete('restrict');
            
            $table->char('kecamatan_id', 7);
            $table->foreign('kecamatan_id')->references('id')->on('districts')->onDelete('restrict');
            
            $table->text('alamat')->nullable();
            $table->string('email', 100)->nullable();
            $table->string('telepon', 50)->nullable();
            $table->string('website', 255)->nullable();
            $table->string('kepala_desa', 200)->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->string('logo', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_profile_desa');
    }
};
