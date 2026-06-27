<?php

namespace App\Filament\Resources\PartnerSchools;

use App\Filament\Resources\PartnerSchools\Pages\CreatePartnerSchool;
use App\Filament\Resources\PartnerSchools\Pages\EditPartnerSchool;
use App\Filament\Resources\PartnerSchools\Pages\ListPartnerSchools;
use App\Filament\Resources\PartnerSchools\Schemas\PartnerSchoolForm;
use App\Filament\Resources\PartnerSchools\Tables\PartnerSchoolsTable;
use App\Models\PartnerSchool;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PartnerSchoolResource extends Resource
{
    protected static ?string $model = PartnerSchool::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|\UnitEnum|null $navigationGroup = 'Academic Data';

    protected static ?string $navigationLabel = 'Mitra Sekolah';

    protected static ?string $pluralModelLabel = 'Mitra Sekolah';

    protected static ?string $modelLabel = 'Mitra Sekolah';

    public static function form(Schema $schema): Schema
    {
        return PartnerSchoolForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartnerSchoolsTable::configure($table);
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
            'index' => ListPartnerSchools::route('/'),
            'create' => CreatePartnerSchool::route('/create'),
            'edit' => EditPartnerSchool::route('/{record}/edit'),
        ];
    }
}
