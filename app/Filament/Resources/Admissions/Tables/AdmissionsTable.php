<?php

namespace App\Filament\Resources\Admissions\Tables;

use App\Mail\AdmissionNotificationMail;
use App\Models\Admission;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class AdmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('registration_number')
                    ->label('No. Daftar')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('high_school')
                    ->label('Asal Sekolah')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('department.name')
                    ->label('Prodi Pilihan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('path')
                    ->label('Jalur')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'prestasi' => '🏆 Prestasi',
                        'nilai' => '📊 Nilai Rapot',
                        'test' => '📝 Ujian Online',
                        'beasiswa' => '💎 Beasiswa Kemitraan',
                        default => $state,
                    })
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'prestasi' => 'info',
                        'nilai' => 'warning',
                        'test' => 'success',
                        'beasiswa' => 'primary',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('test_score')
                    ->label('Skor Ujian')
                    ->placeholder('Belum Ujian')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => '⏳ PENDING',
                        'accepted' => '✅ DITERIMA',
                        'rejected' => '❌ DITOLAK',
                        default => strtoupper($state),
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Daftar')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status Kelulusan')
                    ->options([
                        'pending' => '⏳ PENDING',
                        'accepted' => '✅ DITERIMA',
                        'rejected' => '❌ DITOLAK',
                    ]),
                SelectFilter::make('path')
                    ->label('Jalur Masuk')
                    ->options([
                        'prestasi' => '🏆 Jalur Prestasi',
                        'nilai' => '📊 Jalur Nilai Rapot',
                        'test' => '📝 Jalur Ujian Online',
                        'beasiswa' => '💎 Jalur Beasiswa Kemitraan',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('send_notification')
                    ->label('Kirim Notifikasi')
                    ->icon(Heroicon::OutlinedEnvelope)
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (Admission $record): bool => in_array($record->status, ['accepted', 'rejected']))
                    ->action(function (Admission $record) {
                        try {
                            Mail::to($record->email)->send(
                                new AdmissionNotificationMail($record)
                            );

                            Notification::make()
                                ->success()
                                ->title('Email notifikasi berhasil dikirim!')
                                ->body('Notifikasi kelulusan telah dikirim ke '.$record->email)
                                ->send();
                        } catch (\Throwable $e) {
                            Notification::make()
                                ->danger()
                                ->title('Gagal mengirim email: '.$e->getMessage())
                                ->send();
                        }
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
