<?php

namespace App\Filament\Resources\Teams\Schemas;

use App\Services\IBGEServices;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Leandrocfe\FilamentPtbrFormFields\Document;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('General'))
                    ->icon('heroicon-o-building-office')
                    ->columns(3)
                    ->columnSpan(3)
                    ->schema([
                        Grid::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label(__('Company name'))
                                    ->translateLabel()
                                    ->required()
                                    ->columnSpan('full'),
                                TextInput::make('tradeName')
                                    ->translateLabel()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Set $set, $state) {
                                        $set('slug', str($state)->slug());
                                    })
                                    ->columnSpan('full'),
                                TextInput::make('accountId')
                                    ->translateLabel()
                                    ->columnSpan(1),
                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->translateLabel()
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->columnSpan(1),
                            ])
                            ->columns(1)
                            ->columnSpan(2),
                        Grid::make()
                            ->schema([
                                FileUpload::make('image')
                                    ->translateLabel()
                                    ->disk('public')
                                    ->directory('teams')
                                    ->image()
                                    ->avatar()
                                    ->alignCenter()
                                    ->columnSpan('full'),
                            ])
                            ->columns(1)
                            ->columnSpan(1),
                    ]),

                Section::make(__('Fiscal data'))
                    ->icon('heroicon-o-document-text')
                    ->columns(2)
                    ->columnSpan(3)
                    ->schema([
                        Document::make('federalTaxNumber')
                            ->cnpj()
                            ->mutateStateForValidationUsing(fn($state) => preg_replace('/\D/', '', $state))
                            ->dehydrateStateUsing(fn($state) => preg_replace('/\D/', '', $state))
                            ->rule(function ($record) {
                                return Rule::unique('teams', 'federalTaxNumber')
                                    ->ignore($record?->id);
                            })
                            ->translateLabel()
                            ->columnSpan(1),
                        Select::make('taxRegime')
                            ->translateLabel()
                            ->options([
                                'isento'                     => 'Isento',
                                'microempreendedorIndividual' => 'Microempreendedor Individual',
                                'simplesNacional'             => 'Simples Nacional',
                                'lucroPresumido'              => 'Lucro Presumido',
                                'lucroReal'                  => 'Lucro Real',
                                'none'                       => 'Nenhum',
                            ])
                            ->columnSpan(1),
                    ]),

                Section::make(__('Address'))
                    ->icon('heroicon-o-map')
                    ->columns(3)
                    ->columnSpanFull()
                    ->schema([
                        TextInput::make('postalCode')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('street')
                            ->translateLabel()
                            ->columnSpan(2),
                        TextInput::make('number')
                            ->translateLabel()
                            ->default('S/N')
                            ->columnSpan(1),
                        TextInput::make('district')
                            ->translateLabel()
                            ->columnSpan(2),
                        TextInput::make('nameCity')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('codeCity')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('state')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('country')
                            ->translateLabel()
                            ->columnSpan(1),
                        TextInput::make('additionalInformation')
                            ->translateLabel()
                            ->columnSpan('full'),
                    ]),

                Section::make(__('Digital certificate'))
                    ->icon('heroicon-o-shield-check')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('certificates')
                            ->relationship('certificates')
                            ->translateLabel()
                            ->addActionLabel(__('Add certificate'))
                            ->columns(2)
                            ->schema([
                                FileUpload::make('file')
                                    ->translateLabel()
                                    ->required()
                                    ->disk('private')
                                    ->directory('certificates')
                                    ->acceptedFileTypes(['application/x-pkcs12'])
                                    ->maxSize(2048)
                                    ->columnSpan(1),
                                TextInput::make('password')
                                    ->autocomplete('new-password')
                                    ->translateLabel()
                                    ->required()
                                    ->password()
                                    ->revealable()
                                    ->columnSpan(1),
                            ]),
                    ]),

                Section::make(__('State taxes'))
                    ->icon('heroicon-o-receipt-percent')
                    ->columnSpanFull()
                    ->schema([
                        Repeater::make('stateTaxes')
                            ->relationship('stateTaxes')
                            ->translateLabel()
                            ->addActionLabel(__('Add state tax'))
                            ->columns(3)
                            ->schema([
                                Select::make('code')
                                    ->label(__('Code UF'))
                                    ->options(fn() => IBGEServices::ufs())
                                    ->preload(5)
                                    ->searchable()
                                    ->columnSpan(1),
                                TextInput::make('taxNumber')
                                    ->translateLabel()
                                    ->required()
                                    ->columnSpan(1),
                                Select::make('environmentType')
                                    ->translateLabel()
                                    ->options([
                                        'none'       => __('None'),
                                        'production' => __('Production'),
                                        'test'       => __('Test'),
                                    ])
                                    ->columnSpan(1),
                                Select::make('specialTaxRegime')
                                    ->translateLabel()
                                    ->options([
                                        'automatico'                          => 'Automático',
                                        'nenhum'                              => 'Nenhum',
                                        'microempresaMunicipal'               => 'Microempresa Municipal',
                                        'estimativa'                          => 'Estimativa',
                                        'sociedadeDeProfissionais'            => 'Sociedade de Profissionais',
                                        'cooperativa'                         => 'Cooperativa',
                                        'microempreendedorIndividual'         => 'Microempreendedor Individual',
                                        'microempresarioEmpresaPequenoPorte'  => 'Microempresário e Empresa de Pequeno Porte',
                                    ])
                                    ->columnSpan(1),
                                Select::make('type')
                                    ->translateLabel()
                                    ->options([
                                        'default' => 'Default',
                                        'nFe'     => 'NF-e',
                                        'nFCe'    => 'NFC-e',
                                    ])
                                    ->columnSpan(1),
                                TextInput::make('serie')
                                    ->translateLabel()
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(1),
                                TextInput::make('number')
                                    ->translateLabel()
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(1),
                                TextInput::make('securityCredentialId')
                                    ->translateLabel()
                                    ->numeric()
                                    ->columnSpan(1),
                                TextInput::make('securityCredentialCode')
                                    ->translateLabel()
                                    ->columnSpan(1),
                            ]),
                    ]),
            ])
            ->columns(3);
    }
}
