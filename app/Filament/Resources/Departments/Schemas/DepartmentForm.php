<?php

namespace App\Filament\Resources\Departments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DepartmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Department Details')
                    ->description('Specify the department information below.')
                    ->schema([
                        Select::make('faculty_id')
                            ->relationship('faculty', 'name')
                            ->required()
                            ->placeholder('Select a faculty...')
                            ->prefixIcon('heroicon-o-academic-cap'),
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Teknik Informatika')
                            ->prefixIcon('heroicon-o-book-open')
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        TextInput::make('slug')
                            ->required()
                            ->placeholder('e.g., teknik-informatika')
                            ->prefixIcon('heroicon-o-link')
                            ->unique(ignoreRecord: true)
                            ->disabled(fn (string $operation) => $operation !== 'create')
                            ->dehydrated(),
                        TextInput::make('code')
                            ->required()
                            ->placeholder('e.g., TI')
                            ->prefixIcon('heroicon-o-qr-code')
                            ->unique(ignoreRecord: true)
                            ->maxLength(4),
                    ])
                    ->columns(2),
            ]);
    }
}
