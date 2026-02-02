<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $connection = 'desa';
    protected $table = 'surat';
    public $timestamps = true;

    protected $fillable = [
        'jenis_surat_id',
        'subdomain',
        'data_form',
        'status',
        'catatan_admin',
        'file_surat',
        'created_by',
        'updated_by',
    ];

    // Cast data_form jadi array otomatis
    protected $casts = [
        'data_form' => 'array',
    ];

    // Relasi ke jenis surat (optional)
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'jenis_surat_id');
    }

    // // Relasi ke user yang buat
    // public function creator()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }

    // // Relasi ke user yang update
    // public function updater()
    // {
    //     return $this->belongsTo(User::class, 'updated_by');
    // }
}
