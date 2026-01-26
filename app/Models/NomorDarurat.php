<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NomorDarurat extends Model
{
    protected $connection = 'desa';
    protected $table = 'nomor_darurat';

    public $timestamps = false;

    protected $guarded = [];
}

