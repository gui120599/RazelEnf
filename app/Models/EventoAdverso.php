<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventoAdverso extends Model
{
    use HasFactory;

    protected $table = 'eventos_adversos';

    protected $fillable = [
        'team_id',
        'codigo',
        'data_evento',
        'hora_evento',
        'periodo_dia_evento',
        'setor_notificador_id',
        'setor_evento_id',
        'classificacao_evento_id',
        'descricao_classificacao_evento_id',
        'descricao_evento',
        'tipo_envolvido',
        'nome_envolvido',
        'data_nascimento_envolvido',
        'prontuario_paciente',
        'diagnostico_paciente',
        'descricao_acao_imediata',
        'grau_dano',
        'analise_causa',
        'plano_acao',
        'status',
        'ip',
        'nome_notificador',
        'email_notificador',
        'telefone_notificador',
        'notificador_id',
    ];

    protected $casts = [
        'data_evento' => 'date',
        'hora_evento' => 'datetime:H:i',
        'data_nascimento_envolvido' => 'date',
        'grau_dano' => \App\Enums\GrauDanoEnum::class,
        'status' => \App\Enums\StatusEventoEnum::class,
        'periodo_dia_evento' => \App\Enums\PeriodoDiaEventoEnum::class,
        'tipo_envolvido' => \App\Enums\TipoEnvolvidoEnum::class,
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

    public function setorNotificador()
    {
        return $this->belongsTo(Setor::class, 'setor_notificador_id');
    }

    public function setorEvento()
    {
        return $this->belongsTo(Setor::class, 'setor_evento_id');
    }

    public function classificacao()
    {
        return $this->belongsTo(ClassificacaoEvento::class, 'classificacao_evento_id');
    }

    public function descricaoClassificacao()
    {
        return $this->belongsTo(DescricaoClassificacaoEvento::class, 'descricao_classificacao_evento_id');
    }

    public function arquivos()
    {
        return $this->hasMany(FileEvento::class);
    }

    public function notificador()
    {
        return $this->belongsTo(User::class, 'notificador_id');
    }

    /*
    |--------------------------------------------------------------------------
    | BOOT
    |--------------------------------------------------------------------------
    */

    protected static function booted() // Método booted para gerar o código do evento automaticamente
    {
        static::creating(function ($evento) {
            if (empty($evento->codigo)) {
                $evento->codigo = 'EA-' . now()->format('YmdHis');
            }
        });
    }
}
