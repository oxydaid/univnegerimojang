<?php

namespace App\Livewire\Academic;

use App\Models\Faculty as FacultyModel;
use Livewire\Component;

class Faculty extends Component
{
    public string $slug;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $faculty = FacultyModel::where('slug', $this->slug)
            ->with(['departments.courses', 'departments.lecturers.user', 'departments.students'])
            ->firstOrFail();

        // Calculate statistics
        $totalDepts = $faculty->departments->count();
        $totalCourses = $faculty->departments->sum(fn ($dept) => $dept->courses->count());

        $lecturerIds = [];
        $studentIds = [];
        foreach ($faculty->departments as $dept) {
            $lecturerIds = array_merge($lecturerIds, $dept->lecturers->pluck('id')->toArray());
            $studentIds = array_merge($studentIds, $dept->students->pluck('id')->toArray());
        }
        $totalLecturers = count(array_unique($lecturerIds));
        $totalStudents = count(array_unique($studentIds));

        return view('livewire.academic.faculty', [
            'faculty' => $faculty,
            'totalDepts' => $totalDepts,
            'totalCourses' => $totalCourses,
            'totalLecturers' => $totalLecturers,
            'totalStudents' => $totalStudents,
        ]);
    }
}
