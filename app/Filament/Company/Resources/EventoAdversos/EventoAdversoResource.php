<?php

namespace App\Filament\Company\Resources\EventoAdversos;

use App\Filament\Company\Resources\EventoAdversos\Pages\CreateEventoAdverso;
use App\Filament\Company\Resources\EventoAdversos\Pages\EditEventoAdverso;
use App\Filament\Company\Resources\EventoAdversos\Pages\ListEventoAdversos;
use App\Filament\Company\Resources\EventoAdversos\Pages\ViewEventoAdverso;
use App\Filament\Company\Resources\EventoAdversos\Schemas\EventoAdversoForm;
use App\Filament\Company\Resources\EventoAdversos\Schemas\EventoAdversoInfolist;
use App\Filament\Company\Resources\EventoAdversos\Tables\EventoAdversosTable;
use App\Models\EventoAdverso;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventoAdversoResource extends Resource
{
    protected static ?string $model = EventoAdverso::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'codigo';

    public static function form(Schema $schema): Schema
    {
        return EventoAdversoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventoAdversoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventoAdversosTable::configure($table);
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
            'index' => ListEventoAdversos::route('/'),
            'create' => CreateEventoAdverso::route('/create'),
            'view' => ViewEventoAdverso::route('/{record}'),
            'edit' => EditEventoAdverso::route('/{record}/edit'),
        ];
    }
}
