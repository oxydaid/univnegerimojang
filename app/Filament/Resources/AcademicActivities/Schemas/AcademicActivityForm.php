<?php

namespace App\Filament\Resources\AcademicActivities\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicActivityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kegiatan')
                    ->description('Detail kegiatan kalender akademik.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(255),
                        Select::make('type')
                            ->label('Tipe Kegiatan')
                            ->options([
                                'registration' => 'Pendaftaran / Penerimaan',
                                'exam' => 'Ujian / Tes',
                                'holiday' => 'Libur Akademik',
                                'other' => 'Kegiatan Lainnya',
                            ])
                            ->required(),
                        DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required(),
                        DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->afterOrEqual('start_date'),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Aktif / Tampilkan')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
