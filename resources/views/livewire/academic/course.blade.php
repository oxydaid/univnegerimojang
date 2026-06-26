<div class="py-12 bg-brutal-bg min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-slate-500 gap-2 items-center overflow-x-auto whitespace-nowrap flex-nowrap pb-1 scrollbar-none w-full" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex-shrink-0"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('faculty') }}" class="hover:text-primary transition-colors flex-shrink-0">Fakultas</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('faculty.detail', $course->department->faculty->slug) }}" class="hover:text-primary transition-colors flex-shrink-0">{{ $course->department->faculty->name }}</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('department.detail', $course->department->slug) }}" class="hover:text-primary transition-colors flex-shrink-0">{{ $course->department->name }}</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <span class="text-slate-800 font-semibold flex-shrink-0">{{ $course->name }}</span>
        </nav>

        <!-- Course Header Card -->
        <div class="relative bg-white border-4 border-slate-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 rounded-none overflow-hidden">
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-3">
                        <span class="inline-flex items-center px-3 py-1 bg-amber-500 text-slate-950 border-2 border-slate-900 text-xs font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            Kode: {{ $course->code }}
                        </span>
                        <a href="{{ route('department.detail', $course->department->slug) }}" class="inline-flex items-center px-3 py-1 bg-slate-900 text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider hover:bg-primary transition-colors shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            Jurusan: {{ $course->department->name }}
                        </a>
                    </div>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-none font-pixel">
                        {{ $course->name }}
                    </h1>
                    <div class="flex items-center gap-3 text-sm text-slate-600 font-semibold">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 border-2 border-slate-900 rounded-none">
                            <i class="fa-solid fa-gem text-emerald-600"></i>
                            Kredit: {{ $course->credits }} SKS (Sertifikasi Voxel)
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Class Schedules (Left 2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between border-b-4 border-slate-950 pb-3">
                    <h2 class="text-2xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                        <i class="fa-solid fa-clock mr-2"></i> Jadwal Perkuliahan & Praktikum
                    </h2>
                </div>

                <div class="space-y-6">
                    @forelse($course->schedules as $schedule)
                        <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-6 space-y-6 relative overflow-hidden">
                            <!-- Left Border Accent Based on Day -->
                            <div class="absolute left-0 top-0 h-full w-2 bg-primary"></div>
                            
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                                <div>
                                    <span class="inline-block px-2.5 py-1 bg-slate-900 text-white text-xs font-bold uppercase tracking-wider mb-2 font-mono border-2 border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]">
                                        {{ $schedule->day_of_week }}
                                    </span>
                                    <div class="text-xl font-bold text-slate-900 font-pixel">
                                        <i class="fa-regular fa-clock mr-2 text-slate-500"></i> {{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }} WIB
                                    </div>
                                </div>

                                <div class="space-y-2 text-left sm:text-right">
                                    <div class="text-sm font-bold text-slate-800">
                                        <i class="fa-solid fa-school mr-1.5 text-primary"></i> {{ $schedule->room->name }} ({{ $schedule->room->code }})
                                    </div>
                                    <div class="text-xs text-slate-500 font-semibold">
                                        {{ $schedule->room->building->name }} ({{ $schedule->room->building->code }})
                                    </div>
                                    
                                    <!-- Coordinate Details -->
                                    <div class="inline-flex items-center gap-1.5 px-2 py-1 bg-red-50 text-red-700 border border-red-200 text-xxs font-mono">
                                        <i class="fa-solid fa-compass"></i>
                                        <span>Koordinat: <strong>X: {{ rand(10, 500) }}, Y: {{ $schedule->room->capacity + 15 }}, Z: {{ rand(-800, -10) }}</strong></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Lecturer Info inside Schedule -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 border-2 border-slate-900 bg-slate-100 flex-shrink-0 overflow-hidden shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]">
                                        <img src="{{ $schedule->lecturer->getAvatarUrl() }}" alt="{{ $schedule->lecturer->user->name }}" width="40" height="40" loading="lazy" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <span class="text-xxs text-slate-400 font-bold uppercase tracking-wider block">Dosen Pengampu</span>
                                        <span class="text-sm font-bold text-slate-900">{{ $schedule->lecturer->user->name }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-3">
                                    <div class="text-right hidden sm:block">
                                        <span class="text-xxs text-slate-400 font-bold uppercase tracking-wider block">Kapasitas Kelas</span>
                                        <span class="text-xs font-bold text-slate-800">{{ $schedule->room->capacity }} Mahasiswa / Server</span>
                                    </div>
                                    @if($schedule->lecturer->tiktok)
                                        <a href="{{ $schedule->lecturer->tiktok }}" target="_blank" class="px-3 py-1.5 bg-slate-900 hover:bg-primary text-white border-2 border-slate-950 text-xs font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex items-center gap-1.5 transition-all">
                                            <i class="fa-brands fa-tiktok"></i> TikTok Dosen
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-12 text-center text-slate-400">
                            <i class="fa-solid fa-calendar-xmark text-4xl mb-3 text-red-500"></i>
                            <p class="font-pixel uppercase">Belum ada jadwal perkuliahan yang dijadwalkan untuk mata kuliah ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Course Meta Info (Right 1 col) -->
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b-4 border-slate-950 pb-3">
                    <h2 class="text-2xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                        <i class="fa-solid fa-circle-info mr-2"></i> Detail Modul
                    </h2>
                </div>

                <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 space-y-6">
                    <div class="space-y-2">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Silabus Pembelajaran</h4>
                        <p class="text-sm text-slate-600">
                            Mata kuliah ini dirancang untuk membekali mahasiswa dengan kemampuan teoretis dan praktis tingkat tinggi. Silabus mencakup eksplorasi Overworld, Nether, hingga The End, disesuaikan dengan kurikulum standar Kementerian Overworld Mojang.
                        </p>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-slate-100">
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Prasyarat Survival</h4>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <i class="fa-solid fa-shield-halved text-emerald-600"></i> Full Armor Diamond / Netherite
                            </div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <i class="fa-solid fa-wrench text-amber-500"></i> Paham Crafting & Mekanika Dasar
                            </div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-700">
                                <i class="fa-solid fa-heart text-red-500"></i> 10 Jantung Kesehatan Maksimal (No Hardcore mode)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
