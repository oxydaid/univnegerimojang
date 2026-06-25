<div class="py-12 bg-brutal-bg min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-slate-500 gap-2 items-center overflow-x-auto whitespace-nowrap flex-nowrap pb-1 scrollbar-none w-full" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex-shrink-0"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('faculty') }}" class="hover:text-primary transition-colors flex-shrink-0">Fakultas</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <span class="text-slate-800 font-semibold flex-shrink-0">{{ $faculty->name }}</span>
        </nav>

        <!-- Faculty Hero/Header Card -->
        <div class="relative bg-white border-4 border-slate-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 rounded-none overflow-hidden">
            <!-- Decorative Minecraft Background Accent -->
            <div class="absolute right-0 top-0 h-full w-1/3 bg-slate-900/5 pointer-events-none hidden md:block" style="background-image: radial-gradient(circle, #0f172a 10%, transparent 11%); background-size: 16px 16px;"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="space-y-4">
                    <span class="inline-flex items-center px-3 py-1 bg-primary text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        Kode: {{ $faculty->code }}
                    </span>
                    <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-none font-pixel">
                        {{ $faculty->name }}
                    </h1>
                    <p class="text-slate-600 max-w-2xl text-base">
                        Fakultas unggulan di Universitas Negeri Mojang yang memfokuskan pengajaran pada aspek-aspek dimensi {{ $faculty->name }}, mencetak praktisi profesional di seluruh penjuru Overworld.
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-primary/10 border-2 border-slate-900 flex items-center justify-center text-primary text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-diagram-project"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalDepts }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Program Studi</div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-amber-500/10 border-2 border-slate-900 flex items-center justify-center text-amber-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-book-bookmark"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalCourses }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Mata Kuliah</div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-emerald-500/10 border-2 border-slate-900 flex items-center justify-center text-emerald-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalLecturers }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Dosen Pengajar</div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-blue-500/10 border-2 border-slate-900 flex items-center justify-center text-blue-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-user-graduate"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalStudents }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Mahasiswa</div>
                </div>
            </div>
        </div>

        <!-- Main Content Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Departments List (Left 2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between border-b-4 border-slate-950 pb-3">
                    <h2 class="text-2xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                        <i class="fa-solid fa-graduation-cap mr-2"></i> Program Studi / Jurusan
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($faculty->departments as $department)
                        <a href="{{ route('department.detail', $department->slug) }}" class="group bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between p-6">
                            <div class="space-y-3">
                                <span class="inline-block text-xxs font-bold text-slate-400 uppercase tracking-widest">{{ $department->code }}</span>
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-primary transition-colors leading-tight">
                                    {{ $department->name }}
                                </h3>
                                <p class="text-xs text-slate-500 font-sans">
                                    Mempelajari keahlian khusus di bidang {{ $department->name }} dengan fokus praktik bertualang.
                                </p>
                            </div>
                            
                            <div class="mt-6 flex items-center justify-between text-xs font-bold text-primary group-hover:underline pt-4 border-t border-slate-100">
                                <span>Lihat Kurikulum & Detail</span>
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </div>
                        </a>
                    @empty
                        <div class="col-span-full bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-12 text-center text-slate-400">
                            <i class="fa-solid fa-triangle-exclamation text-3xl mb-3 text-amber-500"></i>
                            <p class="font-pixel uppercase">Belum ada jurusan terdaftar di fakultas ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Lecturers / Dosen Gallery (Right 1 col) -->
            <div class="space-y-6">
                <div class="flex items-center justify-between border-b-4 border-slate-950 pb-3">
                    <h2 class="text-2xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                        <i class="fa-solid fa-user-shield mr-2"></i> Dosen Fakultas
                    </h2>
                </div>

                <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 space-y-4 max-h-[600px] overflow-y-auto">
                    @php $hasLecturer = false; @endphp
                    @foreach($faculty->departments as $dept)
                        @foreach($dept->lecturers as $lecturer)
                            @php $hasLecturer = true; @endphp
                            <div class="flex items-center justify-between p-3 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <!-- Avatar Image -->
                                    <div class="h-10 w-10 border-2 border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] bg-slate-100 flex-shrink-0 overflow-hidden">
                                        <img src="{{ $lecturer->getAvatarUrl() }}" alt="{{ $lecturer->user->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-bold text-slate-900 leading-tight">{{ $lecturer->user->name }}</h4>
                                        <p class="text-xxs text-slate-500 font-mono">NIP. {{ $lecturer->nip }}</p>
                                        <p class="text-xxs text-primary font-bold">{{ $dept->name }}</p>
                                    </div>
                                </div>
                                @if($lecturer->tiktok)
                                    <a href="{{ $lecturer->tiktok }}" target="_blank" class="h-7 w-7 rounded-none border-2 border-slate-900 bg-white text-slate-850 flex items-center justify-center hover:bg-slate-50 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all text-xs" title="Ikuti di TikTok">
                                        <i class="fa-brands fa-tiktok text-rose-500"></i>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    @endforeach

                    @if(!$hasLecturer)
                        <p class="text-sm text-slate-400 italic text-center py-6">Belum ada dosen yang terdaftar di fakultas ini.</p>
                    @endif
                </div>
            </div>
            
        </div>

    </div>
</div>
