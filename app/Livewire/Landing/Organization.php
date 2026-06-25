<?php

namespace App\Livewire\Landing;

use App\Models\Staff;
use Livewire\Component;

class Organization extends Component
{
    public function render()
    {
        $staff = Staff::with('user')
            ->get()
            ->sortBy(function ($s) {
                $pos = strtolower($s->position);
                if (str_contains($pos, 'rektor') && ! str_contains($pos, 'wakil')) {
                    return 1;
                }
                if (str_contains($pos, 'wakil rektor')) {
                    return 2;
                }
                if (str_contains($pos, 'dekan')) {
                    return 3;
                }

                return 4;
            });

        return view('livewire.landing.organization', [
            'staff' => $staff,
        ]);
    }
}
