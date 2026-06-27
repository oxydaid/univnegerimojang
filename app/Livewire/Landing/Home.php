<?php

namespace App\Livewire\Landing;

use App\Models\AcademicActivity;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\MinecraftServer;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Home extends Component
{
    public function render(): View
    {
        $studentCount = Student::count();
        $facultyCount = Faculty::count();
        $departmentCount = Department::count();
        $lecturerCount = Lecturer::count();

        $upcomingActivities = AcademicActivity::query()
            ->where('is_active', true)
            ->where('end_date', '>=', now()->startOfDay())
            ->orderBy('start_date', 'asc')
            ->limit(2)
            ->get();

        $servers = MinecraftServer::where('is_active', true)->get();

        return view('livewire.landing.home', [
            'studentCount' => $studentCount,
            'facultyCount' => $facultyCount,
            'departmentCount' => $departmentCount,
            'lecturerCount' => $lecturerCount,
            'upcomingActivities' => $upcomingActivities,
            'servers' => $servers,
        ]);
    }
}
