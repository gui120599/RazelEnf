<?php

namespace App\Filament\Company\Resources\EventoAdversos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventoAdversosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('codigo')
                    ->searchable(),
                TextColumn::make('data_evento')
                    ->date()
                    ->sortable(),
                TextColumn::make('hora_evento')
                    ->time()
                    ->sortable(),
                TextColumn::make('periodo_dia_evento')
                    ->badge()
                    ->searchable(),
                TextColumn::make('setor_notificador_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('setor_evento_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('classificacao_evento_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('descricao_classificacao_evento_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('tipo_envolvido')
                    ->badge()
                    ->searchable(),
                TextColumn::make('nome_envolvido')
                    ->searchable(),
                TextColumn::make('data_nascimento_envolvido')
                    ->date()
                    ->sortable(),
                TextColumn::make('prontuario_paciente')
                    ->searchable(),
                TextColumn::make('diagnostico_paciente')
                    ->searchable(),
                TextColumn::make('descricao_acao_imediata')
                    ->searchable(),
                TextColumn::make('grau_dano')
                    ->badge()
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('ip')
                    ->searchable(),
                TextColumn::make('nome_notificador')
                    ->searchable(),
                TextColumn::make('email_notificador')
                    ->searchable(),
                TextColumn::make('telefone_notificador')
                    ->searchable(),
                TextColumn::make('notificador_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
