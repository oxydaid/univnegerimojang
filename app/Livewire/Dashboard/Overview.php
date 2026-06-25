<?php

namespace App\Livewire\Dashboard;

use App\Models\Schedule;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Overview extends Component
{
    /**
     * Render the component view with appropriate user stats and schedules.
     */
    public function render(): View
    {
        $user = auth()->user();
        $schedules = collect();

        if ($user) {
            $dayOrder = "CASE 
                WHEN day_of_week = 'Senin' THEN 1 
                WHEN day_of_week = 'Selasa' THEN 2 
                WHEN day_of_week = 'Rabu' THEN 3 
                WHEN day_of_week = 'Kamis' THEN 4 
                WHEN day_of_week = 'Jumat' THEN 5 
                WHEN day_of_week = 'Sabtu' THEN 6 
                ELSE 7 
            END";

            if ($user->student) {
                // Fetch schedules for courses in student's department
                $schedules = Schedule::whereHas('course', function ($query) use ($user) {
                    $query->where('department_id', $user->student->department_id);
                })->with(['course', 'lecturer.user', 'room'])
                    ->orderByRaw($dayOrder)
                    ->orderBy('start_time')
                    ->get();
            } elseif ($user->lecturer) {
                // Fetch schedules assigned directly to the lecturer
                $schedules = Schedule::where('lecturer_id', $user->lecturer->id)
                    ->with(['course', 'room'])
                    ->orderByRaw($dayOrder)
                    ->orderBy('start_time')
                    ->get();
            } elseif ($user->staff || $user->hasRole('Super Admin')) {
                // Fetch all schedules for overview
                $schedules = Schedule::with(['course', 'lecturer.user', 'room'])
                    ->orderByRaw($dayOrder)
                    ->orderBy('start_time')
                    ->take(10)
                    ->get();
            }
        }

        return view('livewire.dashboard.overview', [
            'user' => $user,
            'schedules' => $schedules,
        ]);
    }
}
