<?php

namespace App\Filament\Company\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('team_id')
                    ->relationship('team', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Toggle::make('is_menu')
                    ->required(),
                TextInput::make('order_menu')
                    ->numeric(),
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                TextInput::make('type'),
                Toggle::make('inventoryControl')
                    ->required(),
                TextInput::make('seasoning'),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('unit'),
                TextInput::make('priceSale')
                    ->numeric(),
                TextInput::make('ncm'),
                TextInput::make('cest')
                    ->default('0000000'),
                TextInput::make('ean')
                    ->default('SEM GTIN'),
                TextInput::make('codigo_beneficio_fiscal_uf'),
                TextInput::make('cfop'),
                TextInput::make('csosn'),
                TextInput::make('origin'),
                TextInput::make('cst'),
                TextInput::make('icmsPercentage')
                    ->numeric(),
                TextInput::make('cofinsPercentage')
                    ->numeric(),
                TextInput::make('pisPercentage')
                    ->numeric(),
                TextInput::make('reductionIcmsPercentage')
                    ->numeric(),
            ]);
    }
}
