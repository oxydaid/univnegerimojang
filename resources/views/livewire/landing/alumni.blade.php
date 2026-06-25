<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Alumni Sukses
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Alumni Kebanggaan <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">UNEMO</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Para penjelajah dan insinyur hebat yang telah lulus dan mengukir karya legendaris di seluruh dimensi Overworld, Nether, hingga The End.
            </p>
        </div>

        <!-- Alumni Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($alumni as $alumnus)
                <div class="bg-white border-4 border-slate-900 overflow-hidden hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 flex flex-col group relative shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none">
                    <!-- Top accent bar -->
                    <div class="h-2.5 bg-primary border-b-2 border-slate-900 w-full"></div>
                    
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-6">
                        <!-- Identity & Photo -->
                        <div class="space-y-4">
                            <!-- Image container with NameMC head rendering fallback -->
                            <div class="relative w-24 h-24 mx-auto rounded-none border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] overflow-hidden group-hover:scale-105 transition-transform duration-300">
                                <!-- Default fallback head image or NameMC Head render -->
                                <img src="https://api.mineatar.io/face/{{ strtolower($alumnus['name']) }}?scale=8" 
                                     onerror="this.src='{{ $alumnus['skin_preview'] }}'"
                                     alt="{{ $alumnus['name'] }}" 
                                     class="h-full w-full object-cover">
                            </div>
                            
                            <div class="text-center space-y-1">
                                <h3 class="font-extrabold text-slate-900 text-base group-hover:text-primary transition-colors duration-200 uppercase">
                                    {{ $alumnus['name'] }}
                                </h3>
                                <p class="text-[10px] font-extrabold text-secondary uppercase tracking-wider">
                                    {{ $alumnus['study_program'] }}
                                </p>
                                <span class="inline-block px-2.5 py-0.5 border border-slate-900 rounded-none text-[10px] font-extrabold bg-slate-100 text-slate-500 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] uppercase">
                                    Lulus Tahun {{ $alumnus['graduation_year'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Quote / Achievements -->
                        <div class="bg-slate-50 p-4 border-2 border-slate-900 rounded-none flex-grow">
                            <p class="text-xs text-slate-500 italic leading-relaxed text-center font-sans">
                                "{{ $alumnus['quote'] }}"
                            </p>
                        </div>

                        <!-- Action Link (TikTok / Profile) -->
                        <div class="pt-4 border-t-2 border-slate-900 flex justify-center items-center">
                            @if(!empty($alumnus['tiktok_url']))
                                <a href="{{ $alumnus['tiktok_url'] }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-extrabold text-xs uppercase transition-all duration-150">
                                    <i class="fa-brands fa-tiktok text-rose-500"></i>
                                    TikTok Alumni
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
