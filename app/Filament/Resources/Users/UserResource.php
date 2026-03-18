<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Enums\ColumnManagerResetActionPosition;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'name';

        public static function getModelLabel(): string
    {
        return __('User');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Users');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->translateLabel()
                    ->schema([
                        FileUpload::make('avatar_url')
                            ->disk('public')
                            ->directory('avatars')
                            ->label('Avatar')
                            ->avatar(),
                        TextInput::make('name')
                            ->required()
                            ->translateLabel()
                            ->autocomplete(false),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->autocomplete(false),
                        TextInput::make('password')
                            ->password()
                            ->translateLabel()
                            ->required(fn(string $operation): bool => $operation === 'create')
                            ->dehydrated(fn(?string $state) => filled($state))
                            ->confirmed()
                            ->autocomplete('new-password'),
                        TextInput::make('password_confirmation')
                            ->translateLabel()
                            ->password()
                            ->requiredWith('password')
                            ->dehydrated(false),
                        Toggle::make('is_superAdmin')
                            ->translateLabel()
                            ->default('0'),
                        Select::make('teams')
                            ->label('Empresas')
                            ->relationship('teams', 'name')
                            ->searchable()
                            ->multiple()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('slug'),
                            ]),
                    ])
            ])
            ->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Image')
                    ->toggleable()
                    ->disk('public')
                    ->rounded()
                    ->translateLabel(),
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->sortable()
                    ->translateLabel(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->toggleable()
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),
                ToggleColumn::make('is_superAdmin')
                    ->toggleable()
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->translateLabel(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable()
                    ->translateLabel(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderableColumns();
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUsers::route('/'),
        ];
    }
}
