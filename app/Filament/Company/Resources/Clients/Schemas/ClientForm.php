<?php

namespace App\Filament\Company\Resources\Clients\Schemas;

use App\Enums\TaxRegimeEnum;
use App\Enums\TypePersonEnum;
use App\Services\IBGEServices;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;
use Leandrocfe\FilamentPtbrFormFields\Document;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components(self::getComponents());
    }
    public static function getComponents(): array
    {
        return [
            Section::make(__('General'))
                ->schema([
                    Grid::make()
                        ->columns(5)
                        ->schema([
                            TextInput::make('name')
                                ->translateLabel()
                                ->required()
                                ->columnSpan(4),
                            Document::make('federalTaxNumber')
                                ->label(__('CPF/CNPJ'))
                                ->dynamic()
                                ->disabledOn(['edit'])
                                ->dehydrateStateUsing(fn($state): string => preg_replace('/\D/', '', $state))
                                ->live(onBlur: true)
                                ->afterStateUpdated(function (Set $set, $state) {
                                    if (!empty($state)) {
                                        $cleanDocument = preg_replace('/\D/', '', $state);
                                        // CPF tem 11 dígitos, CNPJ tem 14
                                        if (strlen($cleanDocument) === 11) {
                                            $set('personType', 'pf');
                                        } elseif (strlen($cleanDocument) === 14) {
                                            $set('personType', 'pj');
                                        }
                                    }
                                })
                                ->rule(function ($record) {
                                    return Rule::unique('clients', 'federalTaxNumber')
                                        ->ignore($record?->id);
                                })
                                ->columnSpan(1),
                            TextInput::make('email')
                                ->label('Email address')
                                ->translateLabel()
                                ->email()
                                ->columnSpan(1),
                            PhoneNumber::make('phone')
                                ->translateLabel()
                                ->columnSpan(1),
                        ]),
                ]),

            // Campos para Pessoa Física
            Section::make(__('Individual (CPF)'))
                ->icon('heroicon-o-user')
                ->visible(fn(Get $get) => $get('personType') === 'pf')
                ->schema([
                    Grid::make()
                        ->columns(2)
                        ->schema([
                            TextInput::make('tradeName')
                                ->label(__('Social Name (Optional)'))
                                ->translateLabel()
                                ->columnSpan('full'),
                        ]),
                ]),

            // Campos para Pessoa Jurídica
            Section::make(__('Legal Entity (CNPJ)'))
                ->icon('heroicon-o-building-office-2')
                ->visible(fn(Get $get) => $get('personType') === 'pj')
                ->schema([
                    Grid::make()
                        ->columns(2)
                        ->schema([
                            TextInput::make('tradeName')
                                ->translateLabel()
                                ->required()
                                ->columnSpan(1),
                            Select::make('state')
                                ->translateLabel()
                                ->options(fn() => IBGEServices::ufs())
                                ->preload()
                                ->searchable()
                                ->columnSpan(1),
                            TextInput::make('stateTaxNumber')
                                ->translateLabel()
                                ->columnSpan(1),
                            Select::make('taxRegime')
                                ->options(fn() => TaxRegimeEnum::options())
                                ->translateLabel()
                                ->columnSpan(1),
                        ]),
                ]),

            // Campo hidden para personType
            Hidden::make('personType')
                ->default('pf'),
            Section::make(__('Address'))
                ->description(__('Record the addresses that the customer may have.'))
                ->icon('heroicon-o-map')
                ->schema([
                    Repeater::make('clientAdreess')
                        ->relationship('addresses')
                        ->columns(5)
                        ->schema([
                            TextInput::make('postalCode')
                                ->helperText(__('While typing, please wait for the address to be searched.'))
                                ->columnSpan(1)
                                ->translateLabel()
                                ->mask('99999-999')
                                ->live() // Garante que as mudanças no campo disparem a ação.
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $cepLimpo = preg_replace('/[^0-9]/', '', $state);
                                    if (strlen($cepLimpo) === 8) {
                                        $dadosEndereco = IBGEServices::buscaCep($cepLimpo);

                                        if (!empty($dadosEndereco)) {
                                            $set('street', $dadosEndereco['logradouro'] ?? '');
                                            $set('district', $dadosEndereco['bairro'] ?? '');
                                            $set('state', $dadosEndereco['uf'] ?? '');
                                            $set('nameCity', $dadosEndereco['localidade'] ?? '');
                                            $set('codeCity', $dadosEndereco['ibge'] ?? '');
                                        } else {
                                            $set('street', '');
                                            $set('district', '');
                                            $set('state', '');
                                            $set('nameCity', '');
                                            $set('codeCity', '');
                                        }
                                    }
                                })
                                ->columnSpan(1),
                            TextInput::make('street')
                                ->translateLabel()
                                ->columnSpan(3),
                            TextInput::make('number')
                                ->translateLabel()
                                ->default('S/N')
                                ->columnSpan(1),
                            TextInput::make('additionalInformation')
                                ->translateLabel()
                                ->columnSpan('full'),
                            TextInput::make('district')
                                ->translateLabel()
                                ->columnSpan(2),
                            Select::make('state')
                                ->translateLabel()
                                ->options(fn() => IBGEServices::ufs())
                                ->preload()
                                ->searchable()
                                ->live() // <- necessário para o nameCity reagir
                                ->afterStateUpdated(fn(Set $set) => $set('nameCity', null)) // limpa cidade ao trocar estado
                                ->columnSpan(1),
                            TextInput::make('codeCity')
                                ->translateLabel()
                                ->hidden()
                                ->saved()
                                ->columnSpan(1),
                            Select::make('nameCity')
                                ->translateLabel()
                                ->preload()
                                ->searchable()
                                ->options(function (Get $get) {
                                    $uf = $get('state');
                                    if (empty($uf)) {
                                        return [];
                                    }
                                    return IBGEServices::cidadesPorUf($uf);
                                })
                                ->columnSpan(1),
                            TextInput::make('country')
                                ->translateLabel()
                                ->default('Brasil')
                                ->columnSpan(1),
                        ]),
                ]),


        ];
    }
}
