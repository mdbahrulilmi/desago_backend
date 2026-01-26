<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaDesaKategori extends Model
{
    protected $connection = 'desa';
    protected $table = 'agenda_kategori';

    protected $primaryKey = 'subdomain';
    public $timestamps = false;

    protected $guarded = [];
}

