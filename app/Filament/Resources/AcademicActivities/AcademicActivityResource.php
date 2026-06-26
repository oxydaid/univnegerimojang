<?php

namespace App\Filament\Resources\AcademicActivities;

use App\Filament\Resources\AcademicActivities\Pages\CreateAcademicActivity;
use App\Filament\Resources\AcademicActivities\Pages\EditAcademicActivity;
use App\Filament\Resources\AcademicActivities\Pages\ListAcademicActivities;
use App\Filament\Resources\AcademicActivities\Schemas\AcademicActivityForm;
use App\Filament\Resources\AcademicActivities\Tables\AcademicActivitiesTable;
use App\Models\AcademicActivity;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AcademicActivityResource extends Resource
{
    protected static ?string $model = AcademicActivity::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendar;

    protected static string|\UnitEnum|null $navigationGroup = 'Academic Data';

    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AcademicActivityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AcademicActivitiesTable::configure($table);
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
            'index' => ListAcademicActivities::route('/'),
            'create' => CreateAcademicActivity::route('/create'),
            'edit' => EditAcademicActivity::route('/{record}/edit'),
        ];
    }
}
