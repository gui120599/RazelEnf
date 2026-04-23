<?php

namespace App\Filament\Company\Resources\ClassificacaoEventos\Schemas;

use Dom\Text;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Repeater\TableColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Laravel\Prompts\Grid;

class ClassificacaoEventoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Dados da classificação')
                    ->schema([
                        TextInput::make('name')
                            ->translateLabel()
                            ->required(),
                        Textarea::make('description')
                            ->translateLabel()
                            ->columnSpanFull(),
                        Toggle::make('listar_no_formulario')
                            ->translateLabel(),
                    ])
                    ->columnSpan(1),
                Repeater::make('descricoes')
                    ->relationship('descricoes')
                    ->label(__('Classification descriptions'))
                    ->translateLabel()
                    ->orderColumn('order')
                    ->addActionLabel(__('Add description'))
                    ->table([
                        TableColumn::make('Descrição'),
                    ])
                    ->schema([
                        TextInput::make('descricao')

                            ->translateLabel()
                            ->required(),
                    ])
                    ->columnSpan(1)
            ])->columns(2);
    }
}
