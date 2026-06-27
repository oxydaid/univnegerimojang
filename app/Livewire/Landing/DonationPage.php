<?php

namespace App\Livewire\Landing;

use App\Models\Donor;
use Livewire\Component;

class DonationPage extends Component
{
    public function render()
    {
        $donors = Donor::where('is_visible', true)
            ->latest('donated_at')
            ->get();

        return view('livewire.landing.donation-page', [
            'donors' => $donors,
        ])->title('Dukungan & Donasi | UNEMO');
    }
}
