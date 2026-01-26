<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdPendapatanKategori extends Model
{
    protected $connection = 'desa';
    protected $table = 'apbd_pendapatan_kategori';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
}

