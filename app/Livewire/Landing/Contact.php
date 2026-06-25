<?php

namespace App\Livewire\Landing;

use App\Mail\ContactFormMail;
use App\Models\AppSetting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Contact extends Component
{
    public string $name = '';

    public string $email = '';

    public string $subject = '';

    public string $message = '';

    protected array $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        $settings = AppSetting::first();
        $recipient = $settings?->email ?? 'admin@unemo.ac.id';

        try {
            Mail::to($recipient)->send(
                new ContactFormMail(
                    name: $this->name,
                    email: $this->email,
                    msgSubject: $this->subject,
                    msgContent: $this->message
                )
            );
        } catch (\Throwable $e) {
            // Log the error but allow the submission to complete gracefully in case mail is misconfigured locally
            Log::error('Gagal mengirim email kontak: '.$e->getMessage());
        }

        session()->flash('message', 'Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.');

        $this->reset(['name', 'email', 'subject', 'message']);
    }

    public function render()
    {
        return view('livewire.landing.contact');
    }
}
