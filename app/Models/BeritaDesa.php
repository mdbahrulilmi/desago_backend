<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BeritaDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'berita';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
    
    public function userDesa()
    {
        return $this->belongsTo(UserDesa::class, 'subdomain');
    }


}

