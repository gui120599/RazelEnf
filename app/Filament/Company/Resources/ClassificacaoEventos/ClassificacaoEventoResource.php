<?php

namespace App\Filament\Company\Resources\ClassificacaoEventos;

use App\Filament\Company\Resources\ClassificacaoEventos\Pages\CreateClassificacaoEvento;
use App\Filament\Company\Resources\ClassificacaoEventos\Pages\EditClassificacaoEvento;
use App\Filament\Company\Resources\ClassificacaoEventos\Pages\ListClassificacaoEventos;
use App\Filament\Company\Resources\ClassificacaoEventos\Schemas\ClassificacaoEventoForm;
use App\Filament\Company\Resources\ClassificacaoEventos\Tables\ClassificacaoEventosTable;
use App\Models\ClassificacaoEvento;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassificacaoEventoResource extends Resource
{
    protected static ?string $model = ClassificacaoEvento::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ClassificacaoEventoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClassificacaoEventosTable::configure($table);
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
            'index' => ListClassificacaoEventos::route('/'),
            'create' => CreateClassificacaoEvento::route('/create'),
            'edit' => EditClassificacaoEvento::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
