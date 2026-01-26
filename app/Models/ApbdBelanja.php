<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdBelanja extends Model
{
    protected $connection = 'desa';
    protected $table = 'apbd_belanja';

    public $timestamps = false;

    protected $guarded = [];
}

