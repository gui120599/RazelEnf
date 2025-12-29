<?php

namespace App\Filament\Resources\CompanyStateTaxes\Pages;

use App\Filament\Resources\CompanyStateTaxes\CompanyStateTaxResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCompanyStateTax extends EditRecord
{
    protected static string $resource = CompanyStateTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
