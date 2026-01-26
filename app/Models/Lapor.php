<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lapor extends Model
{
    protected $connection = 'desa';
    protected $table = 'lapor';

    public $timestamps = false;

    protected $fillable = [
        'subdomain',
        'ditujukan',
        'title',
        'image',
        'category',
        'description',
        'status',
    ];
    
    public function kategori()
    {
        return $this->hasOne(
            LaporKategori::class,
            'no',
            'category'
        );
    }
}
