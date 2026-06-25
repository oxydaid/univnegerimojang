<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Faculty extends Component
{
    public function render()
    {
        $faculties = \App\Models\Faculty::with('departments')->get();

        return view('livewire.landing.faculty', [
            'faculties' => $faculties,
        ]);
    }
}
