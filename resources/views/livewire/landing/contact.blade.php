<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-16">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Hubungi Kami
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Kami Siap <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">Membantu Petualanganmu</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Punya pertanyaan mengenai pendaftaran (PMB), otomatisasi Redstone, dekorasi, atau koordinat kampus? Kirim pesan ke Rektorat kami.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 max-w-6xl mx-auto">
            <!-- Left Info Panel -->
            <div class="lg:col-span-5 space-y-8 bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 rounded-none">
                <h2 class="text-2xl font-bold text-slate-900 pb-4 border-b-2 border-slate-900 font-pixel text-3xl uppercase tracking-wide">Informasi Kontak</h2>
                
                <div class="space-y-6 font-sans">
                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <i class="fa-solid fa-map-location-dot text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-sm uppercase">Koordinat Kampus</h3>
                            <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                Gedung Rektorat Steve, Blok A-1<br>
                                Koordinat X: 100, Y: 64, Z: -250, Dunia Overworld
                            </p>
                        </div>
                    </div>

                    @if($settings->whatsapp_number)
                        <div class="flex items-start gap-4">
                            <div class="h-10 w-10 border-2 border-slate-900 bg-secondary/10 text-secondary flex items-center justify-center flex-shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-extrabold text-slate-800 text-sm uppercase">WhatsApp / Telepon</h3>
                                <p class="text-xs text-slate-500 mt-1">+{{ $settings->whatsapp_number }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-primary/10 text-primary flex items-center justify-center flex-shrink-0 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <i class="fa-solid fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-extrabold text-slate-800 text-sm uppercase">Alamat E-mail</h3>
                            <p class="text-xs text-slate-500 mt-1">info@unemo.ac.id</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="lg:col-span-7 bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 rounded-none">
                <form wire:submit.prevent="submit" class="space-y-6">
                    @if (session()->has('message'))
                        <div class="p-4 bg-emerald-50 border-2 border-emerald-500 text-emerald-800 text-sm font-semibold flex items-center gap-3">
                            <i class="fa-solid fa-circle-check text-emerald-600 text-lg flex-shrink-0"></i>
                            <span>{{ session('message') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-bold text-slate-700">Nama Lengkap</label>
                            <input type="text" id="name" wire:model="name" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="Masukkan nama Anda">
                            @error('name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-bold text-slate-700">Alamat E-mail</label>
                            <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="nama@email.com">
                            @error('email') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="subject" class="block text-sm font-bold text-slate-700">Subjek</label>
                        <input type="text" id="subject" wire:model="subject" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="Subjek pesan Anda">
                        @error('subject') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="message" class="block text-sm font-bold text-slate-700">Pesan</label>
                        <textarea id="message" wire:model="message" rows="5" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="Tuliskan pesan Anda secara detail..."></textarea>
                        @error('message') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center px-6 py-4 border-4 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-base shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all cursor-pointer rounded-none">
                        <!-- Loading indicator -->
                        <span wire:loading class="mr-2">
                            <i class="fa-solid fa-spinner animate-spin text-white"></i>
                        </span>
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
