<?php

namespace App\Filament\Resources\Faculties\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class FacultyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Faculty Details')
                    ->description('Specify the faculty information below.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Fakultas Teknik')
                            ->prefixIcon('heroicon-o-academic-cap')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->placeholder('e.g., fakultas-teknik')
                            ->prefixIcon('heroicon-o-link')
                            ->unique(ignoreRecord: true)
                            ->disabled(fn (string $operation) => $operation !== 'create')
                            ->dehydrated(),
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g., FT')
                            ->prefixIcon('heroicon-o-qr-code')
                            ->unique(ignoreRecord: true)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
