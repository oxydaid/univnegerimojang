<?php

use App\Models\AppSetting;
use App\Models\PartnerSchool;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
});

test('partner schools list page renders successfully', function () {
    $school = PartnerSchool::create([
        'name' => 'SMK Negeri 1 Crafting',
        'slug' => 'smk-negeri-1-crafting',
        'logo' => null,
        'description' => '<p>Kerja sama otomatisasi Redstone</p>',
        'tiktok_link' => 'https://tiktok.com/@smkn1crafting',
    ]);

    $this->get(route('partner-schools.index'))
        ->assertStatus(200)
        ->assertSee('SMK Negeri 1 Crafting')
        ->assertSee('Kerja sama otomatisasi Redstone');
});

test('partner school detail page renders successfully', function () {
    $school = PartnerSchool::create([
        'name' => 'SMA Negeri 2 Overworld',
        'slug' => 'sma-negeri-2-overworld',
        'logo' => null,
        'description' => '<h2>Program Beasiswa Miner</h2>',
        'tiktok_link' => 'https://tiktok.com/@sman2overworld',
    ]);

    $this->get(route('partner-schools.show', 'sma-negeri-2-overworld'))
        ->assertStatus(200)
        ->assertSee('SMA Negeri 2 Overworld')
        ->assertSee('Program Beasiswa Miner');
});

test('partner school detail page returns 404 if not found', function () {
    $this->get(route('partner-schools.show', 'non-existent-school'))
        ->assertStatus(404);
});

test('partner school automatically generates slug from name', function () {
    $school = PartnerSchool::create([
        'name' => 'SMP Negeri 3 Netherite',
        'logo' => null,
        'description' => 'Studi Netherite',
    ]);

    expect($school->slug)->toBe('smp-negeri-3-netherite');
});

test('partner school formatLogoName and getLogoUrl methods function correctly', function () {
    $school = PartnerSchool::create([
        'name' => 'Sekolah Voxel',
        'logo' => 'schools/test-logo.png',
        'description' => 'Studi Voxel',
    ]);

    expect($school->getLogoUrl())->toBe(asset('storage/schools/test-logo.png'));

    $school->logo = null;
    $school->save();
    expect($school->getLogoUrl())->toBe(asset('images/steve.webp'));
});

test('announcement bar setting updates and renders on page', function () {
    $settings = AppSetting::first();
    $settings->update([
        'show_announcement' => true,
        'announcement_bg_color' => '#ff0000',
        'announcement_text_color' => '#ffff00',
        'announcement_text' => 'Info Penting Ujian Survival',
    ]);

    $this->get(route('home'))
        ->assertStatus(200)
        ->assertSee('background-color: #ff0000', false)
        ->assertSee('color: #ffff00', false)
        ->assertSee('Info Penting Ujian Survival', false);

    $settings->update(['show_announcement' => false]);

    $this->get(route('home'))
        ->assertStatus(200)
        ->assertDontSee('Info Penting Ujian Survival');
});
