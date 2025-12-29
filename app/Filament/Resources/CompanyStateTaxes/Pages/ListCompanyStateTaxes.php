<?php

namespace App\Filament\Resources\CompanyStateTaxes\Pages;

use App\Filament\Resources\CompanyStateTaxes\CompanyStateTaxResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCompanyStateTaxes extends ListRecords
{
    protected static string $resource = CompanyStateTaxResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
