<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Academic Year Details')
                    ->description('Set up the academic year information and active status.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., 2026/2027 Ganjil')
                            ->prefixIcon('heroicon-o-calendar')
                            ->unique(ignoreRecord: true),
                        Toggle::make('is_active')
                            ->required()
                            ->default(false),
                    ])
                    ->columns(2),
            ]);
    }
}
