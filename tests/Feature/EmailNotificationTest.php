<?php

use App\Livewire\Landing\Contact;
use App\Livewire\Landing\SmptRegister;
use App\Mail\AdmissionNotificationMail;
use App\Mail\ContactFormMail;
use App\Mail\RegistrationNotificationMail;
use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Department;
use Database\Seeders\AppSettingSeeder;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
    $this->seed(RolesAndPermissionsSeeder::class);
});

test('submitting contact form sends email to configured app settings email', function () {
    Mail::fake();

    $settings = AppSetting::first();
    $settings->update(['email' => 'custom-contact@unemo.ac.id']);

    Livewire::test(Contact::class)
        ->set('name', 'Steve Miner')
        ->set('email', 'steve@overworld.com')
        ->set('subject', 'Tanya Redstone')
        ->set('message', 'Halo, saya ingin bertanya tentang program studi redstone.')
        ->call('submit')
        ->assertHasNoErrors();

    Mail::assertSent(ContactFormMail::class, function ($mail) {
        return $mail->hasTo('custom-contact@unemo.ac.id') &&
               $mail->name === 'Steve Miner' &&
               $mail->email === 'steve@overworld.com' &&
               $mail->msgSubject === 'Tanya Redstone' &&
               $mail->msgContent === 'Halo, saya ingin bertanya tentang program studi redstone.';
    });
});

test('submitting smpt registration sends registration waiting email to student', function () {
    Mail::fake();
    Storage::fake('public');

    $dept = Department::first();

    Livewire::test(SmptRegister::class)
        ->set('name', 'Alex Crafter')
        ->set('email', 'alex@overworld.com')
        ->set('phone', '08123456789')
        ->set('high_school', 'SMAN 1 Mojang')
        ->set('department_id', $dept->id)
        ->set('path', 'nilai')
        ->set('skin', UploadedFile::fake()->image('skin.png'))
        ->set('minecraft_stats', UploadedFile::fake()->image('stats.jpg'))
        ->set('certificate', UploadedFile::fake()->image('cert.png'))
        ->call('submit')
        ->assertHasNoErrors();

    Mail::assertSent(RegistrationNotificationMail::class, function ($mail) {
        return $mail->hasTo('alex@overworld.com') &&
               $mail->admission->name === 'Alex Crafter' &&
               $mail->admission->path === 'nilai';
    });
});

test('admission notification mail can be constructed with correct properties', function () {
    Mail::fake();

    $dept = Department::first();
    $admission = Admission::create([
        'registration_number' => 'REG-2026-9999',
        'name' => 'Villager Priest',
        'email' => 'priest@village.com',
        'phone' => '08123456789',
        'high_school' => 'Village High',
        'department_id' => $dept->id,
        'path' => 'nilai',
        'status' => 'accepted',
    ]);

    Mail::to($admission->email)->send(new AdmissionNotificationMail($admission));

    Mail::assertSent(AdmissionNotificationMail::class, function ($mail) use ($admission) {
        return $mail->hasTo('priest@village.com') &&
               $mail->admission->id === $admission->id &&
               $mail->admission->status === 'accepted';
    });
});
