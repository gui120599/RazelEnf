<?php

namespace App\Filament\Company\Resources\EventoAdversos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class EventoAdversoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('team_id')
                    ->numeric(),
                TextEntry::make('codigo'),
                TextEntry::make('data_evento')
                    ->date(),
                TextEntry::make('hora_evento')
                    ->time()
                    ->placeholder('-'),
                TextEntry::make('periodo_dia_evento')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('setor_notificador_id')
                    ->numeric(),
                TextEntry::make('setor_evento_id')
                    ->numeric(),
                TextEntry::make('classificacao_evento_id')
                    ->numeric(),
                TextEntry::make('descricao_classificacao_evento_id')
                    ->numeric(),
                TextEntry::make('descricao_evento')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('tipo_envolvido')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('nome_envolvido')
                    ->placeholder('-'),
                TextEntry::make('data_nascimento_envolvido')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('prontuario_paciente')
                    ->placeholder('-'),
                TextEntry::make('diagnostico_paciente')
                    ->placeholder('-'),
                TextEntry::make('descricao_acao_imediata')
                    ->placeholder('-'),
                TextEntry::make('grau_dano')
                    ->badge()
                    ->placeholder('-'),
                TextEntry::make('analise_causa')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('plano_acao')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('status')
                    ->badge(),
                TextEntry::make('ip')
                    ->placeholder('-'),
                TextEntry::make('nome_notificador')
                    ->placeholder('-'),
                TextEntry::make('email_notificador')
                    ->placeholder('-'),
                TextEntry::make('telefone_notificador')
                    ->placeholder('-'),
                TextEntry::make('notificador_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
