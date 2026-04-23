<?php

namespace App\Filament\Company\Resources\ClassificacaoEventos\Pages;

use App\Filament\Company\Resources\ClassificacaoEventos\ClassificacaoEventoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditClassificacaoEvento extends EditRecord
{
    protected static string $resource = ClassificacaoEventoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
