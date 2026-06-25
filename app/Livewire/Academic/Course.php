<?php

namespace App\Livewire\Academic;

use App\Models\Course as CourseModel;
use Livewire\Component;

class Course extends Component
{
    public string $code;

    public function mount(string $code): void
    {
        $this->code = $code;
    }

    public function render()
    {
        $course = CourseModel::where('code', $this->code)
            ->with(['department.faculty', 'schedules.lecturer.user', 'schedules.room.building'])
            ->firstOrFail();

        return view('livewire.academic.course', [
            'course' => $course,
        ]);
    }
}
