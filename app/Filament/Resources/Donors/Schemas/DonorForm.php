<?php

namespace App\Filament\Resources\Donors\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DonorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Donatur')
                    ->description('Masukkan rincian informasi donasi dari donatur.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Donatur')
                            ->required()
                            ->placeholder('e.g., Steve Steve')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('amount')
                            ->label('Jumlah Donasi (Rp)')
                            ->numeric()
                            ->required()
                            ->placeholder('e.g., 50000')
                            ->prefix('Rp')
                            ->prefixIcon('heroicon-o-currency-dollar'),
                        DateTimePicker::make('donated_at')
                            ->label('Tanggal Donasi')
                            ->required()
                            ->default(now())
                            ->prefixIcon('heroicon-o-calendar'),
                        Toggle::make('is_visible')
                            ->label('Tampilkan di Halaman Publik')
                            ->default(true),
                        Textarea::make('message')
                            ->label('Pesan / Ucapan')
                            ->placeholder('Tulis pesan hangat dari donatur...')
                            ->columnSpanFull()
                            ->default(null),
                    ])
                    ->columns(2),
            ]);
    }
}
