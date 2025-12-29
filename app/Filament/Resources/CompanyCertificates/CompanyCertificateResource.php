<?php

namespace App\Filament\Resources\CompanyCertificates;

use App\Filament\Resources\CompanyCertificates\Pages\CreateCompanyCertificate;
use App\Filament\Resources\CompanyCertificates\Pages\EditCompanyCertificate;
use App\Filament\Resources\CompanyCertificates\Pages\ListCompanyCertificates;
use App\Filament\Resources\CompanyCertificates\Schemas\CompanyCertificateForm;
use App\Filament\Resources\CompanyCertificates\Tables\CompanyCertificatesTable;
use App\Models\CompanyCertificate;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CompanyCertificateResource extends Resource
{
    protected static ?string $model = CompanyCertificate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return CompanyCertificateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CompanyCertificatesTable::configure($table);
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
            'index' => ListCompanyCertificates::route('/'),
            'create' => CreateCompanyCertificate::route('/create'),
            'edit' => EditCompanyCertificate::route('/{record}/edit'),
        ];
    }
}
