<?php

namespace App\Filament\Resources\Teams\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->disk('public')
                    ->label('Image'),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('accountId')
                    ->searchable(),
                TextColumn::make('tradeName')
                    ->searchable(),
                TextColumn::make('federalTaxNumber')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('taxRegime'),
                TextColumn::make('state')
                    ->searchable(),
                TextColumn::make('codeCity')
                    ->searchable(),
                TextColumn::make('nameCity')
                    ->searchable(),
                TextColumn::make('district')
                    ->searchable(),
                TextColumn::make('additionalInformation')
                    ->searchable(),
                TextColumn::make('street')
                    ->searchable(),
                TextColumn::make('number')
                    ->searchable(),
                TextColumn::make('postalCode')
                    ->searchable(),
                TextColumn::make('country')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
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
