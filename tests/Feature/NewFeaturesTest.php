<?php

use App\Livewire\Landing\AcademicCalendar;
use App\Livewire\Landing\GraduationList;
use App\Livewire\Landing\SmptRegister;
use App\Models\AcademicActivity;
use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\AppSettingSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
    $this->seed(RolesAndPermissionsSeeder::class);
});

test('spmb toggle: register is blocked when spmb_open is false', function () {
    $settings = AppSetting::first();
    $settings->update(['spmb_open' => false]);

    $this->get(route('smpt.register'))
        ->assertStatus(200)
        ->assertSee('Pendaftaran SPMB Ditutup');

    $dept = Department::first();
    $skin = UploadedFile::fake()->create('skin.png', 900);
    $stats = UploadedFile::fake()->create('stats.jpg', 900);
    $cert = UploadedFile::fake()->create('cert.png', 900);

    Livewire::test(SmptRegister::class)
        ->set('name', 'Steve Tester')
        ->set('email', 'steve.tester@example.com')
        ->set('phone', '08123456789')
        ->set('high_school', 'SMAN 1 Mojang')
        ->set('department_id', $dept->id)
        ->set('path', 'nilai')
        ->set('skin', $skin)
        ->set('minecraft_stats', $stats)
        ->set('certificate', $cert)
        ->call('submit');

    $admissionExists = Admission::where('email', 'steve.tester@example.com')->exists();
    expect($admissionExists)->toBeFalse();
});

test('graduation list publication toggle works', function () {
    $settings = AppSetting::first();

    // 1. Unpublished
    $settings->update(['graduation_list_published' => false]);
    $this->get(route('smpt.graduation-list'))
        ->assertStatus(200)
        ->assertSee('Pengumuman Belum Dibuka');

    // 2. Published
    $settings->update(['graduation_list_published' => true]);
    $this->get(route('smpt.graduation-list'))
        ->assertStatus(200)
        ->assertSee('Daftar Kelulusan Calon Mahasiswa Baru');
});

test('graduation list displays only accepted students with filters', function () {
    $settings = AppSetting::first();
    $settings->update(['graduation_list_published' => true]);

    $dept1 = Department::first();
    $dept2 = Department::skip(1)->first() ?? $dept1;

    // Create a few admissions
    $accepted1 = Admission::create([
        'registration_number' => 'REG-2026-0001',
        'name' => 'Lulus One',
        'email' => 'one@example.com',
        'phone' => '12345',
        'high_school' => 'SMA Mojang',
        'department_id' => $dept1->id,
        'path' => 'nilai',
        'status' => 'accepted',
    ]);

    $accepted2 = Admission::create([
        'registration_number' => 'REG-2026-0002',
        'name' => 'Lulus Two',
        'email' => 'two@example.com',
        'phone' => '12345',
        'high_school' => 'SMA Mojang',
        'department_id' => $dept2->id,
        'path' => 'prestasi',
        'status' => 'accepted',
    ]);

    $pending = Admission::create([
        'registration_number' => 'REG-2026-0003',
        'name' => 'Pending Three',
        'email' => 'three@example.com',
        'phone' => '12345',
        'high_school' => 'SMA Mojang',
        'department_id' => $dept1->id,
        'path' => 'test',
        'status' => 'pending',
    ]);

    Livewire::test(GraduationList::class)
        ->assertSee('Lulus One')
        ->assertSee('Lulus Two')
        ->assertDontSee('Pending Three')
        // Filter by search
        ->set('search', 'Lulus One')
        ->assertSee('Lulus One')
        ->assertDontSee('Lulus Two')
        // Filter by path
        ->set('search', '')
        ->set('path', 'prestasi')
        ->assertSee('Lulus Two')
        ->assertDontSee('Lulus One');
});

test('auto student creation when status changes to accepted', function () {
    $dept = Department::first();

    $admission = Admission::create([
        'registration_number' => 'REG-2026-9999',
        'name' => 'Calon Maba',
        'email' => 'maba@example.com',
        'phone' => '08123456789',
        'high_school' => 'SMA Mojang 1',
        'department_id' => $dept->id,
        'path' => 'nilai',
        'status' => 'pending',
        'documents' => ['skin' => 'skins/steve.png'],
    ]);

    expect(User::where('email', 'maba@example.com')->exists())->toBeFalse();

    // Update status to accepted
    $admission->update(['status' => 'accepted']);

    // Check user creation
    $user = User::where('email', 'maba@example.com')->first();
    expect($user)->not->toBeNull();
    expect($user->name)->toBe('Calon Maba');
    expect($user->hasRole('Student'))->toBeTrue();

    // Check student profile creation
    $student = $user->student;
    expect($student)->not->toBeNull();
    expect($student->department_id)->toBe($dept->id);
    expect($student->skin)->toBe('skins/steve.png');
    expect($student->nim)->not->toBeEmpty();

    // Formatted NIM check: [Year][DeptCode][Counter]
    $year = date('Y');
    $deptCode = str_pad($dept->id, 2, '0', STR_PAD_LEFT);
    expect($student->nim)->toStartWith($year.$deptCode);
});

test('academic calendar page filters activities correctly', function () {
    // 1. Create a future/active activity
    AcademicActivity::create([
        'title' => 'Future Active Event',
        'description' => 'Will happen soon',
        'start_date' => Carbon::tomorrow()->toDateString(),
        'end_date' => Carbon::tomorrow()->addDay()->toDateString(),
        'type' => 'registration',
        'is_active' => true,
    ]);

    // 2. Create an expired activity
    AcademicActivity::create([
        'title' => 'Past Event',
        'description' => 'Already happened',
        'start_date' => Carbon::yesterday()->subDays(5)->toDateString(),
        'end_date' => Carbon::yesterday()->toDateString(),
        'type' => 'exam',
        'is_active' => true,
    ]);

    // 3. Create an inactive activity
    AcademicActivity::create([
        'title' => 'Inactive Event',
        'description' => 'Not active',
        'start_date' => Carbon::tomorrow()->toDateString(),
        'end_date' => Carbon::tomorrow()->addDay()->toDateString(),
        'type' => 'holiday',
        'is_active' => false,
    ]);

    Livewire::test(AcademicCalendar::class)
        ->assertSee('Future Active Event')
        ->assertDontSee('Past Event')
        ->assertDontSee('Inactive Event');
});
