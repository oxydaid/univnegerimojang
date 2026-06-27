<?php

use App\Livewire\Academic\Course;
use App\Livewire\Academic\Department;
use App\Livewire\Dashboard\Overview;
use App\Livewire\Dashboard\Profile;
use App\Livewire\Landing\About;
use App\Livewire\Landing\AcademicCalendar;
use App\Livewire\Landing\Alumni;
use App\Livewire\Landing\Contact;
use App\Livewire\Landing\Faculty;
use App\Livewire\Landing\GraduationList;
use App\Livewire\Landing\Home;
use App\Livewire\Landing\Organization;
use App\Livewire\Landing\PartnerSchoolDetail;
use App\Livewire\Landing\PartnerSchoolList;
use App\Livewire\Landing\SmptCheck;
use App\Livewire\Landing\SmptGuide;
use App\Livewire\Landing\SmptRegister;
use App\Livewire\Landing\SmptTest;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/fakultas', Faculty::class)->name('faculty');
Route::get('/fakultas/{slug}', App\Livewire\Academic\Faculty::class)->name('faculty.detail');
Route::get('/jurusan/{slug}', Department::class)->name('department.detail');
Route::get('/matakuliah/{code}', Course::class)->name('course.detail');
Route::get('/organisasi', Organization::class)->name('organization');
Route::get('/mitra-sekolah', PartnerSchoolList::class)->name('partner-schools.index');
Route::get('/mitra-sekolah/{slug}', PartnerSchoolDetail::class)->name('partner-schools.show');
Route::get('/tentang', About::class)->name('about');
Route::get('/kontak', Contact::class)->name('contact');
Route::get('/alumni', Alumni::class)->name('alumni');

// SMPT Admission Routes
Route::get('/smpt', SmptRegister::class)->name('smpt.register');
Route::get('/smpt/test/{registration_number}', SmptTest::class)->name('smpt.test');
Route::get('/smpt/cek-kelulusan', SmptCheck::class)->name('smpt.check');
Route::get('/smpt/panduan', SmptGuide::class)->name('smpt.guide');
Route::get('/smpt/list-kelulusan', GraduationList::class)->name('smpt.graduation-list');
Route::get('/akademik/kalender', AcademicCalendar::class)->name('academic.calendar');

// Authentication Redirects
Route::get('/login', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('login');

Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');

// Dashboard Routes
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', Overview::class)->name('dashboard.overview');
    Route::get('/profile', Profile::class)->name('dashboard.profile');
});
