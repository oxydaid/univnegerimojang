<?php

namespace App\Filament\Resources\PartnerSchools\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PartnerSchoolForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Sekolah Mitra')
                    ->description('Masukkan detail informasi tentang sekolah yang bekerja sama dengan kampus.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Sekolah')
                            ->required()
                            ->placeholder('e.g., SMAN 1 Mojang')
                            ->prefixIcon('heroicon-o-academic-cap')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($set, $state) => $set('slug', Str::slug($state))),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->placeholder('Auto-generated from name')
                            ->prefixIcon('heroicon-o-link')
                            ->unique(ignoreRecord: true)
                            ->readOnly(),
                        TextInput::make('tiktok_link')
                            ->label('Link TikTok')
                            ->placeholder('e.g., https://tiktok.com/@sman1mojang')
                            ->prefixIcon('heroicon-o-link')
                            ->url()
                            ->default(null),
                        FileUpload::make('logo')
                            ->label('Logo / Gambar Sekolah')
                            ->image()
                            ->disk('public')
                            ->directory('schools')
                            ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                            ->default(null)
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->placeholder('Tulis deskripsi detail kerja sama sekolah...')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }
}
