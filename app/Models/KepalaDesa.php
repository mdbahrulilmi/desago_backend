<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'kepala_desa';
    
    protected $primaryKey = 'no';
    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = [];
}
