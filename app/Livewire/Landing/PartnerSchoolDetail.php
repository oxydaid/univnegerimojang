<?php

namespace App\Livewire\Landing;

use App\Models\PartnerSchool;
use Livewire\Component;

class PartnerSchoolDetail extends Component
{
    public PartnerSchool $school;

    public function mount(string $slug): void
    {
        $school = PartnerSchool::where('slug', $slug)->first();

        if (! $school) {
            abort(404);
        }

        $this->school = $school;
    }

    public function render()
    {
        return view('livewire.landing.partner-school-detail', [
            'school' => $this->school,
        ])->title($this->school->name.' | UNEMO');
    }
}
