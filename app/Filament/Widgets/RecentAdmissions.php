<?php

namespace App\Filament\Widgets;

use App\Models\Admission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentAdmissions extends TableWidget
{
    protected static ?string $heading = 'Pendaftaran Terbaru (SPMB)';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 4;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Admission::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('registration_number')
                    ->label('No. Pendaftaran')
                    ->fontFamily('mono'),
                TextColumn::make('name')
                    ->label('Nama Pendaftar'),
                TextColumn::make('path')
                    ->label('Jalur')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'nilai' => 'info',
                        'prestasi' => 'success',
                        'test' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => strtoupper($state)),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'PENDING',
                        'accepted' => 'DITERIMA',
                        'rejected' => 'DITOLAK',
                        default => strtoupper($state),
                    }),
                TextColumn::make('created_at')
                    ->label('Waktu Daftar')
                    ->dateTime('d M Y H:i'),
            ]);
    }
}
