<?php

namespace App\Filament\Resources\AcademicActivities\Pages;

use App\Filament\Resources\AcademicActivities\AcademicActivityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicActivity extends EditRecord
{
    protected static string $resource = AcademicActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
