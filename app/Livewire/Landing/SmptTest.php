<?php

namespace App\Livewire\Landing;

use App\Models\Admission;
use App\Models\AppSetting;
use App\Models\Question;
use App\Services\TestService;
use Livewire\Component;

class SmptTest extends Component
{
    public string $registration_number;

    public ?Admission $admission = null;

    public array $questionIds = [];

    public array $shuffledOptions = [];

    public ?int $endTimestamp = null;

    public bool $showReview = false;

    public int $finalScore = 0;

    public array $answers = [];

    public function mount(string $registration_number)
    {
        $this->registration_number = $registration_number;
        $this->admission = Admission::where('registration_number', $registration_number)
            ->where('path', 'test')
            ->firstOrFail();

        // If they already finished the test, check if they are viewing the review
        if ($this->admission->test_score !== null) {
            if (session()->get('viewing_review_'.$this->registration_number)) {
                $this->showReview = true;
                $this->finalScore = $this->admission->test_score;

                $sessionQIdsKey = 'smpt_test_q_ids_'.$this->registration_number;
                $sessionOptsKey = 'smpt_test_opts_'.$this->registration_number;
                if (session()->has($sessionQIdsKey) && session()->has($sessionOptsKey)) {
                    $this->questionIds = session($sessionQIdsKey);
                    $this->shuffledOptions = session($sessionOptsKey);
                }

                $sessionAnswersKey = 'smpt_test_answers_'.$this->registration_number;
                if (session()->has($sessionAnswersKey)) {
                    $this->answers = session($sessionAnswersKey);
                } else {
                    foreach ($this->questionIds as $qid) {
                        $this->answers[$qid] = '';
                    }
                }

                return;
            }

            session()->flash('success_registration', $this->registration_number);

            return redirect()->route('smpt.check');
        }

        $sessionQIdsKey = 'smpt_test_q_ids_'.$this->registration_number;
        $sessionOptsKey = 'smpt_test_opts_'.$this->registration_number;
        $sessionEndKey = 'smpt_test_end_'.$this->registration_number;

        if (session()->has($sessionQIdsKey) && session()->has($sessionOptsKey) && session()->has($sessionEndKey)) {
            $this->questionIds = session($sessionQIdsKey);
            $this->shuffledOptions = session($sessionOptsKey);
            $this->endTimestamp = session($sessionEndKey);
        } else {
            $allQuestions = Question::all();
            $settings = AppSetting::first();
            $maxQuestions = $settings?->max_test_questions ?? 10;
            $takeCount = min($allQuestions->count(), $maxQuestions);
            $shuffled = $allQuestions->shuffle()->take($takeCount);

            $this->questionIds = $shuffled->pluck('id')->toArray();
            $this->shuffledOptions = [];

            foreach ($shuffled as $q) {
                $opts = [
                    ['key' => 'A', 'text' => $q->option_a],
                    ['key' => 'B', 'text' => $q->option_b],
                    ['key' => 'C', 'text' => $q->option_c],
                    ['key' => 'D', 'text' => $q->option_d],
                ];
                $this->shuffledOptions[$q->id] = collect($opts)->shuffle()->toArray();
            }

            // Total timer is total questions x 1 minute (in seconds)
            $this->endTimestamp = time() + ($takeCount * 60);

            session([
                $sessionQIdsKey => $this->questionIds,
                $sessionOptsKey => $this->shuffledOptions,
                $sessionEndKey => $this->endTimestamp,
            ]);
        }

        // Initialize answers array
        foreach ($this->questionIds as $qid) {
            $this->answers[$qid] = '';
        }
    }

    public function render()
    {
        $questions = Question::whereIn('id', $this->questionIds)->get();
        $questionIds = $this->questionIds;
        $sortedQuestions = $questions->sortBy(function ($model) use ($questionIds) {
            return array_search($model->id, $questionIds);
        });

        return view('livewire.landing.smpt-test', [
            'sortedQuestions' => $sortedQuestions,
        ])->layout('layouts.app');
    }

    public function submitTimeout()
    {
        $this->submit(true);
    }

    public function submit(bool $isTimeout = false)
    {
        $testService = app(TestService::class);

        // Validate that all questions are answered, but skip if timer expired (timeout)
        if (! $isTimeout) {
            foreach ($this->questionIds as $qid) {
                if (empty($this->answers[$qid])) {
                    $this->addError('answers.'.$qid, 'Pertanyaan ini wajib dijawab!');
                }
            }

            if ($this->getErrorBag()->isNotEmpty()) {
                return;
            }
        }

        // Calculate score using only the subset of questions passed to the test
        $questions = Question::whereIn('id', $this->questionIds)->get();
        $score = $testService->calculateScore($this->answers, $questions);

        // Update test score
        $this->admission->update([
            'test_score' => $score,
            'status_notes' => 'Ujian online selesai. Skor Anda: '.$score.' / 100. Menunggu review panitia.',
        ]);

        $this->finalScore = $score;
        $this->showReview = true;

        // Set viewing review flag and answers in session so we can view the review even on refresh
        session()->put('viewing_review_'.$this->registration_number, true);
        session()->put('smpt_test_answers_'.$this->registration_number, $this->answers);
    }

    public function finishReview()
    {
        // Clean up test session data and viewing review flag
        session()->forget([
            'smpt_test_q_ids_'.$this->registration_number,
            'smpt_test_opts_'.$this->registration_number,
            'smpt_test_end_'.$this->registration_number,
            'viewing_review_'.$this->registration_number,
            'smpt_test_answers_'.$this->registration_number,
        ]);

        session()->flash('success_registration', $this->registration_number);
        session()->flash('test_score_achieved', $this->finalScore);

        return redirect()->route('smpt.check');
    }
}
