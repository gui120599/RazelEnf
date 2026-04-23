<?php

namespace App\Filament\Company\Resources\EventoAdversos\Pages;

use App\Filament\Company\Resources\EventoAdversos\EventoAdversoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditEventoAdverso extends EditRecord
{
    protected static string $resource = EventoAdversoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
