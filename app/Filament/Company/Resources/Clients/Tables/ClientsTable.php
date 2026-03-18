<?php

namespace App\Filament\Company\Resources\Clients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ClientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('name', 'asc')
            ->columns([
                TextColumn::make('team.name')
                    ->label(__('Team'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label(__('Client'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('federalTaxNumber')
                    ->label(__('CPF/CNPJ'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label(__('Email'))
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('Phone'))
                    ->searchable(),
                TextColumn::make('personType')
                    /*->enum([
                        'pf' => __('Individual'),
                        'pj' => __('Legal Entity'),
                    ])*/
                    ->sortable(),
                TextColumn::make('tradeName')
                    ->label(__('Trade Name'))
                    ->searchable(),
                TextColumn::make('taxRegime')
                    ->label(__('Tax Regime'))
                    ->searchable(),
                TextColumn::make('stateTaxNumber')
                    ->label(__('State Tax Number'))
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label(__('Created At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label(__('Updated At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label(__('Deleted At'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                // additional filter: person type
                // Filter::make('personType')->query(fn (Builder $query, $value) => $query->where('personType', $value))->options([ 'pf' => __('Individual'), 'pj' => __('Legal Entity') ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
