<?php

namespace App\Livewire\Landing;

use App\Mail\RegistrationNotificationMail;
use App\Models\AcademicYear;
use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Department;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

        // Conditional validations for uploads
        $rules['skin'] = 'nullable|image|max:2048'; // Skin is optional

        if ($this->path !== 'test') {
            $rules['minecraft_stats'] = 'required|image|max:2048'; // Max 2MB, no min limit
            $rules['certificate'] = 'required|image|max:2048'; // Max 2MB, no min limit
        } else {
            $rules['minecraft_stats'] = 'nullable|image|max:2048';
            $rules['certificate'] = 'nullable|image|max:2048';
        }

        if ($this->path === 'prestasi') {
            $rules['achievement_proof'] = 'required|image|max:2048';
        }

        if ($this->path === 'beasiswa') {
            $rules['ordal_code'] = 'required|string|max:50';
        }

        $this->validate($rules);

        // Upload documents
        $documents = [];

        if ($this->skin) {
            $extension = $this->skin->getClientOriginalExtension();
            $fileName = time().'_'.Str::random(5).'.'.$extension;
            $documents['skin'] = $this->skin->storeAs('admissions/skins', $fileName, 'public');
        }

        if ($this->minecraft_stats) {
            $extension = $this->minecraft_stats->getClientOriginalExtension();
            $fileName = time().'_'.Str::random(5).'.'.$extension;
            $documents['minecraft_stats'] = $this->minecraft_stats->storeAs('admissions/stats', $fileName, 'public');
        }

        if ($this->certificate) {
            $extension = $this->certificate->getClientOriginalExtension();
            $fileName = time().'_'.Str::random(5).'.'.$extension;
            $documents['certificate'] = $this->certificate->storeAs('admissions/certificates', $fileName, 'public');
        }

        if ($this->path === 'prestasi' && $this->achievement_proof) {
            $extension = $this->achievement_proof->getClientOriginalExtension();
            $fileName = time().'_'.Str::random(5).'.'.$extension;
            $documents['achievement_proof'] = $this->achievement_proof->storeAs('admissions/achievements', $fileName, 'public');
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
