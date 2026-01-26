<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'slideshow';

     protected $primaryKey = 'no';
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $guarded = [];
}
