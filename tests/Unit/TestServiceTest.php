<?php

use App\Models\Question;
use App\Services\TestService;
use Tests\TestCase;

uses(TestCase::class);

test('calculates correct score based on answers', function () {
    $service = new TestService;

    // Create in-memory question instances and set attributes directly to bypass mass-assignment guards
    $q1 = new Question;
    $q1->id = 1;
    $q1->correct_answer = 'A';

    $q2 = new Question;
    $q2->id = 2;
    $q2->correct_answer = 'B';

    $q3 = new Question;
    $q3->id = 3;
    $q3->correct_answer = 'C';

    $q4 = new Question;
    $q4->id = 4;
    $q4->correct_answer = 'D';

    $questions = collect([$q1, $q2, $q3, $q4]);

    // Scenario 1: All correct
    $answers1 = [
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
    ];
    expect($service->calculateScore($answers1, $questions))->toBe(100);

    // Scenario 2: Half correct
    $answers2 = [
        1 => 'A',
        2 => 'B',
        3 => 'A',
        4 => 'A',
    ];
    expect($service->calculateScore($answers2, $questions))->toBe(50);

    // Scenario 3: None correct or empty
    $answers3 = [
        1 => 'B',
        2 => 'C',
        3 => 'D',
        4 => 'A',
    ];
    expect($service->calculateScore($answers3, $questions))->toBe(0);

    // Scenario 4: Partially missing answers
    $answers4 = [
        1 => 'A',
    ];
    expect($service->calculateScore($answers4, $questions))->toBe(25);
});
