<?php

namespace App\Filament\Resources\MinecraftServers\Pages;

use App\Filament\Resources\MinecraftServers\MinecraftServerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMinecraftServer extends EditRecord
{
    protected static string $resource = MinecraftServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
