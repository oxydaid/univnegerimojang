<?php

namespace App\Filament\Resources\Lecturers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class LecturerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Lecturer Personal Info')
                    ->description('Associate the lecturer with a user account, department, and add personal details.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->placeholder('Select a user account...')
                            ->prefixIcon('heroicon-o-user'),
                        Select::make('department_id')
                            ->relationship('department', 'name')
                            ->required()
                            ->placeholder('Select a department...')
                            ->prefixIcon('heroicon-o-academic-cap'),
                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->placeholder('e.g., 198001012005011001')
                            ->prefixIcon('heroicon-o-identification')
                            ->unique(ignoreRecord: true),
                        TextInput::make('phone')
                            ->tel()
                            ->placeholder('e.g., 081234567890')
                            ->prefixIcon('heroicon-o-phone')
                            ->default(null),
                        TextInput::make('tiktok')
                            ->label('TikTok URL')
                            ->placeholder('e.g., https://tiktok.com/@steve')
                            ->prefixIcon('heroicon-o-link')
                            ->default(null),
                        Textarea::make('address')
                            ->placeholder('Enter full address here...')
                            ->default(null)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Media Assets')
                    ->description('Upload profile picture and Minecraft skin.')
                    ->schema([
                        FileUpload::make('photo')
                            ->image()
                            ->directory('lecturers')
                            ->default(null),
                        FileUpload::make('skin')
                            ->label('Minecraft Skin')
                            ->image()
                            ->directory('lecturer-skins')
                            ->rule(Rule::dimensions()->maxWidth(128)->maxHeight(128))
                            ->helperText('Minecraft Skin image (Max size 128x128 pixels)')
                            ->default(null),
                    ])
                    ->columns(2),
            ]);
    }
}
