<?php

use App\Models\Faculty;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(RolesAndPermissionsSeeder::class);
});

test('Super Admin user bypasses all policy checks and can view faculties', function () {
    $superAdmin = User::where('email', 'admin@unemo.ac.id')->first();
    $faculty = Faculty::create([
        'name' => 'Fakultas Teknik',
        'slug' => 'fakultas-teknik',
        'code' => 'FT',
    ]);

    expect($superAdmin->can('view', $faculty))->toBeTrue();
});

test('Academic Staff user can view faculties but cannot access roles or settings', function () {
    $staff = User::where('email', 'staff@unemo.ac.id')->first();
    $faculty = Faculty::create([
        'name' => 'Fakultas Teknik',
        'slug' => 'fakultas-teknik',
        'code' => 'FT',
    ]);

    expect($staff->can('view', $faculty))->toBeTrue();
    expect($staff->can('view-any app-settings'))->toBeFalse();
    expect($staff->can('view-any roles'))->toBeFalse();
});

test('Student user cannot view faculties or manage settings', function () {
    $student = User::where('email', 'mahasiswa@unemo.ac.id')->first();
    $faculty = Faculty::create([
        'name' => 'Fakultas Teknik',
        'slug' => 'fakultas-teknik',
        'code' => 'FT',
    ]);

    expect($student->can('view', $faculty))->toBeFalse();
    expect($student->can('view-any app-settings'))->toBeFalse();
});

test('Users with access admin-panel permission can access Filament panel', function () {
    $superAdmin = User::where('email', 'admin@unemo.ac.id')->first();
    $staff = User::where('email', 'staff@unemo.ac.id')->first();

    $panel = Filament\Facades\Filament::getPanel('admin');

    expect($superAdmin->canAccessPanel($panel))->toBeTrue();
    expect($staff->canAccessPanel($panel))->toBeTrue();
});

test('Users without access admin-panel permission cannot access Filament panel', function () {
    $guest = User::factory()->create();
    $panel = Filament\Facades\Filament::getPanel('admin');

    expect($guest->canAccessPanel($panel))->toBeFalse();
});
