<?php

namespace App\Filament\Resources\CompanyStateTaxes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CompanyStateTaxesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('environment_type'),
                TextColumn::make('tax_number')
                    ->searchable(),
                TextColumn::make('special_tax_regime'),
                TextColumn::make('serie')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('number')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('security_credential_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('security_credential_code')
                    ->searchable(),
                TextColumn::make('type'),
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
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
