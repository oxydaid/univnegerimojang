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

test('smpt registration and quiz flow works with all documents', function () {
    Storage::fake('public');

    $dept = Department::first();

    $skin = UploadedFile::fake()->create('skin.png', 300);
    $stats = UploadedFile::fake()->create('stats.jpg', 300);
    $cert = UploadedFile::fake()->create('cert.png', 300);

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

    // Take the test
    $questions = Question::all();
    $answers = [];
    foreach ($questions as $q) {
        $answers[$q->id] = $q->correct_answer;
    }

    Livewire::test(SmptTest::class, ['registration_number' => $admission->registration_number])
        ->set('answers', $answers)
        ->call('submit')
        ->assertHasNoErrors();

    // Verify test score is updated to 100 and review data is captured
    $admission->refresh();
    expect($admission->test_score)->toBe(100);
    expect($admission->documents)->toHaveKeys(['test_questions', 'test_answers', 'shuffled_options']);
});

test('smpt registration test path works without stats and certificate and without skin', function () {
    Storage::fake('public');

    $dept = Department::first();

    // Register with 'test' path but no documents uploaded
    Livewire::test(SmptRegister::class)
        ->set('name', 'Alex Builder')
        ->set('email', 'alex@example.com')
        ->set('phone', '08123456788')
        ->set('high_school', 'SMAN 2 Mojang')
        ->set('department_id', $dept->id)
        ->set('path', 'test')
        ->set('skin', null)
        ->set('minecraft_stats', null)
        ->set('certificate', null)
        ->call('submit')
        ->assertHasNoErrors();

    $admission = Admission::where('email', 'alex@example.com')->first();
    expect($admission)->not->toBeNull();
    expect($admission->documents)->toBeEmpty();
});

test('smpt registration other paths require stats and certificate but skin is optional', function () {
    Storage::fake('public');

    $dept = Department::first();
    $stats = UploadedFile::fake()->create('stats.jpg', 300);
    $cert = UploadedFile::fake()->create('cert.png', 300);

    // Register with 'nilai' path, skin is omitted (null)
    Livewire::test(SmptRegister::class)
        ->set('name', 'Steve Miner')
        ->set('email', 'steve@example.com')
        ->set('phone', '08123456787')
        ->set('high_school', 'SMAN 3 Mojang')
        ->set('department_id', $dept->id)
        ->set('path', 'nilai')
        ->set('skin', null)
        ->set('minecraft_stats', $stats)
        ->set('certificate', $cert)
        ->call('submit')
        ->assertHasNoErrors();

    $admission = Admission::where('email', 'steve@example.com')->first();
    expect($admission)->not->toBeNull();
    expect($admission->documents)->toHaveKeys(['minecraft_stats', 'certificate']);
    expect($admission->documents)->not->toHaveKey('skin');
});
