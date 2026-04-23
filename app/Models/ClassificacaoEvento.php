<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassificacaoEvento extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'team_id',
        'name',
        'description',
        'listar_no_formulario',
    ];

    protected $casts = [
        'listar_no_formulario' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELACIONAMENTOS
    |--------------------------------------------------------------------------
    */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function descricoes()
    {
        return $this->hasMany(DescricaoClassificacaoEvento::class);
    }

    public function eventos()
    {
        return $this->hasMany(EventoAdverso::class);
    }
}