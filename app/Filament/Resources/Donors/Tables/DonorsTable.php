<?php

namespace App\Filament\Resources\Donors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DonorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Donatur')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('amount')
                    ->label('Jumlah Donasi')
                    ->money('IDR', locale: 'id')
                    ->sortable(),
                TextColumn::make('donated_at')
                    ->label('Tanggal Donasi')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                IconColumn::make('is_visible')
                    ->label('Tampil Publik')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
