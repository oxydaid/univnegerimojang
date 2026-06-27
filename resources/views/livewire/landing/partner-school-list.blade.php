<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Sekolah Kemitraan
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Mitra <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">Sekolah & Kampus</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                UNEMO bekerja sama dengan berbagai sekolah menengah atas untuk membina minat dan bakat calon petualang akademik sejak usia dini.
            </p>
        </div>

        @if($schools->isEmpty())
            <div class="bg-white border-4 border-slate-900 p-8 text-center max-w-md mx-auto shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <i class="fa-solid fa-school text-slate-400 text-5xl mb-4"></i>
                <h3 class="font-extrabold text-slate-900 text-lg uppercase font-pixel">Belum Ada Sekolah Mitra</h3>
                <p class="text-xs text-slate-500 mt-2 font-sans">Daftar sekolah mitra yang bekerja sama sedang dalam proses integrasi.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($schools as $school)
                    <div class="bg-white border-4 border-slate-900 p-6 flex flex-col justify-between hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none group">
                        <div class="space-y-4 font-sans flex-grow">
                            <!-- School Logo -->
                            <div class="mx-auto h-24 w-24 rounded-none border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-slate-100 relative overflow-hidden group-hover:scale-105 transition-transform duration-300 flex items-center justify-center">
                                <img src="{{ $school->getLogoUrl() }}" alt="{{ $school->name }}" loading="lazy" class="h-full w-full object-cover">
                            </div>
                            
                            <div class="space-y-2 text-center">
                                <h3 class="font-extrabold text-slate-900 text-base group-hover:text-primary transition-colors duration-200 uppercase leading-snug">
                                    {{ $school->name }}
                                </h3>
                            </div>
                            
                            <!-- Truncated description -->
                            <div class="text-xs text-slate-600 line-clamp-3 font-sans pt-2 border-t-2 border-slate-100">
                                {!! strip_tags($school->description) !!}
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t-2 border-slate-900 flex flex-col gap-2">
                            <a href="{{ route('partner-schools.show', $school->slug) }}" wire:navigate class="w-full text-center inline-flex items-center justify-center px-4 py-2 border-2 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                Profil Detail
                            </a>
                            
                            @if($school->tiktok_link)
                                <a href="{{ $school->tiktok_link }}" target="_blank" class="w-full text-center inline-flex items-center justify-center gap-1.5 px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 text-slate-800 font-extrabold uppercase text-[10px] tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                    <i class="fa-brands fa-tiktok text-rose-500"></i>
                                    TikTok Resmi
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
