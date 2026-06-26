<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-secondary to-primary text-white p-8 rounded-none border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
            <div class="absolute right-4 -bottom-10 opacity-10 font-pixel text-[120px] pointer-events-none select-none">LULUS</div>
            <div class="relative z-10 space-y-3">
                <span class="inline-flex items-center px-3 py-1 bg-white/20 text-white border border-white/30 text-xs font-bold uppercase tracking-wider">
                    Hasil Seleksi & Kelulusan
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-pixel uppercase">
                    Daftar Kelulusan Calon Mahasiswa Baru
                </h1>
                <p class="text-xs sm:text-sm text-slate-100 max-w-xl leading-relaxed">
                    Daftar petualang akademik yang telah lolos seleksi berkas, prestasi, trivia ujian, maupun program kemitraan Universitas Negeri Mojang.
                </p>
            </div>
        </div>

        @if($settings && !$settings->graduation_list_published)
            <!-- Unpublished State -->
            <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-12 text-center space-y-6">
                <div class="text-8xl text-amber-500 animate-pulse"><i class="fa-solid fa-clock"></i></div>
                <div class="space-y-2">
                    <h2 class="text-3xl font-extrabold text-slate-900 font-pixel uppercase">Pengumuman Belum Dibuka</h2>
                    <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                        Mohon maaf, daftar kelulusan seleksi masuk mahasiswa baru (SMPT) Universitas Negeri Mojang saat ini belum dipublikasikan oleh Panitia Akademik. Silakan kembali lagi nanti atau hubungi kami melalui formulir kontak.
                    </p>
                </div>
            </div>
        @else
            <!-- Search and Filter Controls -->
            <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Search -->
                    <div class="space-y-1.5">
                        <label for="search" class="block text-xs font-bold text-slate-700 uppercase">Cari Nama / No. Daftar</label>
                        <div class="relative">
                            <input type="text" id="search" wire:model.live.debounce.300ms="search" class="w-full pl-9 pr-4 py-2.5 rounded-none border-2 border-slate-900 text-xs focus:border-primary outline-none bg-slate-50 focus:bg-white transition-colors" placeholder="e.g., Steve / REG-2026-...">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-magnifying-glass text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Department Filter -->
                    <div class="space-y-1.5">
                        <label for="department_id" class="block text-xs font-bold text-slate-700 uppercase">Program Studi</label>
                        <select id="department_id" wire:model.live="department_id" class="w-full px-3 py-2.5 rounded-none border-2 border-slate-900 text-xs focus:border-primary outline-none bg-white">
                            <option value="">Semua Program Studi</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }} ({{ $dept->code }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Path Filter -->
                    <div class="space-y-1.5">
                        <label for="path" class="block text-xs font-bold text-slate-700 uppercase">Jalur Masuk</label>
                        <select id="path" wire:model.live="path" class="w-full px-3 py-2.5 rounded-none border-2 border-slate-900 text-xs focus:border-primary outline-none bg-white">
                            <option value="">Semua Jalur</option>
                            <option value="nilai">📊 Jalur Nilai Rapot</option>
                            <option value="prestasi">🏆 Jalur Prestasi</option>
                            <option value="test">📝 Jalur Ujian Online</option>
                            <option value="beasiswa">💎 Jalur Beasiswa Kemitraan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Graduation Table/List -->
            <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-left">
                        <thead>
                            <tr class="border-b-4 border-slate-900 bg-slate-50 font-pixel text-xxs uppercase tracking-wider text-slate-700">
                                <th class="p-4 border-r-2 border-slate-900 w-16 text-center">No</th>
                                <th class="p-4 border-r-2 border-slate-900">No. Pendaftaran</th>
                                <th class="p-4 border-r-2 border-slate-900">Nama Lengkap</th>
                                <th class="p-4 border-r-2 border-slate-900">Program Studi</th>
                                <th class="p-4 border-r-2 border-slate-900">Jalur Masuk</th>
                                <th class="p-4 text-center">Hasil Seleksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-slate-900 text-xs font-medium">
                            @forelse($admissions as $index => $adm)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="p-4 border-r-2 border-slate-900 text-center font-bold text-slate-500">
                                        {{ $admissions->firstItem() + $index }}
                                    </td>
                                    <td class="p-4 border-r-2 border-slate-900 font-mono font-bold text-slate-800">
                                        {{ $adm->registration_number }}
                                    </td>
                                    <td class="p-4 border-r-2 border-slate-900 font-extrabold uppercase font-pixel text-slate-900 tracking-wide">
                                        {{ $adm->name }}
                                    </td>
                                    <td class="p-4 border-r-2 border-slate-900 text-slate-700 uppercase">
                                        {{ $adm->department->name ?? '-' }}
                                    </td>
                                    <td class="p-4 border-r-2 border-slate-900">
                                        <span class="inline-flex items-center px-2 py-0.5 border-2 border-slate-900 text-[10px] font-extrabold uppercase shadow-[1px_1px_0px_0px_rgba(0,0,0,1)]
                                            @if($adm->path === 'prestasi') bg-sky-100 text-sky-800
                                            @elseif($adm->path === 'nilai') bg-amber-100 text-amber-800
                                            @elseif($adm->path === 'test') bg-emerald-100 text-emerald-800
                                            @elseif($adm->path === 'beasiswa') bg-purple-100 text-purple-800
                                            @else bg-slate-100 text-slate-800 @endif">
                                            @if($adm->path === 'prestasi') 🏆 Prestasi
                                            @elseif($adm->path === 'nilai') 📊 Nilai Rapot
                                            @elseif($adm->path === 'test') 📝 Ujian Online
                                            @elseif($adm->path === 'beasiswa') 💎 Kemitraan
                                            @else {{ $adm->path }} @endif
                                        </span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="inline-flex items-center px-2 py-0.5 border-2 border-emerald-500 bg-emerald-50 text-[10px] font-bold uppercase text-emerald-700 shadow-[1px_1px_0px_0px_rgba(16,185,129,0.5)]">
                                            ✅ DITERIMA
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-slate-400 font-bold uppercase italic bg-slate-50">
                                        Tidak ada calon mahasiswa yang ditemukan dengan filter ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($admissions->hasPages())
                    <div class="p-4 border-t-4 border-slate-900 bg-slate-50">
                        {{ $admissions->links() }}
                    </div>
                @endif
            </div>
        @endif

    </div>
</div>
