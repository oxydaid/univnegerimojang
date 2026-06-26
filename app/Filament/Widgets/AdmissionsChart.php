<?php

namespace App\Filament\Widgets;

use App\Models\Admission;
use Filament\Widgets\ChartWidget;

class AdmissionsChart extends ChartWidget
{
    protected ?string $heading = 'Status Pendaftaran SPMB';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $pending = Admission::where('status', 'pending')->count();
        $accepted = Admission::where('status', 'accepted')->count();
        $rejected = Admission::where('status', 'rejected')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pendaftar',
                    'data' => [$pending, $accepted, $rejected],
                    'backgroundColor' => [
                        '#fbbf24', // Amber/Warning for Pending
                        '#10b981', // Emerald/Success for Accepted
                        '#ef4444', // Red/Danger for Rejected
                    ],
                ],
            ],
            'labels' => ['Pending', 'Diterima', 'Ditolak'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
