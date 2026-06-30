@php
    $documents = $record->documents ?? [];
    $questionIds = $documents['test_questions'] ?? [];
    $userAnswers = $documents['test_answers'] ?? [];
    $shuffledOptions = $documents['shuffled_options'] ?? [];

    $questions = \App\Models\Question::whereIn('id', $questionIds)->get()->keyBy('id');
@endphp

<div class="space-y-4 font-sans text-slate-800">
    @if(empty($questionIds))
        <div class="p-4 bg-slate-100 border border-slate-300 text-slate-500 rounded-lg text-sm text-center">
            Detail jawaban ujian tidak terekam untuk pendaftaran ini (mungkin dikerjakan sebelum fitur review diaktifkan).
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-slate-50 border border-slate-200 p-4 rounded-lg flex flex-col justify-center items-center shadow-sm">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Skor Ujian</span>
                <span class="text-4xl font-extrabold text-slate-900 font-mono">{{ $record->test_score ?? 0 }}</span>
            </div>
            <div class="bg-slate-50 border border-slate-200 p-4 rounded-lg flex flex-col justify-center items-center shadow-sm col-span-2">
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-1">Keterangan Penilaian</span>
                <span class="text-xs font-semibold text-slate-700 text-center leading-relaxed">
                    Ujian online diselesaikan dengan total {{ count($questionIds) }} soal teoretis.
                </span>
            </div>
        </div>

        <div class="space-y-4">
            @php $index = 1; @endphp
            @foreach($questionIds as $qid)
                @php
                    $q = $questions->get($qid);
                @endphp
                @if($q)
                    @php
                        $userAnsKey = $userAnswers[$qid] ?? null;
                        $correctAnsKey = $q->correct_answer;
                        $isCorrect = strtoupper(trim($userAnsKey)) === strtoupper(trim($correctAnsKey));

                        // Shuffled options as stored
                        $options = $shuffledOptions[$qid] ?? [
                            ['key' => 'A', 'text' => $q->option_a],
                            ['key' => 'B', 'text' => $q->option_b],
                            ['key' => 'C', 'text' => $q->option_c],
                            ['key' => 'D', 'text' => $q->option_d],
                        ];
                    @endphp
                    <div class="bg-white border border-slate-200 rounded-lg p-5 shadow-sm space-y-3">
                        <div class="flex items-start gap-3">
                            <span class="h-6 w-6 rounded-full flex-shrink-0 flex items-center justify-center font-bold text-xs {{ $isCorrect ? 'bg-emerald-100 text-emerald-800 border border-emerald-300' : 'bg-rose-100 text-rose-800 border border-rose-300' }}">
                                {{ $index++ }}
                            </span>
                            <div class="flex-1">
                                <h4 class="font-bold text-sm text-slate-800">{{ $q->question_text }}</h4>
                                <div class="mt-1">
                                    @if($isCorrect)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-emerald-50 text-emerald-800 text-[10px] font-bold border border-emerald-200">
                                            Jawaban Benar
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-rose-50 text-rose-800 text-[10px] font-bold border border-rose-200">
                                            Jawaban Salah
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Options List -->
                        <div class="grid grid-cols-1 gap-2 pl-9">
                            @foreach($options as $opt)
                                @php
                                    $optionKey = $opt['key'];
                                    $optionText = $opt['text'];
                                    $isUserChoice = $userAnsKey === $optionKey;
                                    $isCorrectChoice = $correctAnsKey === $optionKey;

                                    $borderClass = 'border-slate-200 bg-slate-50';
                                    $textClass = 'text-slate-700';
                                    if ($isUserChoice) {
                                        $borderClass = $isCorrect ? 'border-emerald-500 bg-emerald-50/50' : 'border-rose-500 bg-rose-50/50';
                                        $textClass = $isCorrect ? 'text-emerald-900 font-bold' : 'text-rose-900 font-bold';
                                    } elseif ($isCorrectChoice) {
                                        $borderClass = 'border-emerald-300 bg-emerald-50/30';
                                        $textClass = 'text-emerald-800 font-bold';
                                    }
                                @endphp
                                <div class="flex items-center gap-2.5 p-2.5 border rounded-md text-xs {{ $borderClass }} {{ $textClass }}">
                                    <span class="font-bold font-mono">{{ $optionKey }}.</span>
                                    <span>{{ $optionText }}</span>
                                    @if($isUserChoice)
                                        <span class="ml-auto text-[9px] font-extrabold px-1.5 py-0.5 rounded uppercase tracking-wider {{ $isCorrect ? 'bg-emerald-200 text-emerald-900' : 'bg-rose-200 text-rose-900' }}">
                                            Pilihan Siswa
                                        </span>
                                    @elseif($isCorrectChoice)
                                        <span class="ml-auto text-[9px] font-extrabold px-1.5 py-0.5 rounded uppercase tracking-wider bg-emerald-100 text-emerald-800">
                                            Kunci Jawaban
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endif
</div>
