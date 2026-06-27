<?php

namespace App\Filament\Resources\MinecraftServers\Pages;

use App\Filament\Resources\MinecraftServers\MinecraftServerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMinecraftServers extends ListRecords
{
    protected static string $resource = MinecraftServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
