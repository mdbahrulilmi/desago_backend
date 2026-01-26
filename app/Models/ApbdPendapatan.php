<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApbdPendapatan extends Model
{
    protected $connection = 'desa';
    protected $table = 'apbd_pendapatan';

    public $timestamps = false;

    protected $guarded = [];
}

