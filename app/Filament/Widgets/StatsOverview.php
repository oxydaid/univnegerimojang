<?php

namespace App\Filament\Widgets;

use App\Models\Admission;
use App\Models\Department;
use App\Models\Lecturer;
use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Mahasiswa', Student::count())
                ->description('Mahasiswa terdaftar aktif')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
            Stat::make('Total Dosen', Lecturer::count())
                ->description('Dosen pengajar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),
            Stat::make('Pendaftar SPMB (Pending)', Admission::where('status', 'pending')->count())
                ->description('Menunggu verifikasi berkas')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('warning'),
            Stat::make('Program Studi', Department::count())
                ->description('Jurusan yang tersedia')
                ->descriptionIcon('heroicon-m-bookmark-square')
                ->color('primary'),
        ];
    }
}
