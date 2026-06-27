<?php

namespace App\Filament\Resources\MinecraftServers;

use App\Filament\Resources\MinecraftServers\Pages\CreateMinecraftServer;
use App\Filament\Resources\MinecraftServers\Pages\EditMinecraftServer;
use App\Filament\Resources\MinecraftServers\Pages\ListMinecraftServers;
use App\Filament\Resources\MinecraftServers\Schemas\MinecraftServerForm;
use App\Filament\Resources\MinecraftServers\Tables\MinecraftServersTable;
use App\Models\MinecraftServer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MinecraftServerResource extends Resource
{
    protected static ?string $model = MinecraftServer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedServer;

    protected static string|\UnitEnum|null $navigationGroup = 'Infrastructure';

    protected static ?string $navigationLabel = 'Minecraft Server';

    protected static ?string $pluralModelLabel = 'Minecraft Server';

    protected static ?string $modelLabel = 'Minecraft Server';

    public static function form(Schema $schema): Schema
    {
        return MinecraftServerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MinecraftServersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMinecraftServers::route('/'),
            'create' => CreateMinecraftServer::route('/create'),
            'edit' => EditMinecraftServer::route('/{record}/edit'),
        ];
    }
}
