<?php

namespace App\Filament\Resources\AcademicActivities\Pages;

use App\Filament\Resources\AcademicActivities\AcademicActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicActivities extends ListRecords
{
    protected static string $resource = AcademicActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
