<?php

namespace App\Filament\Company\Resources\Products\Schemas;

use App\Enums\TypeProductEnum;
use App\Enums\UnitProductEnum;
use App\Filament\Company\Resources\Categories\CategoryResource;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

use function Laravel\Prompts\search;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('General'))
                    ->icon('heroicon-o-cube')
                    ->translateLabel()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        Grid::make()
                            ->schema([
                                Select::make('category_id')
                                    ->translateLabel()
                                    ->searchable()
                                    ->preload(10)
                                    ->relationship('category', 'name')
                                    ->createOptionForm(CategoryResource::getComponents())
                                    ->required()
                                    ->columnSpan(1),
                                Select::make('type')
                                    ->translateLabel()
                                    ->searchable()
                                    ->options(
                                        collect(TypeProductEnum::cases())
                                            ->mapWithKeys(fn($type) => [
                                                $type->value => $type->label()
                                            ])
                                            ->toArray()
                                    )
                                    ->columnSpan(1),
                                TextInput::make('name')
                                    ->translateLabel()
                                    ->required()
                                    ->columnSpan('full'),
                                Textarea::make('description')
                                    ->rows(3)
                                    ->translateLabel()
                                    ->required()
                                    ->columnSpan('full'),
                            ])
                            ->columns(2)
                            ->columnSpan(1),
                        Grid::make()
                            ->schema([
                                FileUpload::make('image')
                                    ->translateLabel()
                                    ->image()
                                    ->columnSpan('full'),
                            ])
                            ->columns(1)
                            ->columnSpan(1),
                    ]),

                Section::make(__('Menu settings'))
                    ->icon('heroicon-o-cog')
                    ->translateLabel()
                    ->columns(2)
                    ->columnSpan(1)
                    ->schema([
                        Toggle::make('is_menu')
                            ->translateLabel()
                            ->columnSpan(1),
                        Toggle::make('inventoryControl')
                            ->translateLabel()
                            ->columnSpan(1),
                        Textarea::make('seasoning')
                            ->rows(3)
                            ->translateLabel()
                            ->columnSpan(2),
                        Select::make('unit')
                            ->translateLabel()
                            ->searchable()
                            ->options(
                                collect(UnitProductEnum::cases())
                                    ->mapWithKeys(fn($unit) => [
                                        $unit->value => $unit->label()
                                    ])
                                    ->toArray()
                            )
                            ->columnSpan(1),
                        TextInput::make('priceSale')
                            ->translateLabel()
                            ->numeric()
                            ->prefix('R$')
                            ->columnSpan(1),
                    ]),

                Section::make(__('Fiscal data'))
                    ->icon('heroicon-o-document-text')
                    ->translateLabel()
                    ->columns(3)
                    ->columnSpan(1)
                    ->schema([
                        TextInput::make('ncm')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('cest')
                            ->translateLabel()
                            ->default('0000000')
                            ->columnSpan(1),
                        TextInput::make('ean')
                            ->translateLabel()
                            ->default('SEM GTIN')
                            ->columnSpan(1),
                        TextInput::make('cfop')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('csosn')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('cst')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('origin')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('codigo_beneficio_fiscal_uf')
                            ->translateLabel()
                            ->columnSpan(2),
                    ]),

                Section::make(__('Tax percentages'))
                    ->icon('heroicon-o-calculator')
                    ->translateLabel()
                    ->columns(2)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('icmsPercentage')
                            ->translateLabel()
                            ->numeric()
                            ->suffix('%')
                            ->columnSpan(1),
                        TextInput::make('reductionIcmsPercentage')
                            ->translateLabel()
                            ->numeric()
                            ->suffix('%')
                            ->columnSpan(1),
                        TextInput::make('cofinsPercentage')
                            ->translateLabel()
                            ->numeric()
                            ->suffix('%')
                            ->columnSpan(1),
                        TextInput::make('pisPercentage')
                            ->translateLabel()
                            ->numeric()
                            ->suffix('%')
                            ->columnSpan(1),
                    ]),
            ])
            ->columns(2);
    }
}
