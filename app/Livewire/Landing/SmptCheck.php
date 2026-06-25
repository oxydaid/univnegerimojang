<?php

namespace App\Livewire\Landing;

use App\Models\Admission;
use Livewire\Component;

class SmptCheck extends Component
{
    public string $registration_number = '';

    public ?Admission $admission = null;

    public bool $searched = false;

    public function mount()
    {
        if (session()->has('success_registration')) {
            $this->registration_number = session('success_registration');
            $this->checkStatus();
        }
    }

    public function render()
    {
        return view('livewire.landing.smpt-check')->layout('layouts.app');
    }

    public function checkStatus()
    {
        $this->validate([
            'registration_number' => 'required|string|max:50',
        ]);

        $admission = Admission::where('registration_number', trim($this->registration_number))->first();

        if (! $admission) {
            $this->addError('registration_number', 'Nomor pendaftaran tidak ditemukan! Pastikan kode yang dimasukkan benar.');
            $this->admission = null;
            $this->searched = true;

            return;
        }

        $this->admission = $admission;
        $this->searched = true;
    }

    public function resetSearch()
    {
        $this->registration_number = '';
        $this->admission = null;
        $this->searched = false;
        $this->resetErrorBag();
    }
}
