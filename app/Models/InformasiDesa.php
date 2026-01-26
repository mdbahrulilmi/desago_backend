<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformasiDesa extends Model
{
    protected $connection = 'desa';
    protected $table = 'informasi';

     protected $primaryKey = 'no';
    protected $keyType = 'int';
    
    public $timestamps = false;

    protected $guarded = [];
    
    public function getMisiAttribute($value)
    {
        if (!$value) {
            return [];
        }
    
        if ($this->isJson($value)) {
            $decoded = json_decode($value, true);
    
            return is_array($decoded)
                ? array_values(array_map('trim', $decoded))
                : [];
        }
    
        $items = preg_split('/\r\n|\r|\n|\d+\.\s*/', $value);
    
        return array_values(
            array_filter(
                array_map('trim', $items)
            )
        );
    }

/**
 * Helper cek JSON
 */
private function isJson($string)
{
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}


    public function setMisiAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['misi'] = implode("\n", $value);
        } else {
            $this->attributes['misi'] = $value;
        }
    }
}
