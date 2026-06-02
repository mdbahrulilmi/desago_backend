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
        Schema::create('app_biodata_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('app_users')->onDelete('cascade');
            $table->foreignId('desa_id')->constrained('app_akun_desa')->onDelete('cascade');
            $table->string('nomor_kk', 16)->nullable();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->default('-');
            $table->string('agama', 50);
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->string('status_hubungan_dalam_keluarga');
            $table->string('cacat_fisik_mental')->nullable();
            $table->string('pendidikan_terakhir');
            $table->string('jenis_pekerjaan');

            // Informasi orang tua
            $table->string('nik_ibu', 16)->nullable();
            $table->string('nama_ibu_kandung');
            $table->string('nik_ayah', 16)->nullable();
            $table->string('nama_ayah');

            // Informasi alamat
            $table->text('alamat_sebelumnya')->nullable();
            $table->text('alamat_sekarang');

            // Informasi dokumen
            $table->boolean('memiliki_akta_kelahiran')->default(false);
            $table->string('nomor_akta_kelahiran')->nullable();
            $table->boolean('memiliki_akta_perkawinan')->default(false);
            $table->string('nomor_akta_perkawinan')->nullable();
            $table->date('tanggal_perkawinan')->nullable();
            $table->boolean('memiliki_akta_perceraian')->default(false);
            $table->string('nomor_akta_perceraian')->nullable();

            // Informasi biometrik
            $table->string('sidik_jari')->nullable();
            $table->string('iris_mata')->nullable();
            $table->string('tanda_tangan')->nullable();


            // Foto dokumen
            $table->string('foto_wajah')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();

            // Timestamps standar Laravel
            $table->timestamps();

            // Index untuk performa
            $table->index('nomor_kk');
            $table->index('nama_lengkap');
            $table->index('desa_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_biodata_user');
    }
};
