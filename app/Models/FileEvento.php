<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileEvento extends Model
{
    protected $table = 'file_eventos';

    protected $fillable = [
        'evento_adverso_id',
        'file_path',
        'original_name',
        'mime_type',
        'size',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function evento()
    {
        return $this->belongsTo(EventoAdverso::class, 'evento_adverso_id');
    }
}
