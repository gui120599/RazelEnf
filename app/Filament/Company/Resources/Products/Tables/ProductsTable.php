<?php

namespace App\Filament\Company\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('team.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('description')
                    ->searchable(),
                IconColumn::make('is_menu')
                    ->boolean(),
                TextColumn::make('order_menu')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('type')
                    ->searchable(),
                IconColumn::make('inventoryControl')
                    ->boolean(),
                TextColumn::make('seasoning')
                    ->searchable(),
                ImageColumn::make('image'),
                TextColumn::make('unit')
                    ->searchable(),
                TextColumn::make('priceSale')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ncm')
                    ->searchable(),
                TextColumn::make('cest')
                    ->searchable(),
                TextColumn::make('ean')
                    ->searchable(),
                TextColumn::make('codigo_beneficio_fiscal_uf')
                    ->searchable(),
                TextColumn::make('cfop')
                    ->searchable(),
                TextColumn::make('csosn')
                    ->searchable(),
                TextColumn::make('origin')
                    ->searchable(),
                TextColumn::make('cst')
                    ->searchable(),
                TextColumn::make('icmsPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('cofinsPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('pisPercentage')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('reductionIcmsPercentage')
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
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
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
