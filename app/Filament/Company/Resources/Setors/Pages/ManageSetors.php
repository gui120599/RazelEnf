<?php

namespace App\Filament\Company\Resources\Setors\Pages;

use App\Filament\Company\Resources\Setors\SetorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSetors extends ManageRecords
{
    protected static string $resource = SetorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
