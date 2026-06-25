<?php

use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use Database\Seeders\AppSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed(AppSettingSeeder::class);
});

test('faculty detail page renders successfully for valid slug', function () {
    $faculty = Faculty::first();
    $response = $this->get(route('faculty.detail', $faculty->slug));
    $response->assertStatus(200);
    $response->assertSee($faculty->name);
    $response->assertSee($faculty->code);
});

test('faculty detail page returns 404 for invalid slug', function () {
    $response = $this->get('/fakultas/non-existent-slug');
    $response->assertStatus(404);
});

test('department detail page renders successfully for valid slug', function () {
    $department = Department::first();
    $response = $this->get(route('department.detail', $department->slug));
    $response->assertStatus(200);
    $response->assertSee($department->name);
    $response->assertSee($department->code);
});

test('department detail page returns 404 for invalid slug', function () {
    $response = $this->get('/jurusan/non-existent-slug');
    $response->assertStatus(404);
});

test('course detail page renders successfully for valid code', function () {
    $course = Course::first();
    $response = $this->get(route('course.detail', $course->code));
    $response->assertStatus(200);
    $response->assertSee($course->name);
    $response->assertSee($course->code);
});

test('course detail page returns 404 for invalid code', function () {
    $response = $this->get('/matakuliah/non-existent-code');
    $response->assertStatus(404);
});
