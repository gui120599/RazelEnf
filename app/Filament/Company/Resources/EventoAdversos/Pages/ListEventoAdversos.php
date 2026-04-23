<?php

namespace App\Filament\Company\Resources\EventoAdversos\Pages;

use App\Filament\Company\Resources\EventoAdversos\EventoAdversoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventoAdversos extends ListRecords
{
    protected static string $resource = EventoAdversoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
