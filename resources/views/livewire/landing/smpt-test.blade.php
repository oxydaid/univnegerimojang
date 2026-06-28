<style>
    .cbt-no-select {
        -webkit-touch-callout: none !important;
        -webkit-user-select: none !important;
        -khtml-user-select: none !important;
        -moz-user-select: none !important;
        -ms-user-select: none !important;
        user-select: none !important;
    }
</style>

@if($showReview)
    <div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Review Header -->
            <div class="bg-slate-900 border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-white relative overflow-hidden">
                <div class="absolute right-4 top-4 text-slate-800 font-pixel text-7xl select-none opacity-20"><i class="fa-solid fa-square-poll-vertical"></i></div>
                <div class="relative z-10 space-y-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 bg-emerald-400 text-slate-950 font-bold text-xxs uppercase tracking-wider">
                        Hasil Review Ujian
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight font-pixel uppercase">
                        Review Hasil Jawaban Anda
                    </h1>
                    <p class="text-xxs sm:text-xs text-slate-400">
                        Skor Akhir: <strong class="text-emerald-400 text-sm font-pixel">{{ $finalScore }} / 100</strong> (Pendaftar: {{ $admission->name }})
                    </p>
                </div>
            </div>

            <!-- Questions Review List -->
            <div class="space-y-6">
                @php $index = 1; @endphp
                @foreach($sortedQuestions as $q)
                    @php
                        $userAnsKey = $answers[$q->id] ?? null;
                        $correctAnsKey = $q->correct_answer;
                        $isCorrect = strtoupper(trim($userAnsKey)) === strtoupper(trim($correctAnsKey));

                        // Find corresponding text
                        $userAnsText = '';
                        $correctAnsText = '';
                        if ($userAnsKey === 'A') $userAnsText = $q->option_a;
                        elseif ($userAnsKey === 'B') $userAnsText = $q->option_b;
                        elseif ($userAnsKey === 'C') $userAnsText = $q->option_c;
                        elseif ($userAnsKey === 'D') $userAnsText = $q->option_d;

                        if ($correctAnsKey === 'A') $correctAnsText = $q->option_a;
                        elseif ($correctAnsKey === 'B') $correctAnsText = $q->option_b;
                        elseif ($correctAnsKey === 'C') $correctAnsText = $q->option_c;
                        elseif ($correctAnsKey === 'D') $correctAnsText = $q->option_d;
                    @endphp
                    <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 space-y-4">
                        <!-- Question Header -->
                        <div class="flex items-start gap-3">
                            <span class="h-8 w-8 rounded-none border-2 border-slate-900 {{ $isCorrect ? 'bg-emerald-400 text-slate-955' : 'bg-rose-400 text-slate-955' }} flex items-center justify-center font-bold font-pixel text-sm flex-shrink-0">
                                {{ $index++ }}
                            </span>
                            <div class="flex-1">
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base leading-relaxed pt-0.5">
                                    {{ $q->question_text }}
                                </h3>
                                <div class="mt-2">
                                    @if($isCorrect)
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 border border-emerald-600 bg-emerald-50 text-emerald-800 text-xxs font-bold uppercase">
                                            <i class="fa-solid fa-circle-check"></i> BENAR
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 border border-rose-600 bg-rose-50 text-rose-800 text-xxs font-bold uppercase">
                                            <i class="fa-solid fa-circle-xmark"></i> SALAH
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Answers Comparison -->
                        <div class="grid grid-cols-1 gap-3 pl-11">
                            <!-- User Answer -->
                            <div class="p-3 border-2 {{ $isCorrect ? 'border-emerald-500 bg-emerald-50/50' : 'border-rose-500 bg-rose-50/50' }} flex flex-col gap-1">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">Jawaban Anda</span>
                                <div class="flex items-start gap-2">
                                    <span class="text-xs font-bold font-mono">{{ $userAnsKey ?? '-' }}.</span>
                                    <span class="text-xs sm:text-sm font-semibold text-slate-800">{{ $userAnsText ?: '(Tidak dijawab)' }}</span>
                                </div>
                            </div>

                            <!-- Correct Answer -->
                            @if(!$isCorrect)
                                <div class="p-3 border-2 border-slate-900 bg-slate-50 flex flex-col gap-1">
                                    <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wide">Jawaban yang Benar</span>
                                    <div class="flex items-start gap-2">
                                        <span class="text-xs font-bold font-mono">{{ $correctAnsKey }}.</span>
                                        <span class="text-xs sm:text-sm font-semibold text-emerald-800">{{ $correctAnsText }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Back to Status Button -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-center sm:text-left">
                    <h4 class="font-bold text-slate-800 text-sm">Review Selesai</h4>
                    <p class="text-xxs text-slate-500">Silakan kembali ke halaman status pendaftaran Anda untuk memantau proses selanjutnya.</p>
                </div>
                <button type="button" wire:click="finishReview" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 border-4 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-base shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                    Selesai & Cek Status <i class="fa-solid fa-circle-arrow-right ml-1.5"></i>
                </button>
            </div>
        </div>
    </div>
@else
    <div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary select-none cbt-no-select"
         x-data="{
             handleKeydown(e) {
                 if (e.key === 'F12') {
                     e.preventDefault();
                 }
                 if (e.ctrlKey && e.shiftKey && ['I', 'J', 'C', 'i', 'j', 'c'].includes(e.key)) {
                     e.preventDefault();
                 }
                 if (e.ctrlKey && ['U', 'u', 'S', 's', 'P', 'p', 'C', 'c', 'V', 'v', 'A', 'a'].includes(e.key)) {
                     e.preventDefault();
                 }
             }
         }"
         @contextmenu.window.prevent=""
         @keydown.window="handleKeydown($event)">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Header -->
            <div class="bg-slate-900 border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-white relative overflow-hidden">
                <div class="absolute right-4 top-4 text-slate-800 font-pixel text-7xl select-none opacity-20"><i class="fa-solid fa-file-signature"></i></div>
                <div class="relative z-10 space-y-2">
                    <span class="inline-flex items-center px-2.5 py-0.5 bg-red-500 text-slate-950 font-bold text-xxs uppercase tracking-wider">
                        Ujian Tertulis Online (CBT)
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight font-pixel uppercase">
                        Ruang Ujian Teoretis Redstone & Survival
                    </h1>
                    <p class="text-xxs sm:text-xs text-slate-400">
                        Pendaftar: <strong>{{ $admission->name }}</strong> (No. Reg: {{ $admission->registration_number }})
                    </p>
                </div>
            </div>

            <!-- Rules Alert Box -->
            <div class="bg-amber-50 border-4 border-slate-900 p-4 flex gap-3 text-amber-800 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <div class="text-2xl flex-shrink-0 mt-0.5"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <div>
                    <h4 class="font-bold text-sm font-pixel uppercase tracking-wide">Peringatan Ujian</h4>
                    <p class="text-xs text-amber-700 leading-relaxed mt-0.5">
                        Hati-hati! Sistem proteksi kami memantau aktivitas Anda. Jawablah soal dengan jujur sesuai pengetahuan survival vanilla Anda. Ujian ini dibatasi oleh timer mundur, dan ketika waktu habis, semua jawaban Anda akan langsung disimpan secara otomatis!
                    </p>
                </div>
            </div>

            <!-- Sticky Floating Countdown Timer (Alpine.js) -->
            <div class="fixed bottom-6 right-6 z-50" x-data="{
                timeLeft: {{ max(0, $endTimestamp - time()) }},
                timerText: '',
                init() {
                    this.updateText();
                    let timer = setInterval(() => {
                        if (this.timeLeft <= 0) {
                            clearInterval(timer);
                            $wire.submitTimeout();
                            return;
                        }
                        this.timeLeft--;
                        this.updateText();
                    }, 1000);
                },
                updateText() {
                    let minutes = Math.floor(this.timeLeft / 60);
                    let seconds = this.timeLeft % 60;
                    this.timerText = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');
                }
            }">
                <div class="flex flex-col items-center bg-yellow-300 border-4 border-slate-900 p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] min-w-[120px]">
                    <span class="text-[9px] font-extrabold text-slate-800 uppercase tracking-wider mb-1">Sisa Waktu</span>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-clock text-red-600 animate-pulse text-base"></i>
                        <span class="font-pixel text-2xl font-bold text-slate-900" x-text="timerText">00:00</span>
                    </div>
                </div>
            </div>

            <!-- Questions Form -->
            <div class="space-y-6">
                <form wire:submit.prevent="submit" class="space-y-6">
                    @php $index = 1; @endphp
                    @foreach($sortedQuestions as $q)
                        <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 space-y-4">
                            <!-- Question Header -->
                            <div class="flex items-start gap-3">
                                <span class="h-8 w-8 rounded-none border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold font-pixel text-sm flex-shrink-0">
                                    {{ $index++ }}
                                </span>
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base leading-relaxed pt-0.5">
                                    {{ $q->question_text }}
                                </h3>
                            </div>

                            <!-- Options List (Randomized) -->
                            <div class="grid grid-cols-1 gap-3 pl-11">
                                @foreach($shuffledOptions[$q->id] as $opt)
                                    @php
                                        $optionKey = $opt['key'];
                                        $optionText = $opt['text'];
                                    @endphp
                                    <label class="flex items-center gap-3 p-3 border-2 border-slate-200 hover:border-slate-800 cursor-pointer transition-colors duration-150 {{ ($answers[$q->id] ?? '') === $optionKey ? 'border-primary bg-primary/5 text-primary' : 'bg-slate-50' }}">
                                        <input type="radio" name="answers_{{ $q->id }}" wire:model="answers.{{ $q->id }}" value="{{ $optionKey }}" class="h-4 w-4 text-primary focus:ring-primary border-slate-300">
                                        <span class="text-xs font-bold font-mono">{{ $optionKey }}.</span>
                                        <span class="text-xs sm:text-sm font-semibold text-slate-700">{{ $optionText }}</span>
                                    </label>
                                @endforeach
                            </div>
                            
                            @error('answers.' . $q->id)
                                <div class="pl-11 text-xs text-rose-600 font-bold flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>
                    @endforeach

                    <!-- Submit Section -->
                    <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                        <div class="text-center sm:text-left">
                            <h4 class="font-bold text-slate-800 text-sm">Sudah yakin dengan jawaban Anda?</h4>
                            <p class="text-xxs text-slate-500">Ujian tidak dapat diulang setelah Anda menekan tombol kirim di samping.</p>
                        </div>
                        <button type="submit" wire:loading.attr="disabled" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3.5 border-4 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-base shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                            <span wire:loading class="mr-2">
                                <i class="fa-solid fa-spinner animate-spin"></i>
                            </span>
                            Kirim Jawaban Ujian <i class="fa-solid fa-paper-plane ml-1.5"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endif
