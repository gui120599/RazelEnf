<?php

namespace App\Filament\Pages\Tenancy;

use Dom\Text;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Laravel\Pail\File;

class EditTeamProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return __('Team profile');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profile Information')
                    ->translateLabel()
                    ->description("Update your teams profile information and email address.")
                    ->icon('heroicon-o-building-storefront')
                    ->components([
                        TextInput::make('name')
                            ->translateLabel(),
                        TextInput::make('slug')
                            ->translateLabel(),
                    ]),
                Section::make('Logo')
                    ->translateLabel()
                    ->components([
                        FileUpload::make('image')
                            ->label('Logo')
                            ->image()
                            ->disk('public'),
                    ])
            ])->columns(2);
    }
}
