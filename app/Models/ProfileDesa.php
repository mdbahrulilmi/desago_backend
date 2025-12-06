<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDesa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'app_profil_desa';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'akun_desa_id',
        'nama_desa',
        'kode_desa',
        'id_provinsi',
        'id_kabupaten',
        'id_kecamatan',
        'alamat',
        'email',
        'telepon',
        'website',
        'kepala_desa',
        'visi',
        'misi',
        'logo',
    ];

    /**
     * Get the akun desa that owns the profil desa.
     */
    public function akunDesa()
    {
        return $this->belongsTo(AkunDesa::class, 'akun_desa_id');
    }

    /**
     * Get the provinsi that owns the desa.
     */
    // Relasi ke Provinsi
    public function provinsi()
    {
        return $this->belongsTo(Province::class, 'provinsi_id', 'id');
    }

    // Relasi ke Kabupaten
    public function kabupaten()
    {
        return $this->belongsTo(Regency::class, 'kabupaten_id', 'id');
    }

    // Relasi ke Kecamatan
    public function kecamatan()
    {
        return $this->belongsTo(District::class, 'kecamatan_id', 'id');
    }
}
