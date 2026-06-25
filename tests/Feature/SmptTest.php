<?php

use App\Livewire\Landing\SmptRegister;
use App\Livewire\Landing\SmptTest;
use App\Models\Admission;
use App\Models\Department;
use App\Models\Question;
use Database\Seeders\AppSettingSeeder;
use Database\Seeders\QuestionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
    $this->seed(QuestionSeeder::class);
});

test('smpt registration page renders successfully', function () {
    $this->get(route('smpt.register'))->assertStatus(200);
});

test('smpt check status page renders successfully', function () {
    $this->get(route('smpt.check'))->assertStatus(200);
});

test('smpt registration and quiz flow works', function () {
    Storage::fake('public');

    $dept = Department::first();

    $skin = UploadedFile::fake()->image('skin.png');
    $stats = UploadedFile::fake()->image('stats.jpg');
    $cert = UploadedFile::fake()->image('cert.png');

    // Register with 'test' path
    Livewire::test(SmptRegister::class)
        ->set('name', 'Dream Speedrunner')
        ->set('email', 'dream@example.com')
        ->set('phone', '08123456789')
        ->set('high_school', 'SMAN 1 Mojang')
        ->set('department_id', $dept->id)
        ->set('path', 'test')
        ->set('skin', $skin)
        ->set('minecraft_stats', $stats)
        ->set('certificate', $cert)
        ->call('submit')
        ->assertHasNoErrors();

    // Verify record was created
    $admission = Admission::where('email', 'dream@example.com')->first();
    expect($admission)->not->toBeNull();
    expect($admission->path)->toBe('test');
    expect($admission->status)->toBe('pending');
    expect($admission->documents)->toHaveKeys(['skin', 'minecraft_stats', 'certificate']);

    // Take the test
    $questions = Question::all();
    $answers = [];
    foreach ($questions as $q) {
        // Send correct answers to get 100
        $answers[$q->id] = $q->correct_answer;
    }

    Livewire::test(SmptTest::class, ['registration_number' => $admission->registration_number])
        ->set('answers', $answers)
        ->call('submit')
        ->assertHasNoErrors();

    // Verify test score is updated to 100
    $admission->refresh();
    expect($admission->test_score)->toBe(100);
});
