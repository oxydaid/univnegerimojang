<?php

namespace App\Filament\Resources\PartnerSchools\Pages;

use App\Filament\Resources\PartnerSchools\PartnerSchoolResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPartnerSchools extends ListRecords
{
    protected static string $resource = PartnerSchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
