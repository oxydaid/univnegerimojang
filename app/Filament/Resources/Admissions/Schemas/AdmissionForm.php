<?php

namespace App\Filament\Resources\Admissions\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class AdmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pendaftar')
                    ->description('Data personal calon mahasiswa baru.')
                    ->schema([
                        TextInput::make('registration_number')
                            ->label('Nomor Pendaftaran')
                            ->disabled()
                            ->dehydrated(),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->placeholder('Nama lengkap calon mahasiswa'),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required(),

                        TextInput::make('phone')
                            ->label('No. Telepon / Radio')
                            ->required(),

                        TextInput::make('high_school')
                            ->label('Asal Sekolah (Negeri Mojang)')
                            ->required()
                            ->placeholder('e.g., SMAN 1 Mojang'),

                        Select::make('department_id')
                            ->label('Pilihan Program Studi')
                            ->relationship('department', 'name')
                            ->required(),

                        Select::make('path')
                            ->label('Jalur Pendaftaran')
                            ->options([
                                'prestasi' => 'Jalur Prestasi',
                                'nilai' => 'Jalur Nilai (SS Rapot/Statistik)',
                                'test' => 'Jalur Ujian Online (Test)',
                                'beasiswa' => 'Jalur Beasiswa Ordal (Orang Dalam)',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Seleksi & Status Kelulusan')
                    ->description('Kelola penilaian ujian dan status penerimaan di sini.')
                    ->schema([
                        TextInput::make('test_score')
                            ->label('Nilai Ujian / Skor')
                            ->numeric()
                            ->placeholder('e.g., 85'),

                        Select::make('status')
                            ->label('Status Kelulusan')
                            ->options([
                                'pending' => 'PENDING (Dalam Review)',
                                'accepted' => 'DITERIMA (Lulus)',
                                'rejected' => 'DITOLAK (Gagal)',
                            ])
                            ->required(),

                        Textarea::make('status_notes')
                            ->label('Catatan Kelulusan (Tampil ke Mahasiswa)')
                            ->placeholder('Tuliskan alasan penolakan atau ucapan selamat...')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Dokumen Pendukung')
                    ->description('Berkas Minecraft yang diunggah oleh pendaftar.')
                    ->schema([
                        TextInput::make('documents.ordal_code')
                            ->label('Kode Referensi Orang Dalam (Ordal)')
                            ->disabled()
                            ->placeholder('Tidak menggunakan kode ordal'),

                        Placeholder::make('doc_skin')
                            ->label('Minecraft Skin')
                            ->content(fn ($record) => $record && $record->getDocumentUrl('skin')
                                ? new HtmlString('<div class="mt-1"><a href="'.$record->getDocumentUrl('skin').'" target="_blank" class="inline-flex items-center text-primary hover:underline font-bold text-xs"><i class="fa-solid fa-eye mr-1"></i> Lihat Skin Fullsize</a><br><img src="'.$record->getDocumentUrl('skin').'" class="h-24 w-auto object-contain border border-slate-200 mt-2 bg-slate-100 p-1" /></div>')
                                : 'Tidak ada berkas skin'),

                        Placeholder::make('doc_minecraft_stats')
                            ->label('Screenshot Profil Statistik (Rapot)')
                            ->content(fn ($record) => $record && $record->getDocumentUrl('minecraft_stats')
                                ? new HtmlString('<div class="mt-1"><a href="'.$record->getDocumentUrl('minecraft_stats').'" target="_blank" class="inline-flex items-center text-primary hover:underline font-bold text-xs"><i class="fa-solid fa-eye mr-1"></i> Lihat SS Statistik Fullsize</a><br><img src="'.$record->getDocumentUrl('minecraft_stats').'" class="h-24 w-auto object-cover border border-slate-200 mt-2" /></div>')
                                : 'Tidak ada berkas rapot'),

                        Placeholder::make('doc_certificate')
                            ->label('Ijazah Kelulusan SMA/SMK/MAN Mojang')
                            ->content(fn ($record) => $record && $record->getDocumentUrl('certificate')
                                ? new HtmlString('<div class="mt-1"><a href="'.$record->getDocumentUrl('certificate').'" target="_blank" class="inline-flex items-center text-primary hover:underline font-bold text-xs"><i class="fa-solid fa-eye mr-1"></i> Lihat Ijazah Fullsize</a><br><img src="'.$record->getDocumentUrl('certificate').'" class="h-24 w-auto object-cover border border-slate-200 mt-2" /></div>')
                                : 'Tidak ada berkas ijazah'),

                        Placeholder::make('doc_achievement_proof')
                            ->label('Bukti Prestasi / Sertifikat')
                            ->content(fn ($record) => $record && $record->getDocumentUrl('achievement_proof')
                                ? new HtmlString('<div class="mt-1"><a href="'.$record->getDocumentUrl('achievement_proof').'" target="_blank" class="inline-flex items-center text-primary hover:underline font-bold text-xs"><i class="fa-solid fa-eye mr-1"></i> Lihat Bukti Prestasi Fullsize</a><br><img src="'.$record->getDocumentUrl('achievement_proof').'" class="h-24 w-auto object-cover border border-slate-200 mt-2" /></div>')
                                : 'Tidak ada berkas prestasi'),
                    ])
                    ->columns(2),
            ]);
    }
}
