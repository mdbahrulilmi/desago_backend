<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perangkat extends Model
{
    protected $connection = 'desa';
    protected $table = 'perangkat';
    
     protected $primaryKey = 'no';
    protected $keyType = 'int';

    public $timestamps = false;

    protected $guarded = [];
}

