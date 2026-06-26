<?php

namespace App\Livewire\Landing;

use App\Models\AcademicActivity;
use Carbon\Carbon;
use Livewire\Component;

class AcademicCalendar extends Component
{
    public function render()
    {
        $activities = AcademicActivity::query()
            ->where('is_active', true)
            ->where('end_date', '>=', Carbon::today())
            ->orderBy('start_date', 'asc')
            ->get();

        return view('livewire.landing.academic-calendar', [
            'activities' => $activities,
        ])->layout('layouts.app');
    }
}
