<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Course Details')
                    ->description('Provide information about the course, department, and academic credits.')
                    ->schema([
                        Select::make('department_id')
                            ->relationship('department', 'name')
                            ->required()
                            ->placeholder('Select a department...')
                            ->prefixIcon('heroicon-o-academic-cap'),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Introduction to IT')
                            ->prefixIcon('heroicon-o-book-open'),
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g., INF-101')
                            ->prefixIcon('heroicon-o-qr-code')
                            ->unique(ignoreRecord: true),
                        TextInput::make('credits')
                            ->label('Credits (SKS)')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->placeholder('e.g., 3')
                            ->prefixIcon('heroicon-o-hashtag'),
                    ])
                    ->columns(2),
            ]);
    }
}
