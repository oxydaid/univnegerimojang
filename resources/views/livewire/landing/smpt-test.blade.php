<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header -->
        <div class="bg-slate-900 border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-white relative overflow-hidden">
            <div class="absolute right-4 top-4 text-slate-800 font-pixel text-7xl select-none opacity-20"><i class="fa-solid fa-file-signature"></i></div>
            <div class="relative z-10 space-y-2">
                <span class="inline-flex items-center px-2.5 py-0.5 bg-red-500 text-slate-950 font-bold text-xxs uppercase tracking-wider">
                    Ujian Tertulis Online
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
        <div class="bg-amber-50 border-4 border-amber-400 p-4 flex gap-3 text-amber-800 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
            <div class="text-2xl flex-shrink-0 mt-0.5"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <div>
                <h4 class="font-bold text-sm font-pixel uppercase tracking-wide">Peringatan Ujian</h4>
                <p class="text-xs text-amber-700 leading-relaxed mt-0.5">
                    Hati-hati! Sistem proteksi kami memantau aktivitas Anda. Membuka tab lain terlalu lama atau menggunakan Cheat/Creative Mode dapat mengakibatkan kegagalan instan. Jawablah dengan jujur sesuai pengetahuan survival vanilla Anda!
                </p>
            </div>
        </div>

        <!-- Questions Form -->
        <div class="space-y-6">
            <form wire:submit.prevent="submit" class="space-y-6">
                @php $index = 1; @endphp
                @foreach($questions as $q)
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

                        <!-- Options List -->
                        <div class="grid grid-cols-1 gap-3 pl-11">
                            <!-- Option A -->
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 hover:border-slate-800 cursor-pointer transition-colors duration-150 {{ $answers[$q->id] === 'A' ? 'border-primary bg-primary/5 text-primary' : 'bg-slate-50' }}">
                                <input type="radio" wire:model="answers.{{ $q->id }}" value="A" class="h-4 w-4 text-primary focus:ring-primary border-slate-300">
                                <span class="text-xs font-bold font-mono">A.</span>
                                <span class="text-xs sm:text-sm font-semibold">{{ $q->option_a }}</span>
                            </label>

                            <!-- Option B -->
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 hover:border-slate-800 cursor-pointer transition-colors duration-150 {{ $answers[$q->id] === 'B' ? 'border-primary bg-primary/5 text-primary' : 'bg-slate-50' }}">
                                <input type="radio" wire:model="answers.{{ $q->id }}" value="B" class="h-4 w-4 text-primary focus:ring-primary border-slate-300">
                                <span class="text-xs font-bold font-mono">B.</span>
                                <span class="text-xs sm:text-sm font-semibold">{{ $q->option_b }}</span>
                            </label>

                            <!-- Option C -->
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 hover:border-slate-800 cursor-pointer transition-colors duration-150 {{ $answers[$q->id] === 'C' ? 'border-primary bg-primary/5 text-primary' : 'bg-slate-50' }}">
                                <input type="radio" wire:model="answers.{{ $q->id }}" value="C" class="h-4 w-4 text-primary focus:ring-primary border-slate-300">
                                <span class="text-xs font-bold font-mono">C.</span>
                                <span class="text-xs sm:text-sm font-semibold">{{ $q->option_c }}</span>
                            </label>

                            <!-- Option D -->
                            <label class="flex items-center gap-3 p-3 border-2 border-slate-200 hover:border-slate-800 cursor-pointer transition-colors duration-150 {{ $answers[$q->id] === 'D' ? 'border-primary bg-primary/5 text-primary' : 'bg-slate-50' }}">
                                <input type="radio" wire:model="answers.{{ $q->id }}" value="D" class="h-4 w-4 text-primary focus:ring-primary border-slate-300">
                                <span class="text-xs font-bold font-mono">D.</span>
                                <span class="text-xs sm:text-sm font-semibold">{{ $q->option_d }}</span>
                            </label>
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
