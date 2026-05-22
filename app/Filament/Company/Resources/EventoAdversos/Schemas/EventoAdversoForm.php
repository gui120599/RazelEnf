<?php

namespace App\Filament\Company\Resources\EventoAdversos\Schemas;

use App\Enums\PeriodoDiaEventoEnum;
use App\Enums\TipoEnvolvidoEnum;
use App\Models\DescricaoClassificacaoEvento;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class EventoAdversoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([

                    Step::make(__('Evento'))
                        ->description(__('Informações detalhadas sobre o evento adverso'))
                        ->icon('heroicon-o-document-text')
                        ->schema([

                            DatePicker::make('data_evento')
                                ->helperText(__('Data em que o evento adverso ocorreu'))
                                ->required()
                                ->columnSpan(1),

                            TimePicker::make('hora_evento')
                                ->helperText(__('Hora em que o evento adverso ocorreu'))
                                ->required()
                                ->seconds(false)
                                ->columnSpan(1)
                                ->reactive()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if (!$state) return;

                                    $hora = (int) substr($state, 0, 2); // Extrai apenas a hora

                                    $periodo = match (true) {
                                        $hora >= 6  && $hora < 12 => PeriodoDiaEventoEnum::MANHA,
                                        $hora >= 12 && $hora < 18 => PeriodoDiaEventoEnum::TARDE,
                                        default                   => PeriodoDiaEventoEnum::NOITE,
                                    };

                                    $set('periodo_dia_evento', $periodo);
                                }),

                            Hidden::make('periodo_dia_evento'),

                            MarkdownEditor::make('descricao_evento')
                                ->label(__('Descrição do evento adverso'))
                                ->helperText(__('Inclua detalhes como o que aconteceu, como aconteceu, consequências, etc. Quanto mais detalhes, melhor para análise e prevenção de futuros eventos.'))
                                ->required()
                                ->fileAttachmentsAcceptedFileTypes(['image/png', 'image/jpeg'])
                                ->fileAttachmentsMaxSize(5120)
                                ->columnSpanFull(),
                        ])->columns(3),

                    Step::make(__('Setor'))
                        ->label(__('Setores Envolvidos'))
                        ->description(__('Informações sobre os setores envolvidos no evento adverso'))
                        ->icon('heroicon-o-building-office')
                        ->schema([
                            Select::make('setor_evento_id')
                                ->helperText(__('Setor onde o evento ocorreu'))
                                ->relationship('setorEvento', 'name')
                                ->searchable()
                                ->preload(5)
                                ->required(),
                            Select::make('setor_notificador_id')
                                ->helperText(__('Setor do notificador do evento adverso'))
                                ->relationship('setorNotificador', 'name')
                                ->searchable()
                                ->preload(5)
                                ->required(),
                        ])->columns(2),

                    Step::make(__('Classificação'))
                        ->description(__('Detalhes do evento adverso'))
                        ->icon('heroicon-o-shield-exclamation')
                        ->schema([
                            Select::make('classificacao_evento_id')
                                ->label(__('Classificação do Evento Adverso'))
                                ->helperText(__('Classificação do evento adverso'))
                                ->relationship('classificacao', 'name')
                                ->searchable()
                                ->preload(5)
                                ->required()
                                ->reactive(), // 👈 Torna o campo reativo

                            Radio::make('descricao_classificacao_evento_id')
                                ->label(__('Descrição da Classificação do Evento Adverso'))
                                ->helperText(__('Descrição detalhada da classificação do evento adverso'))
                                ->options(function (callable $get) {
                                    $classificacaoId = $get('classificacao_evento_id'); // 👈 Lê o valor do primeiro campo

                                    if (!$classificacaoId) {
                                        return [];
                                    }

                                    return DescricaoClassificacaoEvento::where('classificacao_evento_id', $classificacaoId)
                                        ->pluck('descricao', 'id');
                                })
                                ->required()
                                ->hidden(fn(callable $get) => !$get('classificacao_evento_id')), // 👈 Esconde enquanto o primeiro não for selecionado
                        ]),

                    Step::make(__('Envolvidos'))
                        ->description(__('Informações sobre os envolvidos no evento adverso'))
                        ->icon('heroicon-o-user-group')
                        ->schema([
                            Toggle::make('possui_envolvidos')
                                ->label(__('Existe algum envolvido no evento?'))
                                ->helperText(__('Marque caso haja pessoas envolvidas no evento adverso'))
                                ->reactive()
                                ->dehydrated(false)
                                ->default(true) // 👈 Padrão apenas para criação
                                ->afterStateHydrated(
                                    fn(callable $set, $record) =>
                                    $set('possui_envolvidos', filled($record?->nome_envolvido))
                                )
                                ->columnSpanFull(),

                            Select::make('tipo_envolvido')
                                ->label(__('Tipo de envolvido'))
                                ->options(TipoEnvolvidoEnum::class)
                                ->required(fn(callable $get) => $get('possui_envolvidos'))
                                ->reactive()
                                ->hidden(fn(callable $get) => !$get('possui_envolvidos'))
                                ->columnSpanFull(),

                            TextInput::make('nome_envolvido')
                                ->label(__('Nome completo'))
                                ->required(fn(callable $get) => $get('possui_envolvidos'))
                                ->hidden(fn(callable $get) => !$get('possui_envolvidos'))
                                ->columnSpan(2),

                            DatePicker::make('data_nascimento_envolvido')
                                ->label(__('Data de nascimento'))
                                ->helperText(__('Data de nascimento do envolvido no evento adverso'))
                                ->native(false)
                                ->displayFormat('d/m/Y')
                                ->hidden(fn(callable $get) => !$get('possui_envolvidos'))
                                ->columnSpan(1),

                            // --- Campos exclusivos: PACIENTE ---
                            TextInput::make('prontuario_paciente')
                                ->label(__('Prontuário'))
                                ->hidden(fn(callable $get) => !$get('possui_envolvidos') || $get('tipo_envolvido') !== TipoEnvolvidoEnum::PACIENTE)
                                ->required(fn(callable $get) => $get('possui_envolvidos') && $get('tipo_envolvido') === TipoEnvolvidoEnum::PACIENTE)
                                ->columnSpan(1),

                            TextInput::make('diagnostico_paciente')
                                ->label(__('Diagnóstico'))
                                ->hidden(fn(callable $get) => !$get('possui_envolvidos') || $get('tipo_envolvido') !== TipoEnvolvidoEnum::PACIENTE)
                                ->columnSpan(2),
                        ])
                        ->columns(3),

                    Step::make(__('Notificador'))
                        ->description(__('Informações sobre o notificador do evento adverso'))
                        ->icon('heroicon-o-user')
                        ->schema([
                            Toggle::make('deseja_identificar')
                                ->label(__('Deseja se identificar?'))
                                ->helperText(__('A identificação é opcional. Notificações anônimas são igualmente válidas.'))
                                ->reactive()
                                ->dehydrated(false)
                                ->default(fn() => auth()->check()) // 👈 Padrão apenas para criação
                                ->afterStateHydrated(
                                    fn(callable $set, $record) =>
                                    $set('deseja_identificar', filled($record?->nome_notificador) || filled($record?->notificador_id))
                                )
                                ->columnSpanFull(),

                            // --- Usuário logado: exibe nome e bloqueia ---
                            Placeholder::make('notificador_logado')
                                ->label(__('Notificador'))
                                ->content(fn() => auth()->user()->name)
                                ->visible(fn(callable $get) => auth()->check() && $get('deseja_identificar'))
                                ->columnSpan(2),

                            // --- Usuário não logado: campos livres ---
                            TextInput::make('nome_notificador')
                                ->label(__('Nome do notificador'))
                                ->required(fn(callable $get) => $get('deseja_identificar') && !auth()->check())
                                ->hidden(fn(callable $get) => !$get('deseja_identificar') || auth()->check())
                                ->columnSpan(2),

                            TextInput::make('email_notificador')
                                ->label(__('E-mail'))
                                ->email()
                                ->hidden(fn(callable $get) => !$get('deseja_identificar'))
                                ->columnSpan(2),

                            TextInput::make('telefone_notificador')
                                ->label(__('Telefone'))
                                ->tel()
                                ->mask('(99) 99999-9999')
                                ->hidden(fn(callable $get) => !$get('deseja_identificar'))
                                ->columnSpan(1),

                            // --- Vínculo com usuário do sistema ---
                            Select::make('notificador_id')
                                ->label(__('Vínculo com usuário do sistema'))
                                ->helperText(__('Opcional — vincule a um usuário cadastrado'))
                                ->relationship('notificador', 'name')
                                ->searchable()
                                ->preload(5)
                                ->default(fn() => auth()->id())
                                ->dehydrated()
                                ->hidden(fn() => auth()->check())
                                ->columnSpan(2),

                            Hidden::make('ip')
                                ->default(fn() => request()->ip()),
                        ])
                        ->columns(2),

                ])
                    ->columnSpanFull(),
            ]);
    }
}
