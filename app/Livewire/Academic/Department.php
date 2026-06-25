<?php

namespace App\Livewire\Academic;

use App\Models\Department as DepartmentModel;
use Livewire\Component;

class Department extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $department = DepartmentModel::where('slug', $this->slug)
            ->with(['faculty', 'courses', 'lecturers.user', 'students.user'])
            ->firstOrFail();

        // Calculate statistics
        $totalCourses = $department->courses->count();
        $totalCredits = $department->courses->sum('credits');
        $totalLecturers = $department->lecturers->count();
        $totalStudents = $department->students->count();

        return view('livewire.academic.department', [
            'department' => $department,
            'totalCourses' => $totalCourses,
            'totalCredits' => $totalCredits,
            'totalLecturers' => $totalLecturers,
            'totalStudents' => $totalStudents,
        ]);
    }
}
