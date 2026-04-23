<?php

namespace App\Filament\Company\Resources\EventoAdversos\Schemas;

use App\Enums\GrauDanoEnum;
use App\Enums\PeriodoDiaEventoEnum;
use App\Enums\StatusEventoEnum;
use App\Enums\TipoEnvolvidoEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class EventoAdversoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('team_id')
                    ->required()
                    ->numeric(),
                TextInput::make('codigo')
                    ->required(),
                DatePicker::make('data_evento')
                    ->required(),
                TimePicker::make('hora_evento'),
                Select::make('periodo_dia_evento')
                    ->options(PeriodoDiaEventoEnum::class),
                TextInput::make('setor_notificador_id')
                    ->required()
                    ->numeric(),
                TextInput::make('setor_evento_id')
                    ->required()
                    ->numeric(),
                TextInput::make('classificacao_evento_id')
                    ->required()
                    ->numeric(),
                TextInput::make('descricao_classificacao_evento_id')
                    ->required()
                    ->numeric(),
                Textarea::make('descricao_evento')
                    ->columnSpanFull(),
                Select::make('tipo_envolvido')
                    ->options(TipoEnvolvidoEnum::class),
                TextInput::make('nome_envolvido'),
                DatePicker::make('data_nascimento_envolvido'),
                TextInput::make('prontuario_paciente'),
                TextInput::make('diagnostico_paciente'),
                TextInput::make('descricao_acao_imediata'),
                Select::make('grau_dano')
                    ->options(GrauDanoEnum::class),
                Textarea::make('analise_causa')
                    ->columnSpanFull(),
                Textarea::make('plano_acao')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(StatusEventoEnum::class)
                    ->default('aberto')
                    ->required(),
                TextInput::make('ip'),
                TextInput::make('nome_notificador'),
                TextInput::make('email_notificador')
                    ->email(),
                TextInput::make('telefone_notificador')
                    ->tel(),
                TextInput::make('notificador_id')
                    ->numeric(),
            ]);
    }
}
