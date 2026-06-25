<div class="py-12 bg-brutal-bg min-h-screen font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        
        <!-- Breadcrumbs -->
        <nav class="flex text-sm text-slate-500 gap-2 items-center overflow-x-auto whitespace-nowrap flex-nowrap pb-1 scrollbar-none w-full" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors flex-shrink-0"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('faculty') }}" class="hover:text-primary transition-colors flex-shrink-0">Fakultas</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <a href="{{ route('faculty.detail', $department->faculty->slug) }}" class="hover:text-primary transition-colors flex-shrink-0">{{ $department->faculty->name }}</a>
            <i class="fa-solid fa-chevron-right text-xs flex-shrink-0"></i>
            <span class="text-slate-800 font-semibold flex-shrink-0">{{ $department->name }}</span>
        </nav>

        <!-- Department Header Card -->
        <div class="relative bg-white border-4 border-slate-900 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-8 rounded-none overflow-hidden">
            <div class="relative z-10 space-y-4">
                <div class="flex flex-wrap gap-3">
                    <span class="inline-flex items-center px-3 py-1 bg-primary text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        Prodi: {{ $department->code }}
                    </span>
                    <a href="{{ route('faculty.detail', $department->faculty->slug) }}" class="inline-flex items-center px-3 py-1 bg-slate-900 text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider hover:bg-primary transition-colors shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        Fakultas: {{ $department->faculty->code }}
                    </a>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight leading-none font-pixel">
                    {{ $department->name }}
                </h1>
                
                <!-- Coordinates Information -->
                <div class="inline-flex items-center gap-2 p-2 bg-slate-100 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-mono text-xs text-slate-700">
                    <i class="fa-solid fa-location-dot text-red-600"></i>
                    <span>Markas Prodi Koordinat: <strong>X: {{ rand(10, 500) }}, Y: {{ rand(60, 80) }}, Z: {{ rand(-800, -10) }}</strong> (Overworld)</span>
                </div>
            </div>
        </div>

        <!-- Statistics Cards Grid -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-primary/10 border-2 border-slate-900 flex items-center justify-center text-primary text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalCourses }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Mata Kuliah</div>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-amber-500/10 border-2 border-slate-900 flex items-center justify-center text-amber-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-award"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalCredits }} SKS</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Total SKS</div>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-emerald-500/10 border-2 border-slate-900 flex items-center justify-center text-emerald-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-chalkboard-user"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalLecturers }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Dosen Wali</div>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex items-center gap-4">
                <div class="h-12 w-12 bg-blue-500/10 border-2 border-slate-900 flex items-center justify-center text-blue-600 text-xl shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <div class="text-2xl font-extrabold font-pixel text-slate-950">{{ $totalStudents }}</div>
                    <div class="text-xs font-bold text-slate-500 uppercase tracking-wide">Mahasiswa</div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Courses List (Left 2 cols) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="flex items-center justify-between border-b-4 border-slate-950 pb-3">
                    <h2 class="text-2xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                        <i class="fa-solid fa-scroll mr-2"></i> Kurikulum Mata Kuliah
                    </h2>
                </div>

                <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                    <table class="min-w-full divide-y-4 divide-slate-900 font-sans">
                        <thead class="bg-slate-100">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-900 uppercase tracking-wider border-r-2 border-slate-900">Kode</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-900 uppercase tracking-wider border-r-2 border-slate-900">Nama Mata Kuliah</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-900 uppercase tracking-wider border-r-2 border-slate-900">Kredit (SKS)</th>
                                <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-slate-900 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y-2 divide-slate-900">
                            @forelse($department->courses as $course)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900 border-r-2 border-slate-900 font-mono">{{ $course->code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-800 border-r-2 border-slate-900">{{ $course->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-900 border-r-2 border-slate-900">{{ $course->credits }} SKS</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                                        <a href="{{ route('course.detail', $course->code) }}" class="inline-block px-3 py-1.5 bg-primary text-white border-2 border-slate-950 text-xs font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-slate-900 hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
                                            Detail & Jadwal
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">
                                        Belum ada mata kuliah yang terdaftar untuk jurusan ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Lecturers & Students (Right 1 col) -->
            <div class="space-y-8">
                <!-- Lecturers Card -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b-4 border-slate-950 pb-2">
                        <h2 class="text-xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                            <i class="fa-solid fa-id-card-clip mr-2"></i> Dosen Prodi
                        </h2>
                    </div>

                    <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 space-y-3">
                        @forelse($department->lecturers as $lecturer)
                            <div class="flex items-center justify-between p-2.5 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 border-2 border-slate-900 bg-slate-100 flex-shrink-0 overflow-hidden">
                                        <img src="{{ $lecturer->getAvatarUrl() }}" alt="{{ $lecturer->user->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900 leading-tight">{{ $lecturer->user->name }}</h4>
                                        <p class="text-xxs text-slate-500 font-mono">NIP. {{ $lecturer->nip }}</p>
                                    </div>
                                </div>
                                @if($lecturer->tiktok)
                                    <a href="{{ $lecturer->tiktok }}" target="_blank" class="h-6 w-6 rounded-none border-2 border-slate-900 bg-white text-slate-850 flex items-center justify-center hover:bg-slate-50 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all text-xxs" title="TikTok">
                                        <i class="fa-brands fa-tiktok text-rose-500"></i>
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-4">Belum ada dosen.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Students Card -->
                <div class="space-y-4">
                    <div class="flex items-center justify-between border-b-4 border-slate-950 pb-2">
                        <h2 class="text-xl font-bold text-slate-950 font-pixel uppercase tracking-wide">
                            <i class="fa-solid fa-users mr-2"></i> Daftar Mahasiswa
                        </h2>
                    </div>

                    <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 space-y-3">
                        @forelse($department->students as $student)
                            <div class="flex items-center justify-between p-2.5 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <div class="flex items-center gap-3">
                                    <div class="h-9 w-9 border-2 border-slate-900 bg-slate-100 flex-shrink-0 overflow-hidden">
                                        <img src="{{ $student->getAvatarUrl() }}" alt="{{ $student->user->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div>
                                        <h4 class="text-xs font-bold text-slate-900 leading-tight">{{ $student->user->name }}</h4>
                                        <p class="text-xxs text-slate-500 font-mono">NIM. {{ $student->nim }}</p>
                                    </div>
                                </div>
                                @if($student->tiktok)
                                    <a href="{{ $student->tiktok }}" target="_blank" class="h-6 w-6 rounded-none border-2 border-slate-900 bg-white text-slate-850 flex items-center justify-center hover:bg-slate-50 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all text-xxs" title="TikTok">
                                        <i class="fa-brands fa-tiktok text-rose-500"></i>
                                    </a>
                                @endif
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic text-center py-4">Belum ada mahasiswa.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
