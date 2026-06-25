<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Fakultas & Program Studi
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Temukan Keahlian Voxel & <span class="text-primary font-pixel text-5xl sm:text-6xl">Dimensimu</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Pilih dari berbagai fakultas dan jurusan unggulan kami yang terakreditasi dan siap bertualang di seluruh Overworld, Nether, hingga The End.
            </p>
        </div>

        <!-- Faculty Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($faculties as $faculty)
                <div class="bg-white border-4 border-slate-900 overflow-hidden hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 flex flex-col shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none group">
                    <!-- Card Top Graphic Decor -->
                    <div class="h-2.5 bg-primary border-b-2 border-slate-900 w-full"></div>
                    
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-6">
                        <!-- Faculty Identity -->
                        <div class="space-y-2">
                            <span class="inline-block text-xxs font-bold text-slate-400 uppercase tracking-widest">{{ $faculty->code }}</span>
                            <h2 class="text-xl font-bold text-slate-900 leading-tight">
                                <a href="{{ route('faculty.detail', $faculty->slug) }}" wire:navigate class="hover:text-primary transition-colors font-pixel uppercase text-2xl block">
                                    {{ $faculty->name }}
                                </a>
                            </h2>
                        </div>

                        <!-- Department List -->
                        <div class="space-y-3 pt-4 border-t-2 border-slate-900">
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider">Program Studi / Jurusan:</h3>
                            <div class="space-y-2">
                                @forelse($faculty->departments as $department)
                                    <a href="{{ route('department.detail', $department->slug) }}" wire:navigate class="flex items-center gap-3 p-2.5 border-2 border-slate-900 hover:bg-slate-50 transition-colors duration-150 rounded-none shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] bg-white group/dept">
                                        <span class="inline-flex items-center justify-center px-2 py-0.5 border-2 border-slate-900 bg-primary/10 text-primary font-extrabold text-[10px] uppercase shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)] rounded-none">
                                            {{ $department->code }}
                                        </span>
                                        <div>
                                            <span class="text-xs font-bold text-slate-750 group-hover/dept:text-primary transition-colors">
                                                {{ $department->name }}
                                            </span>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-xs text-slate-400 italic">Belum ada jurusan.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- View Faculty Details link -->
                        <div class="pt-4 border-t-2 border-slate-900 flex justify-center">
                            <a href="{{ route('faculty.detail', $faculty->slug) }}" wire:navigate class="w-full text-center px-4 py-2 border-2 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                                Lihat Detail Fakultas <i class="fa-solid fa-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none">
                    <i class="fa-solid fa-triangle-exclamation text-slate-400 text-4xl mx-auto block mb-4"></i>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900 uppercase font-pixel">Data Fakultas Kosong</h3>
                    <p class="mt-1 text-xs text-slate-500">Silakan jalankan database seeder terlebih dahulu.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
