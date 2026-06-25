<?php

namespace App\Filament\Resources\Buildings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BuildingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Building Details')
                    ->description('Provide the building name and its unique identification code.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Gedung A')
                            ->prefixIcon('heroicon-o-building-office'),
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g., GDG-A')
                            ->prefixIcon('heroicon-o-qr-code')
                            ->unique(ignoreRecord: true),
                    ])
                    ->columns(2),
            ]);
    }
}
