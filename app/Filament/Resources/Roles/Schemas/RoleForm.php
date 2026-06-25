<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Role Details')
                    ->description('Set up the role name and guard type.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('e.g., Academic Staff')
                            ->prefixIcon('heroicon-o-shield-check')
                            ->unique(ignoreRecord: true),
                        TextInput::make('guard_name')
                            ->required()
                            ->placeholder('e.g., web')
                            ->default('web')
                            ->prefixIcon('heroicon-o-cog'),
                    ])
                    ->columns(2),

                Section::make('Permissions Assignment')
                    ->description('Select the permissions allowed for this role.')
                    ->schema([
                        CheckboxList::make('permissions')
                            ->relationship('permissions', 'name')
                            ->searchable()
                            ->bulkToggleable()
                            ->columns(3),
                    ])->columnSpanFull(),
            ]);
    }
}
