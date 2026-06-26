<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-primary to-slate-900 text-white p-8 rounded-none border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
            <div class="absolute right-4 -bottom-10 opacity-10 font-pixel text-[120px] pointer-events-none select-none">KALENDER</div>
            <div class="relative z-10 space-y-3">
                <span class="inline-flex items-center px-3 py-1 bg-white/20 text-white border border-white/30 text-xs font-bold uppercase tracking-wider">
                    Jadwal & Agenda Akademik
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-pixel uppercase">
                    Kalender Akademik UNEMO
                </h1>
                <p class="text-xs sm:text-sm text-slate-100 max-w-xl leading-relaxed">
                    Pantau agenda perkuliahan, registrasi ulang mahasiswa baru, ujian tengah/akhir semester, dan jadwal libur nasional Universitas Negeri Mojang.
                </p>
            </div>
        </div>

        <!-- Calendar Timeline -->
        <div class="space-y-6">
            @forelse($activities as $act)
                <div class="bg-white border-4 border-slate-900 p-6 shadow-[5px_5px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] transition-all flex flex-col sm:flex-row gap-6 items-start sm:items-center">
                    
                    <!-- Date Section -->
                    <div class="flex-shrink-0 w-full sm:w-44 p-4 border-2 border-slate-900 bg-secondary-pastel text-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        <span class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider">Tanggal Kegiatan</span>
                        <div class="font-pixel text-slate-900 font-bold mt-1 text-sm">
                            {{ \Carbon\Carbon::parse($act->start_date)->translatedFormat('d M Y') }}
                        </div>
                        @if($act->start_date !== $act->end_date)
                            <span class="block text-[10px] font-bold text-slate-500 uppercase my-0.5">s/d</span>
                            <div class="font-pixel text-slate-900 font-bold text-sm">
                                {{ \Carbon\Carbon::parse($act->end_date)->translatedFormat('d M Y') }}
                            </div>
                        @endif
                    </div>

                    <!-- Details Section -->
                    <div class="flex-grow space-y-2">
                        <div class="flex flex-wrap items-center gap-2">
                            <!-- Type Badge -->
                            <span class="inline-flex items-center px-2.5 py-0.5 border-2 border-slate-900 text-[10px] font-extrabold uppercase shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]
                                @if($act->type === 'registration') bg-sky-100 text-sky-800
                                @elseif($act->type === 'exam') bg-amber-100 text-amber-800
                                @elseif($act->type === 'holiday') bg-rose-100 text-rose-800
                                @else bg-slate-100 text-slate-800 @endif">
                                @if($act->type === 'registration') 📝 Registrasi
                                @elseif($act->type === 'exam') 📝 Ujian / Evaluasi
                                @elseif($act->type === 'holiday') 🏕 Libur / Cuti
                                @else 📅 Agenda Lain @endif
                            </span>
                            
                            <!-- Status Badge -->
                            @if(\Carbon\Carbon::today()->between(\Carbon\Carbon::parse($act->start_date), \Carbon\Carbon::parse($act->end_date)))
                                <span class="inline-flex items-center px-2 py-0.5 border-2 border-emerald-500 bg-emerald-50 text-[10px] font-bold text-emerald-700 uppercase animate-pulse shadow-[1px_1px_0px_0px_rgba(16,185,129,0.3)]">
                                    🟢 Sedang Berjalan
                                </span>
                            @endif
                        </div>

                        <h3 class="text-lg font-extrabold text-slate-900 font-pixel uppercase tracking-wide">
                            {{ $act->title }}
                        </h3>

                        @if($act->description)
                            <p class="text-xs text-slate-600 leading-relaxed font-sans font-medium">
                                {{ $act->description }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-12 text-center space-y-4">
                    <div class="text-6xl text-slate-300"><i class="fa-solid fa-calendar-xmark"></i></div>
                    <div class="space-y-1">
                        <h3 class="text-lg font-extrabold text-slate-900 font-pixel uppercase">Belum Ada Agenda Aktif</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Saat ini belum ada agenda atau kegiatan akademik aktif yang dijadwalkan dalam waktu dekat.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>

    </div>
</div>
