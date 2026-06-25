<?php

namespace App\Livewire\Landing;

use App\Models\Admission;
use App\Models\Question;
use App\Services\TestService;
use Livewire\Component;

class SmptTest extends Component
{
    public string $registration_number;

    public ?Admission $admission = null;

    public $questions;

    // Array to store selected answers: [question_id => 'A'/'B'/'C'/'D']
    public array $answers = [];

    public function mount(string $registration_number)
    {
        $this->registration_number = $registration_number;
        $this->admission = Admission::where('registration_number', $registration_number)
            ->where('path', 'test')
            ->firstOrFail();

        // If they already finished the test, redirect them
        if ($this->admission->test_score !== null) {
            session()->flash('success_registration', $this->registration_number);

            return redirect()->route('smpt.check');
        }

        // Load questions
        $this->questions = Question::all();

        // Initialize answers array
        foreach ($this->questions as $q) {
            $this->answers[$q->id] = '';
        }
    }

    public function render()
    {
        return view('livewire.landing.smpt-test')->layout('layouts.app');
    }

    public function submit(TestService $testService)
    {
        // Validate that all questions are answered
        foreach ($this->questions as $q) {
            if (empty($this->answers[$q->id])) {
                $this->addError('answers.'.$q->id, 'Pertanyaan ini wajib dijawab!');
            }
        }

        if ($this->getErrorBag()->isNotEmpty()) {
            return;
        }

        // Calculate score using the TestService
        $score = $testService->calculateScore($this->answers, $this->questions);

        // Update test score
        $this->admission->update([
            'test_score' => $score,
            // If they scored >= 80, we can give a positive note but keep status pending for admin review
            'status_notes' => 'Ujian online selesai. Skor Anda: '.$score.' / 100. Menunggu review panitia.',
        ]);

        // Redirect to status check page
        session()->flash('success_registration', $this->registration_number);
        session()->flash('test_score_achieved', $score);

        return redirect()->route('smpt.check');
    }
}
