<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Back Navigation -->
        <div>
            <a href="{{ route('partner-schools.index') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 text-slate-800 text-xs font-extrabold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer rounded-none">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Mitra
            </a>
        </div>

        <!-- School Detail Card -->
        <div class="bg-white border-4 border-slate-900 p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] space-y-8 rounded-none">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row items-center gap-6 pb-6 border-b-4 border-slate-900">
                <!-- Logo -->
                <div class="h-28 w-28 rounded-none border-4 border-slate-900 bg-slate-100 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden flex-shrink-0 flex items-center justify-center">
                    <img src="{{ $school->getLogoUrl() }}" alt="{{ $school->name }}" class="h-full w-full object-cover">
                </div>

                <!-- Title & Socials -->
                <div class="space-y-4 text-center sm:text-left flex-grow">
                    <span class="inline-flex items-center px-2.5 py-0.5 border-2 border-slate-900 bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)]">
                        Sekolah Mitra UNEMO
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 uppercase font-pixel tracking-wide">
                        {{ $school->name }}
                    </h1>
                    
                    @if($school->tiktok_link)
                        <div>
                            <a href="{{ $school->tiktok_link }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 border-2 border-slate-900 bg-white hover:bg-slate-50 text-slate-800 font-extrabold text-xxs uppercase shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                <i class="fa-brands fa-tiktok text-rose-500"></i>
                                TikTok Resmi
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Description / Content Section -->
            <div class="space-y-4">
                <h3 class="font-extrabold text-slate-900 text-sm uppercase tracking-wider font-pixel">Deskripsi & Rincian Kerja Sama</h3>
                
                <!-- Tailwind Typography container for HTML rendering -->
                <div class="prose max-w-none prose-slate prose-headings:font-extrabold prose-headings:uppercase prose-headings:text-slate-900 prose-p:leading-relaxed prose-a:text-primary prose-a:font-bold prose-strong:text-slate-900 font-sans text-sm pt-2">
                    {!! $school->description !!}
                </div>
            </div>
        </div>

    </div>
</div>
