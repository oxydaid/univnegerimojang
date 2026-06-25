<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('User Account Details')
                    ->description('Provide the details for this user account.')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->placeholder('Enter user name...')
                            ->prefixIcon('heroicon-o-user'),
                        TextInput::make('email')
                            ->label('Email address')
                            ->email()
                            ->required()
                            ->placeholder('email@example.com')
                            ->prefixIcon('heroicon-o-envelope'),
                        DateTimePicker::make('email_verified_at')
                            ->label('Email Verified At')
                            ->placeholder('Select verification date'),
                        TextInput::make('password')
                            ->password()
                            ->required(fn (string $operation) => $operation === 'create')
                            ->dehydrated(fn (?string $state) => filled($state))
                            ->placeholder('••••••••')
                            ->prefixIcon('heroicon-o-key'),
                        CheckboxList::make('roles')
                            ->relationship('roles', 'name')
                            ->columns(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
