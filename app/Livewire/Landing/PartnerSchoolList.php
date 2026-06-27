<?php

namespace App\Livewire\Landing;

use App\Models\PartnerSchool;
use Livewire\Component;

class PartnerSchoolList extends Component
{
    public function render()
    {
        $schools = PartnerSchool::latest()->get();

        return view('livewire.landing.partner-school-list', [
            'schools' => $schools,
        ])->title('Mitra Sekolah | UNEMO');
    }
}
