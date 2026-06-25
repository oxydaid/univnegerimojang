<?php

namespace App\Filament\Resources\Rooms\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Room Details')
                    ->description('Set up the room name, building location, code, and student capacity.')
                    ->schema([
                        Select::make('building_id')
                            ->relationship('building', 'name')
                            ->required()
                            ->placeholder('Select a building...')
                            ->prefixIcon('heroicon-o-building-office'),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Room 101')
                            ->prefixIcon('heroicon-o-home'),
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g., R-101')
                            ->prefixIcon('heroicon-o-qr-code')
                            ->unique(ignoreRecord: true),
                        TextInput::make('capacity')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('e.g., 30')
                            ->prefixIcon('heroicon-o-users'),
                    ])
                    ->columns(2),
            ]);
    }
}
