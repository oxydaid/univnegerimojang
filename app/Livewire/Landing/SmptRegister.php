<?php

namespace App\Livewire\Landing;

use App\Mail\RegistrationNotificationMail;
use App\Models\AcademicYear;
use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;

class SmptRegister extends Component
{
    use WithFileUploads;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $high_school = '';

    public ?int $department_id = null;

    public string $path = 'nilai'; // Default path

    // File uploads
    public $skin;

    public $minecraft_stats;

    public $certificate;

    public $achievement_proof;

    // Ordal
    public string $ordal_code = '';

    public function render()
    {
        $settings = AppSetting::first();
        $departments = Department::orderBy('name')->get();

        return view('livewire.landing.smpt-register', [
            'settings' => $settings,
            'departments' => $departments,
        ])->layout('layouts.app');
    }

    public function submit()
    {
        $settings = AppSetting::first();
        if ($settings && ! $settings->spmb_open) {
            session()->flash('error', 'Mohon maaf, pendaftaran mahasiswa baru (SPMB) saat ini sedang ditutup.');

            return;
        }

        // General validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'high_school' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'path' => 'required|in:prestasi,nilai,test,beasiswa',
        ];

        // Conditional validations for uploads (skin, rapot/stats, certificate are required for all)
        $rules['skin'] = 'required|image|min:800|max:2048'; // Min 800KB, Max 2MB
        $rules['minecraft_stats'] = 'required|image|min:800|max:2048'; // Min 800KB, Max 2MB
        $rules['certificate'] = 'required|image|min:800|max:2048'; // Min 800KB, Max 2MB

        if ($this->path === 'prestasi') {
            $rules['achievement_proof'] = 'required|image|min:800|max:2048';
        }

        if ($this->path === 'beasiswa') {
            $rules['ordal_code'] = 'required|string|max:50';
        }

        $this->validate($rules);

        // Upload documents
        $documents = [];

        if ($this->skin) {
            $documents['skin'] = $this->skin->store('admissions/skins', 'public');
        }

        if ($this->minecraft_stats) {
            $documents['minecraft_stats'] = $this->minecraft_stats->store('admissions/stats', 'public');
        }

        if ($this->certificate) {
            $documents['certificate'] = $this->certificate->store('admissions/certificates', 'public');
        }

        if ($this->path === 'prestasi' && $this->achievement_proof) {
            $documents['achievement_proof'] = $this->achievement_proof->store('admissions/achievements', 'public');
        }

        if ($this->path === 'beasiswa') {
            $documents['ordal_code'] = $this->ordal_code;
        }

        // Generate registration number
        $regNumber = 'REG-'.date('Y').'-'.str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        while (Admission::where('registration_number', $regNumber)->exists()) {
            $regNumber = 'REG-'.date('Y').'-'.str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        }

        // Get active academic year
        $activeYear = AcademicYear::where('is_active', true)->first();

        // Create admission record
        $admission = Admission::create([
            'registration_number' => $regNumber,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'high_school' => $this->high_school,
            'department_id' => $this->department_id,
            'path' => $this->path,
            'documents' => $documents,
            'status' => 'pending',
            'academic_year_id' => $activeYear?->id,
        ]);

        try {
            Mail::to($admission->email)->send(
                new RegistrationNotificationMail($admission)
            );
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email pendaftaran: '.$e->getMessage());
        }

        if ($this->path === 'test') {
            // Redirect immediately to take the test
            return redirect()->route('smpt.test', ['registration_number' => $regNumber]);
        }

        // Redirect to status check page with registration code
        session()->flash('success_registration', $regNumber);

        return redirect()->route('smpt.check');
    }
}
