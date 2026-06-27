<?php

namespace App\Filament\Resources\MinecraftServers\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MinecraftServerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Minecraft Server Info')
                    ->description('Masukkan rincian informasi server Minecraft.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Server')
                            ->required()
                            ->placeholder('e.g., Survival Overworld')
                            ->prefixIcon('heroicon-o-chat-bubble-bottom-center-text'),
                        TextInput::make('ip')
                            ->label('Server IP / Host')
                            ->required()
                            ->placeholder('e.g., play.unemo.ac.id')
                            ->prefixIcon('heroicon-o-globe-alt'),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Konfigurasi Port')
                    ->description('Tambahkan port koneksi untuk Java Edition dan/atau Bedrock Edition.')
                    ->schema([
                        Repeater::make('ports')
                            ->label('Port List')
                            ->schema([
                                Select::make('type')
                                    ->label('Tipe Edisi')
                                    ->options([
                                        'java' => 'Java Edition',
                                        'bedrock' => 'Bedrock Edition',
                                    ])
                                    ->required(),
                                TextInput::make('port')
                                    ->label('Nomor Port')
                                    ->numeric()
                                    ->required()
                                    ->placeholder('e.g., 25565 atau 19132'),
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->default([
                                ['type' => 'java', 'port' => 25565],
                            ]),
                    ]),
            ]);
    }
}
