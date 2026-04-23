<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DescricaoClassificacaoEvento extends Model
{
    use SoftDeletes;

    protected $table = 'descricao_classificacao_eventos';

    protected $fillable = [
        'classificacao_evento_id',
        'descricao',
        'order',
    ];


    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoEvento::class, 'classificacao_evento_id');
    }

    public function eventos()
    {
        return $this->hasMany(EventoAdverso::class, 'descricao_classificacao_evento_id');
    }
}
