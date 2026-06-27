<?php

namespace App\Filament\Resources\PartnerSchools\Pages;

use App\Filament\Resources\PartnerSchools\PartnerSchoolResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPartnerSchool extends EditRecord
{
    protected static string $resource = PartnerSchoolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
