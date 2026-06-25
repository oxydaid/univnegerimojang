<?php

namespace App\Livewire\Landing;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Student;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $studentCount = Student::count();
        $facultyCount = Faculty::count();
        $departmentCount = Department::count();
        $lecturerCount = Lecturer::count();

        return view('livewire.landing.home', [
            'studentCount' => $studentCount,
            'facultyCount' => $facultyCount,
            'departmentCount' => $departmentCount,
            'lecturerCount' => $lecturerCount,
        ]);
    }
}
