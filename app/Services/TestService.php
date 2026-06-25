<?php

namespace App\Services;

use App\Models\Question;
use Illuminate\Support\Collection;

class TestService
{
    /**
     * Calculate the exam score based on the user's answers and the question list.
     *
     * @param  array<int, string>  $answers  Array of user answers mapped by question ID.
     * @param  Collection<int, Question>  $questions  Collection of question models.
     * @return int Calculated score from 0 to 100.
     */
    public function calculateScore(array $answers, Collection $questions): int
    {
        $correctCount = 0;
        $totalQuestions = $questions->count();

        foreach ($questions as $q) {
            $userAns = strtoupper(trim($answers[$q->id] ?? ''));
            $correctAns = strtoupper(trim($q->correct_answer));

            if ($userAns !== '' && $userAns === $correctAns) {
                $correctCount++;
            }
        }

        if ($totalQuestions > 0) {
            return (int) round(($correctCount / $totalQuestions) * 100);
        }

        return 0;
    }
}
