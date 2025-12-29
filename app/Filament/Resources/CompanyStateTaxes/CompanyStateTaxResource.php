<?php

namespace App\Filament\Resources\CompanyStateTaxes;

use App\Filament\Resources\CompanyStateTaxes\Pages\CreateCompanyStateTax;
use App\Filament\Resources\CompanyStateTaxes\Pages\EditCompanyStateTax;
use App\Filament\Resources\CompanyStateTaxes\Pages\ListCompanyStateTaxes;
use App\Filament\Resources\CompanyStateTaxes\Schemas\CompanyStateTaxForm;
use App\Filament\Resources\CompanyStateTaxes\Tables\CompanyStateTaxesTable;
use App\Models\CompanyStateTax;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyStateTaxResource extends Resource
{
    protected static ?string $model = CompanyStateTax::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'code';

    public static function form(Schema $schema): Schema
    {
        return CompanyStateTaxForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyStateTaxesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCompanyStateTaxes::route('/'),
            'create' => CreateCompanyStateTax::route('/create'),
            'edit' => EditCompanyStateTax::route('/{record}/edit'),
        ];
    }
}
