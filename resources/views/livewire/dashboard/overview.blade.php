<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Dashboard Sidebar (3 Cols) -->
            <aside class="lg:col-span-3 space-y-6">
                <!-- User Quick Info -->
                <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                    @if($user && $user->student)
                        <img src="{{ $user->student->getAvatarUrl() }}" alt="Avatar" class="h-20 w-20 mx-auto border-4 border-slate-900 bg-primary-pastel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] object-contain mb-4">
                    @else
                        <div class="h-20 w-20 mx-auto border-4 border-slate-900 bg-secondary-pastel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center text-slate-800 font-pixel text-4xl mb-4 uppercase">
                            {{ substr($user->name ?? 'U', 0, 1) }}
                        </div>
                    @endif
                    <h3 class="font-pixel text-xl font-extrabold text-slate-900 uppercase tracking-wide">{{ $user->name }}</h3>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">{{ $user->roles->first()?->name ?? 'User' }}</p>
                </div>

                <!-- Navigation Menu -->
                <div class="bg-white border-4 border-slate-900 p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard.overview') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-slate-900 bg-primary text-white font-extrabold uppercase text-xs tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
                            <i class="fa-solid fa-chart-simple text-sm"></i>
                            <span>Statistik & Jadwal</span>
                        </a>
                        <a href="{{ route('dashboard.profile') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 font-extrabold uppercase text-xs tracking-wider transition-all">
                            <i class="fa-solid fa-user text-sm"></i>
                            <span>Profil Saya</span>
                        </a>
                        @if($user && ($user->hasRole('Super Admin') || $user->hasRole('Academic Staff') || $user->hasRole('Lecturer') || $user->hasRole('Student')))
                            <a href="/admin" 
                               class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-secondary-pastel font-extrabold uppercase text-xs tracking-wider transition-all">
                                <i class="fa-solid fa-shield-halved text-sm text-secondary"></i>
                                <span>Portal Admin (Filament)</span>
                            </a>
                        @endif
                        <hr class="border-slate-900 border-t-2 my-2">
                        <a href="{{ route('home') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-red-600 hover:border-slate-900 hover:bg-red-50 font-extrabold uppercase text-xs tracking-wider transition-all">
                            <i class="fa-solid fa-house text-sm"></i>
                            <span>Kembali Ke Beranda</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Dashboard Content Area (9 Cols) -->
            <main class="lg:col-span-9 space-y-8">
                <!-- Welcome Banner -->
                <div class="bg-primary-pastel border-4 border-slate-900 p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
                    <div class="relative z-10 space-y-2">
                        <span class="inline-flex items-center px-2.5 py-1 border-2 border-slate-900 text-[10px] font-extrabold uppercase tracking-wide bg-white text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            Dashboard Portal
                        </span>
                        <h2 class="text-3xl font-extrabold text-slate-900 font-pixel uppercase tracking-wide">Selamat Datang Kembali, {{ $user->name }}!</h2>
                        <p class="text-xs text-slate-700 max-w-2xl">
                            Pantau kemajuan akademik Anda, jadwal perkuliahan, dan pencapaian survival Anda di lingkungan Universitas Negeri Mojang secara real-time.
                        </p>
                    </div>
                </div>

                <!-- Student Statistics Section -->
                @if($user && $user->student)
                    <section class="space-y-4">
                        <div class="flex items-center gap-2">
                            <span class="h-4 w-4 bg-primary border-2 border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]"></span>
                            <h3 class="font-extrabold text-slate-900 font-pixel uppercase text-xl tracking-wide">Statistik Akademik Mahasiswa</h3>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-6">
                            <!-- IPK Card -->
                            <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between group hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all">
                                <span class="text-slate-500 font-bold uppercase text-[10px] tracking-wider">Indeks Prestasi Kumulatif (IPK)</span>
                                <div class="flex items-baseline gap-2 mt-2">
                                    <span class="text-3xl font-extrabold font-pixel text-primary">{{ number_format($user->student->gpa, 2) }}</span>
                                    <span class="text-xs text-slate-400 font-bold">/ 4.00</span>
                                </div>
                                <div class="mt-4 pt-3 border-t-2 border-slate-100 flex items-center gap-1.5 text-[10px] font-extrabold text-emerald-600 uppercase">
                                    <i class="fa-solid fa-arrow-trend-up"></i>
                                    <span>Sangat Memuaskan</span>
                                </div>
                            </div>

                            <!-- SKS Card -->
                            <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between group hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all">
                                <span class="text-slate-500 font-bold uppercase text-[10px] tracking-wider">Total Kredit (SKS)</span>
                                <div class="flex items-baseline gap-1 mt-2">
                                    <span class="text-3xl font-extrabold font-pixel text-secondary">{{ $user->student->credit_hours }}</span>
                                    <span class="text-xs text-slate-400 font-bold">SKS</span>
                                </div>
                                <div class="mt-4 pt-3 border-t-2 border-slate-100 flex items-center gap-1.5 text-[10px] font-extrabold text-slate-500 uppercase">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <span>Batas Maks 144 SKS</span>
                                </div>
                            </div>

                            <!-- Semester Card -->
                            <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between group hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all">
                                <span class="text-slate-500 font-bold uppercase text-[10px] tracking-wider">Semester Aktif</span>
                                <div class="flex items-baseline gap-1 mt-2">
                                    <span class="text-3xl font-extrabold font-pixel text-primary">0{{ $user->student->current_semester }}</span>
                                    <span class="text-xs text-slate-400 font-bold">/ Genap</span>
                                </div>
                                <div class="mt-4 pt-3 border-t-2 border-slate-100 flex items-center gap-1.5 text-[10px] font-extrabold text-blue-600 uppercase">
                                    <i class="fa-solid fa-calendar-day"></i>
                                    <span>Tahun Ke-2 Survival</span>
                                </div>
                            </div>

                            <!-- Major Card -->
                            <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between group hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all">
                                <span class="text-slate-500 font-bold uppercase text-[10px] tracking-wider">Program Studi Voxel</span>
                                <div class="mt-2 min-h-[2.5rem] flex items-center">
                                    <span class="text-xs font-extrabold text-slate-900 uppercase font-pixel tracking-wide leading-tight block">
                                        {{ $user->student->department->name ?? 'TI' }}
                                    </span>
                                </div>
                                <div class="mt-2 pt-3 border-t-2 border-slate-100 flex items-center gap-1.5 text-[10px] font-extrabold text-slate-500 uppercase">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                    <span>NIM: {{ $user->student->nim }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Achievements / Prestasi -->
                        <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] space-y-4">
                            <div class="flex items-center gap-2 border-b-2 border-slate-900 pb-3">
                                <i class="fa-solid fa-trophy text-yellow-500"></i>
                                <h4 class="font-extrabold text-slate-900 text-xs uppercase tracking-wide">Daftar Prestasi & Sertifikasi Voxel</h4>
                            </div>
                            @if($user->student->achievements && count($user->student->achievements) > 0)
                                <ul class="space-y-3">
                                    @foreach($user->student->achievements as $ach)
                                        <li class="flex items-start gap-3">
                                            <span class="inline-flex h-5 w-5 bg-emerald-100 text-emerald-700 border-2 border-slate-900 items-center justify-center text-[10px] font-bold rounded-none flex-shrink-0 mt-0.5">
                                                ✓
                                            </span>
                                            <span class="text-xs font-bold text-slate-700 uppercase">{{ $ach }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-xs text-slate-500 italic">Belum ada prestasi tercatat. Yuk ikuti perlombaan redstone atau ujian survival!</p>
                            @endif
                        </div>
                    </section>
                @endif

                <!-- Class Schedules Section -->
                <section class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="h-4 w-4 bg-secondary border-2 border-slate-900 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]"></span>
                            <h3 class="font-extrabold text-slate-900 font-pixel uppercase text-xl tracking-wide">Jadwal Kelas / Kegiatan Survival</h3>
                        </div>
                        <span class="text-[10px] text-slate-500 font-bold uppercase">Total: {{ $schedules->count() }} Kegiatan</span>
                    </div>

                    @if($schedules->isNotEmpty())
                        <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y-2 divide-slate-900 text-left text-xs font-bold">
                                    <thead class="bg-slate-50 uppercase text-slate-700 border-b-2 border-slate-900 font-extrabold">
                                        <tr>
                                            <th scope="col" class="px-6 py-4">Hari / Waktu</th>
                                            <th scope="col" class="px-6 py-4">Mata Kuliah</th>
                                            <th scope="col" class="px-6 py-4">Ruangan & Gedung</th>
                                            <th scope="col" class="px-6 py-4">Dosen Pengampu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-900 bg-white">
                                        @foreach($schedules as $sched)
                                            <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <span class="inline-block px-2.5 py-1 border-2 border-slate-900 bg-secondary-pastel text-slate-800 text-[10px] font-extrabold uppercase shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] mr-2">
                                                        {{ $sched->day_of_week }}
                                                    </span>
                                                    <span class="font-pixel text-sm">{{ $sched->start_time->format('H:i') }} - {{ $sched->end_time->format('H:i') }}</span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="font-extrabold text-slate-900 uppercase">{{ $sched->course->name }}</div>
                                                    <div class="text-[10px] text-slate-500 tracking-wider">KODE: {{ $sched->course->code }} ({{ $sched->course->credits }} SKS)</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <div class="text-slate-800 uppercase">Lab {{ $sched->room->name }}</div>
                                                    <div class="text-[10px] text-slate-500 tracking-wider">Gedung {{ $sched->room->building->name ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-slate-600">
                                                    {{ $sched->lecturer->user->name ?? 'Dosen UNEMO' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-white border-4 border-slate-900 p-8 text-center shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                            <i class="fa-regular-calendar text-3xl text-slate-300 mb-3 block"></i>
                            <p class="text-xs text-slate-500 italic">Tidak ada jadwal perkuliahan aktif untuk Anda saat ini.</p>
                        </div>
                    @endif
                </section>
            </main>
            
        </div>
    </div>
</div>
