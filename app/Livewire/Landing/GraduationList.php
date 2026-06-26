<?php

namespace App\Livewire\Landing;

use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class GraduationList extends Component
{
    use WithPagination;

    public string $search = '';

    public ?int $department_id = null;

    public string $path = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'department_id' => ['except' => null],
        'path' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingDepartmentId(): void
    {
        $this->resetPage();
    }

    public function updatingPath(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $settings = AppSetting::first();
        $departments = Department::orderBy('name')->get();

        $admissions = [];
        if ($settings && $settings->graduation_list_published) {
            $query = Admission::query()
                ->where('status', 'accepted')
                ->with('department');

            if (! empty($this->search)) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('registration_number', 'like', '%'.$this->search.'%');
                });
            }

            if ($this->department_id) {
                $query->where('department_id', $this->department_id);
            }

            if (! empty($this->path)) {
                $query->where('path', $this->path);
            }

            $admissions = $query->latest()->paginate(10);
        }

        return view('livewire.landing.graduation-list', [
            'settings' => $settings,
            'departments' => $departments,
            'admissions' => $admissions,
        ])->layout('layouts.app');
    }
}
