<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdBelanjaKategori extends Model
{
    protected $connection = 'desa';
    protected $table = 'apbd_belanja_kategori';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
}

