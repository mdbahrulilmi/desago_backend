<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $connection = 'desa';
    protected $table = 'jenis_surat';
    
    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = [];
}
