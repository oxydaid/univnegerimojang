<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Struktur Organisasi
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Pimpinan <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">Akademik & Voxel</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Pimpinan UNEMO berkomitmen tinggi membimbing institusi menuju standar kualitas tertinggi dan kesuksesan petualangan akademik.
            </p>
        </div>

        @php
            $rector = $staff->first(fn($s) => strtolower($s->position) === 'rektor');
            $viceRectors = $staff->filter(fn($s) => str_contains(strtolower($s->position), 'wakil rektor'));
            $others = $staff->reject(fn($s) => str_contains(strtolower($s->position), 'rektor'));
        @endphp

        <!-- Top Level: Rector -->
        @if($rector)
            <div class="flex justify-center mb-16">
                <div class="bg-white border-4 border-slate-900 p-8 max-w-md w-full text-center hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 relative group shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] rounded-none">
                    <div class="space-y-6">
                        <!-- Photo placeholder -->
                        <div class="mx-auto h-28 w-28 rounded-none border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-slate-100 relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                            <img src="{{ $rector->getAvatarUrl() }}" alt="{{ $rector->user->name }}" width="112" height="112" loading="lazy" class="h-full w-full object-cover">
                        </div>
                        
                        <div class="space-y-2">
                            <h3 class="font-extrabold text-slate-900 text-lg group-hover:text-primary transition-colors duration-200 uppercase">{{ $rector->user->name }}</h3>
                            <p class="text-xs font-extrabold uppercase tracking-wider text-secondary">{{ $rector->position }}</p>
                            <p class="text-[10px] text-slate-400 font-bold uppercase">NIP. {{ $rector->nip }}</p>
                            
                            @if($rector->tiktok)
                                <div class="pt-2 flex justify-center">
                                    <a href="{{ $rector->tiktok }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)] font-extrabold text-xxs uppercase transition-all duration-150 rounded-none">
                                        <i class="fa-brands fa-tiktok text-rose-500 mr-1"></i>
                                        TikTok
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Second Level: Vice Rectors -->
        @if($viceRectors->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-16">
                @foreach($viceRectors as $vr)
                    <div class="bg-white border-4 border-slate-900 p-6 text-center hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 relative group shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none">
                        <div class="space-y-4 font-sans">
                            <div class="mx-auto h-24 w-24 rounded-none border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-slate-100 relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ $vr->getAvatarUrl() }}" alt="{{ $vr->user->name }}" width="96" height="96" loading="lazy" class="h-full w-full object-cover">
                            </div>
                            
                            <div class="space-y-2">
                                <h4 class="font-extrabold text-slate-900 text-base group-hover:text-primary transition-colors duration-200 uppercase">{{ $vr->user->name }}</h4>
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-500">{{ $vr->position }}</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase">NIP. {{ $vr->nip }}</p>

                                @if($vr->tiktok)
                                    <div class="pt-1 flex justify-center">
                                        <a href="{{ $vr->tiktok }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)] font-extrabold text-xxs uppercase transition-all duration-150 rounded-none">
                                            <i class="fa-brands fa-tiktok text-rose-500 mr-1"></i>
                                            TikTok
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <!-- Third Level: Deans & Other Officers -->
        @if($others->isNotEmpty())
            <div class="max-w-6xl mx-auto">
                <h3 class="text-center font-extrabold text-slate-500 uppercase tracking-widest text-xs mb-8">Dekan & Pejabat Universitas</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($others as $oth)
                        <div class="bg-white border-4 border-slate-900 p-6 text-center hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none group">
                            <div class="space-y-4 font-sans">
                                <div class="mx-auto h-20 w-20 rounded-none border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-slate-100 relative overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                    <img src="{{ $oth->getAvatarUrl() }}" alt="{{ $oth->user->name }}" width="80" height="80" loading="lazy" class="h-full w-full object-cover">
                                </div>
                                
                                <div class="space-y-2">
                                    <h4 class="font-extrabold text-slate-900 text-sm group-hover:text-primary transition-colors duration-200 uppercase">{{ $oth->user->name }}</h4>
                                    <p class="text-xs font-bold text-slate-500 uppercase">{{ $oth->position }}</p>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase">NIP. {{ $oth->nip }}</p>

                                    @if($oth->tiktok)
                                        <div class="pt-1 flex justify-center">
                                            <a href="{{ $oth->tiktok }}" target="_blank" class="inline-flex items-center gap-1 px-2.5 py-1 border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)] font-extrabold text-xxs uppercase transition-all duration-150 rounded-none">
                                                <i class="fa-brands fa-tiktok text-rose-500 mr-1"></i>
                                                TikTok
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
