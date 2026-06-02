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
        Schema::table('app_biodata_user', function (Blueprint $table) {
            // Kolom yang tetap wajib diisi
            $table->bigIncrements('id')->change();
            $table->unsignedBigInteger('user_id')->change();
            $table->unsignedBigInteger('desa_id')->change();
            $table->string('nik', 16)->change();
            $table->string('nomor_kk', 16)->nullable(false)->change(); // KK (nomor_kk) wajib diisi
            $table->string('foto_wajah', 255)->nullable(false)->change();
            $table->string('foto_ktp', 255)->nullable(false)->change();
            $table->string('foto_kk', 255)->nullable(false)->change();

            // Kolom yang diubah menjadi nullable
            $table->string('nama_lengkap', 255)->nullable()->change();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable()->change();
            $table->string('tempat_lahir', 255)->nullable()->change();
            $table->date('tanggal_lahir')->nullable()->change();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->nullable()->change();
            $table->string('agama', 50)->nullable()->change();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->nullable()->change();
            $table->string('status_hubungan_dalam_keluarga', 255)->nullable()->change();
            $table->string('cacat_fisik_mental', 255)->nullable()->change();
            $table->string('pendidikan_terakhir', 255)->nullable()->change();
            $table->string('jenis_pekerjaan', 255)->nullable()->change();
            $table->string('nik_ibu', 16)->nullable()->change();
            $table->string('nama_ibu_kandung', 255)->nullable()->change();
            $table->string('nik_ayah', 16)->nullable()->change();
            $table->string('nama_ayah', 255)->nullable()->change();
            $table->text('alamat_sebelumnya')->nullable()->change();
            $table->text('alamat_sekarang')->nullable()->change();
            $table->tinyInteger('memiliki_akta_kelahiran')->nullable()->change();
            $table->string('nomor_akta_kelahiran', 255)->nullable()->change();
            $table->tinyInteger('memiliki_akta_perkawinan')->nullable()->change();
            $table->string('nomor_akta_perkawinan', 255)->nullable()->change();
            $table->date('tanggal_perkawinan')->nullable()->change();
            $table->tinyInteger('memiliki_akta_perceraian')->nullable()->change();
            $table->string('nomor_akta_perceraian', 255)->nullable()->change();
            $table->string('sidik_jari', 255)->nullable()->change();
            $table->string('iris_mata', 255)->nullable()->change();
            $table->string('tanda_tangan', 255)->nullable()->change();
            $table->timestamp('created_at')->nullable()->change();
            $table->timestamp('updated_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_biodata_user', function (Blueprint $table) {
            // Mengembalikan kolom ke kondisi semula (opsional, sesuai kebutuhan)
            $table->string('nama_lengkap', 255)->nullable(false)->change();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable(false)->change();
            $table->string('tempat_lahir', 255)->nullable(false)->change();
            $table->date('tanggal_lahir')->nullable(false)->change();
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O', '-'])->nullable(false)->change();
            $table->string('agama', 50)->nullable(false)->change();
            $table->enum('status_perkawinan', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'])->nullable(false)->change();
            $table->string('status_hubungan_dalam_keluarga', 255)->nullable(false)->change();
            $table->string('cacat_fisik_mental', 255)->nullable(false)->change();
            $table->string('pendidikan_terakhir', 255)->nullable(false)->change();
            $table->string('jenis_pekerjaan', 255)->nullable(false)->change();
            $table->string('nama_ibu_kandung', 255)->nullable(false)->change();
            $table->string('nama_ayah', 255)->nullable(false)->change();
            $table->text('alamat_sekarang')->nullable(false)->change();
            $table->tinyInteger('memiliki_akta_kelahiran')->nullable(false)->change();
            $table->tinyInteger('memiliki_akta_perkawinan')->nullable(false)->change();
            $table->tinyInteger('memiliki_akta_perceraian')->nullable(false)->change();
        });
    }
};
