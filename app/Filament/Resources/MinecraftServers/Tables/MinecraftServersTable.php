<?php

namespace App\Filament\Resources\MinecraftServers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MinecraftServersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Server')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ip')
                    ->label('Server IP / Host')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('ports')
                    ->label('Ports')
                    ->formatStateUsing(function ($state) {
                        if (! is_array($state)) {
                            return '-';
                        }

                        return collect($state)->map(fn ($p) => strtoupper($p['type']).': '.$p['port'])->join(', ');
                    }),
                IconColumn::make('is_active')
                    ->label('Aktif')
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
