<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporKategori extends Model
{
    protected $connection = 'desa';
    protected $table = 'lapor_kategori';

    public $timestamps = false;

    protected $guarded = [];
}
