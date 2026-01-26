<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'user';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
}