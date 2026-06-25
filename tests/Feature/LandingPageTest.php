<?php

use App\Livewire\Landing\Contact;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
});

test('landing page home renders successfully', function () {
    $this->get(route('home'))->assertStatus(200);
});

test('faculty page renders successfully', function () {
    $this->get(route('faculty'))->assertStatus(200);
});

test('organization page renders successfully', function () {
    $this->get(route('organization'))->assertStatus(200);
});

test('about page renders successfully', function () {
    $this->get(route('about'))->assertStatus(200);
});

test('contact page renders successfully', function () {
    $this->get(route('contact'))->assertStatus(200);
});

test('contact page livewire form can be submitted', function () {
    Livewire::test(Contact::class)
        ->set('name', 'John Doe')
        ->set('email', 'john@example.com')
        ->set('subject', 'Test Subject')
        ->set('message', 'This is a test message of sufficient length.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSee('Pesan Anda berhasil dikirim!');
});
