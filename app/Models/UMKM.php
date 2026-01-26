<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UMKM extends Model
{
    protected $connection = 'desa';
    protected $table = 'umkm';
    protected $appends = ['notelp_fix'];

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
    
    public function kategori(){
        return $this->belongsTo(
            UMKMKategori::class,
            'category',
            'id'
        )->select('id', 'name');
    }

    public function getNotelpFixAttribute()
    {
        $notelp = $this->attributes['notelp'] ?? null;

        if (!$notelp) return null;

        if (str_starts_with($notelp, '0')) {
            return '+62' . substr($notelp, 1);
        }

        return $notelp;
    }
}
