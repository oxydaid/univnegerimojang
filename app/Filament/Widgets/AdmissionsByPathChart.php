<?php

namespace App\Filament\Widgets;

use App\Models\Admission;
use Filament\Widgets\ChartWidget;

class AdmissionsByPathChart extends ChartWidget
{
    protected ?string $heading = 'Pendaftaran Berdasarkan Jalur';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $nilai = Admission::where('path', 'nilai')->count();
        $prestasi = Admission::where('path', 'prestasi')->count();
        $test = Admission::where('path', 'test')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => [$nilai, $prestasi, $test],
                    'backgroundColor' => [
                        '#3b82f6', // Blue for Nilai
                        '#10b981', // Emerald for Prestasi
                        '#f59e0b', // Amber for Test
                    ],
                ],
            ],
            'labels' => ['Nilai Rapor', 'Prestasi', 'Ujian Survival'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
