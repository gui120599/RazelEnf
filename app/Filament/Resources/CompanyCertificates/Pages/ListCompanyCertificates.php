<?php

namespace App\Filament\Resources\CompanyCertificates\Pages;

use App\Filament\Resources\CompanyCertificates\CompanyCertificateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanyCertificates extends ListRecords
{
    protected static string $resource = CompanyCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
