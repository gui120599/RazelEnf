<?php

namespace App\Filament\Company\Resources\EventoAdversos\Pages;

use App\Filament\Company\Resources\EventoAdversos\EventoAdversoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewEventoAdverso extends ViewRecord
{
    protected static string $resource = EventoAdversoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
