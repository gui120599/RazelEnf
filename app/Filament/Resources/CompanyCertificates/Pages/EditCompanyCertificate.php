<?php

namespace App\Filament\Resources\CompanyCertificates\Pages;

use App\Filament\Resources\CompanyCertificates\CompanyCertificateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyCertificate extends EditRecord
{
    protected static string $resource = CompanyCertificateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
