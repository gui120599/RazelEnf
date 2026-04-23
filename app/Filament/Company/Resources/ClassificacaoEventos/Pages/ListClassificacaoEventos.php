<?php

namespace App\Filament\Company\Resources\ClassificacaoEventos\Pages;

use App\Filament\Company\Resources\ClassificacaoEventos\ClassificacaoEventoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClassificacaoEventos extends ListRecords
{
    protected static string $resource = ClassificacaoEventoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
