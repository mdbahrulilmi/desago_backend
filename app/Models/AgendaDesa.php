<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'agenda';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
    
    public function kategori(){
        return $this->belongsTo(
            AgendaDesaKategori::class,
            'kategori',
            'id'
        )->select('id', 'nama');
    }
}

