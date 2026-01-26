<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UMKMKategori extends Model
{
    protected $connection = 'desa';
    protected $table = 'umkm_category';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
}
