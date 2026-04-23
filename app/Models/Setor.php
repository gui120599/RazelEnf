<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setor extends Model
{
    protected $table = 'setores';
    
    protected $fillable = [
        'team_id',
        'name',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function eventos()
    {
        return $this->hasMany(EventoAdverso::class, 'setor_notificador_id')->orWhere('setor_evento_id', $this->id);
    }
}
