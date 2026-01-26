<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SambutanDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'sambutan';

    protected $primaryKey = 'no';
    public $timestamps = false;

    protected $guarded = [];
    
    public function kepalaDesa()
    {
        return $this->hasOne(
            KepalaDesa::class,
            'subdomain',
            'subdomain'
        );
    }
    
    public function informasiDesa()
    {
        return $this->belongsTo(
            InformasiDesa::class,
            'subdomain',
            'subdomain'
        );
    }
    
    public function perangkatDesa()
    {
        return $this->hasMany(
            Perangkat::class,
            'subdomain',
            'subdomain'
        );
    }

}

