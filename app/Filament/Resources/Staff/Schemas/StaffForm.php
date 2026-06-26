<?php

namespace App\Filament\Resources\Staff\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rule;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Staff Personal Info')
                    ->description('Associate the staff member with a user account, and specify details.')
                    ->schema([
                        Select::make('user_id')
                            ->relationship('user', 'name')
                            ->required()
                            ->placeholder('Select a user account...')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('nip')
                            ->label('NIP')
                            ->required()
                            ->placeholder('e.g., 198505122010032002')
                            ->prefixIcon('heroicon-o-identification')
                            ->unique(ignoreRecord: true),
                        TextInput::make('position')
                            ->placeholder('e.g., Admin Akademik')
                            ->prefixIcon('heroicon-o-briefcase')
                            ->default(null),
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
                            ->disk('public')
                            ->directory('staff')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                            ->default(null),
                        FileUpload::make('skin')
                            ->label('Minecraft Skin')
                            ->image()
                            ->disk('public')
                            ->directory('staff-skins')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                            ->rule(Rule::dimensions()->maxWidth(128)->maxHeight(128))
                            ->helperText('Minecraft Skin image (Max size 128x128 pixels)')
                            ->default(null),
                    ])
                    ->columns(2),
            ]);
    }
}
