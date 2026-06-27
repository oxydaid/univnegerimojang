<?php

use App\Models\AppSetting;
use App\Models\Donor;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
});

test('donation page renders successfully with QRIS and visible donors list', function () {
    // 1. Update settings with QRIS image path
    $settings = AppSetting::first();
    $settings->update([
        'qris_image' => 'settings/qris-test.png',
    ]);

    // 2. Create visible and invisible donors
    $visibleDonor = Donor::create([
        'name' => 'Alex Steve',
        'amount' => 150000,
        'message' => 'Semangat UNEMO!',
        'donated_at' => now(),
        'is_visible' => true,
    ]);

    $invisibleDonor = Donor::create([
        'name' => 'Anonymous Donor',
        'amount' => 500000,
        'message' => 'Keep growing!',
        'donated_at' => now(),
        'is_visible' => false,
    ]);

    // 3. Verify page content
    $this->get(route('donations.index'))
        ->assertStatus(200)
        ->assertSee('settings/qris-test.png')
        ->assertSee('Alex Steve')
        ->assertSee('Rp 150.000')
        ->assertSee('Semangat UNEMO!')
        ->assertDontSee('Anonymous Donor');
});
