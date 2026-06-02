<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataUser extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_biodata_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'desa_id',
        'nomor_kk',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'golongan_darah',
        'agama',
        'status_perkawinan',
        'status_hubungan_dalam_keluarga',
        'cacat_fisik_mental',
        'pendidikan_terakhir',
        'jenis_pekerjaan',
        'nik_ibu',
        'nama_ibu_kandung',
        'nik_ayah',
        'nama_ayah',
        'alamat_sebelumnya',
        'alamat_sekarang',
        'memiliki_akta_kelahiran',
        'nomor_akta_kelahiran',
        'memiliki_akta_perkawinan',
        'nomor_akta_perkawinan',
        'tanggal_perkawinan',
        'memiliki_akta_perceraian',
        'nomor_akta_perceraian',
        'sidik_jari',
        'iris_mata',
        'tanda_tangan',
        'foto_wajah',
        'foto_ktp',
        'foto_kk',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_perkawinan' => 'date',
        'memiliki_akta_kelahiran' => 'boolean',
        'memiliki_akta_perkawinan' => 'boolean',
        'memiliki_akta_perceraian' => 'boolean',
    ];

    /**
     * Get the user that owns the biodata.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the desa that owns the biodata.
     */
    public function desa()
    {
        return $this->belongsTo(AkunDesa::class, 'desa_id');
    }

    /**
     * Get the desa profile associated with this biodata.
     */
    public function profilDesa()
    {
        return $this->hasOneThrough(
            ProfileDesa::class,
            AkunDesa::class,
            'id', // Foreign key on AkunDesa table
            'akun_desa_id', // Foreign key on ProfilDesa table
            'desa_id', // Local key on BiodataUser table
            'id' // Local key on AkunDesa table
        );
    }
}
