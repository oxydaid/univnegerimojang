<footer class="bg-white text-slate-800 border-t-4 border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 md:py-16">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12">
            <!-- Left Info column -->
            <div class="col-span-2 space-y-4 sm:space-y-6">
                <div class="flex items-center gap-3">
                    @if($settings->logo)
                        <img class="h-10 w-auto object-contain border-2 border-slate-900 p-1" src="{{ asset($settings->logo) }}" alt="{{ $settings->app_name }}" width="160" height="40" loading="lazy">
                    @else
                        <div class="h-10 w-10 rounded-none border-2 border-slate-900 bg-secondary flex items-center justify-center text-white font-black text-lg shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            U
                        </div>
                    @endif
                    <span class="font-extrabold text-slate-900 text-lg tracking-tight font-pixel text-xl uppercase">{{ $settings->app_name }}</span>
                </div>
                <p class="text-xs sm:text-sm text-slate-600 max-w-md leading-relaxed hidden sm:block">
                    {{ $settings->app_description }}
                </p>
                <!-- Social media links -->
                <div class="flex space-x-3">
                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="Facebook">
                            <i class="fa-brands fa-facebook"></i>
                        </a>
                    @endif
                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    @endif
                    @if($settings->twitter_url)
                        <a href="{{ $settings->twitter_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="Twitter">
                            <i class="fa-brands fa-x-twitter"></i>
                        </a>
                    @endif
                    @if($settings->github_url)
                        <a href="{{ $settings->github_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="Github">
                            <i class="fa-brands fa-github"></i>
                        </a>
                    @endif
                    @if($settings->tiktok_url)
                        <a href="{{ $settings->tiktok_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="TikTok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    @endif
                    @if($settings->discord_url)
                        <a href="{{ $settings->discord_url }}" target="_blank" class="h-8 w-8 flex items-center justify-center border-2 border-slate-900 bg-white text-slate-800 hover:bg-slate-50 hover:-translate-y-0.5 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150" aria-label="Discord">
                            <i class="fa-brands fa-discord"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Links Column -->
            <div class="col-span-1">
                <h3 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-4 font-pixel text-sm">Navigasi</h3>
                <ul class="space-y-2 text-xs font-extrabold uppercase">
                    <li><a href="{{ route('home') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Home</a></li>
                    <li><a href="{{ route('faculty') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Fakultas & Jurusan</a></li>
                    <li><a href="{{ route('organization') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Struktur Organisasi</a></li>
                    <li><a href="{{ route('about') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Tentang Kami</a></li>
                    <li><a href="{{ route('smpt.register') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Pendaftaran SMPT</a></li>
                    <li><a href="{{ route('smpt.guide') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Panduan SMPT</a></li>
                    <li><a href="{{ route('contact') }}" wire:navigate class="text-slate-600 hover:text-primary transition-colors duration-150">Hubungi Kami</a></li>
                </ul>
            </div>

            <!-- Contact Column -->
            <div class="col-span-1">
                <h3 class="text-xs font-bold text-slate-900 tracking-wider uppercase mb-4 font-pixel text-sm">Kontak</h3>
                <ul class="space-y-3 text-xs font-bold text-slate-700">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-map-location-dot text-primary flex-shrink-0 mt-0.5 text-sm"></i>
                        <span>Gedung Rektorat Steve, Koordinat X: 100, Y: 64, Z: -250, Overworld</span>
                    </li>
                    @if($settings->whatsapp_number)
                        <li class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-primary flex-shrink-0 text-sm"></i>
                            <span>+{{ $settings->whatsapp_number }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="mt-6 sm:mt-12 pt-6 sm:pt-8 border-t-2 border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-bold text-slate-700">
            <span>&copy; {{ date('Y') }} {{ $settings->app_name }}. Hak Cipta Dilindungi Undang-Undang.</span>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-primary transition-colors duration-150">Kebijakan Privasi</a>
                <a href="#" class="hover:text-primary transition-colors duration-150">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>
