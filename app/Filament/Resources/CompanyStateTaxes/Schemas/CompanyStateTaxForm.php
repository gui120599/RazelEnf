<?php

namespace App\Filament\Resources\CompanyStateTaxes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CompanyStateTaxForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                    ->relationship('company', 'name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                Select::make('environment_type')
                    ->options(['none' => 'None', 'production' => 'Production', 'test' => 'Test']),
                TextInput::make('tax_number')
                    ->required(),
                Select::make('special_tax_regime')
                    ->options([
            'automatico' => 'Automatico',
            'nenhum' => 'Nenhum',
            'microempresaMunicipal' => 'Microempresa municipal',
            'estimativa' => 'Estimativa',
            'sociedadeDeProfissionais' => 'Sociedade de profissionais',
            'cooperativa' => 'Cooperativa',
            'microempreendedorIndividual' => 'Microempreendedor individual',
            'microempresarioEmpresaPequenoPorte' => 'Microempresario empresa pequeno porte',
        ]),
                TextInput::make('serie')
                    ->required()
                    ->numeric(),
                TextInput::make('number')
                    ->required()
                    ->numeric(),
                TextInput::make('security_credential_id')
                    ->numeric(),
                TextInput::make('security_credential_code'),
                Select::make('type')
                    ->options(['default' => 'Default', 'nFe' => 'N fe', 'nFCe' => 'N f ce']),
            ]);
    }
}
