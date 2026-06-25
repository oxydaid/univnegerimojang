<?php

use App\Livewire\Dashboard\Profile;
use App\Models\User;
use Database\Seeders\AppSettingSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
    $this->seed(RolesAndPermissionsSeeder::class);
});

test('unauthenticated users are redirected to login', function () {
    $this->get(route('dashboard.overview'))
        ->assertRedirect(route('login'));

    $this->get(route('dashboard.profile'))
        ->assertRedirect(route('login'));
});

test('authenticated student can view dashboard and statistics', function () {
    $studentUser = User::where('email', 'mahasiswa@unemo.ac.id')->first();
    expect($studentUser)->not->toBeNull();

    $this->actingAs($studentUser)
        ->get(route('dashboard.overview'))
        ->assertStatus(200)
        ->assertSee('Statistik Akademik Mahasiswa')
        ->assertSee('3.85')
        ->assertSee('84');
});

test('authenticated student can view profile and update phone/address', function () {
    $studentUser = User::where('email', 'mahasiswa@unemo.ac.id')->first();
    expect($studentUser)->not->toBeNull();

    $this->actingAs($studentUser)
        ->get(route('dashboard.profile'))
        ->assertStatus(200)
        ->assertSee('Informasi Profil Akun')
        ->assertSee('2026010001');

    Livewire::actingAs($studentUser)
        ->test(Profile::class)
        ->set('phone', '08999999999')
        ->set('address', 'Gedung Rektorat Steve Lt. 3')
        ->call('saveProfile')
        ->assertHasNoErrors();

    $studentUser->student->refresh();
    expect($studentUser->student->phone)->toBe('08999999999');
    expect($studentUser->student->address)->toBe('Gedung Rektorat Steve Lt. 3');
});

test('authenticated user can change password', function () {
    $studentUser = User::where('email', 'mahasiswa@unemo.ac.id')->first();
    expect($studentUser)->not->toBeNull();

    Livewire::actingAs($studentUser)
        ->test(Profile::class)
        ->set('current_password', 'password')
        ->set('new_password', 'newsecret123')
        ->set('new_password_confirmation', 'newsecret123')
        ->call('changePassword')
        ->assertHasNoErrors();

    // Verify password was updated
    expect(Hash::check('newsecret123', $studentUser->fresh()->password))->toBeTrue();
});
