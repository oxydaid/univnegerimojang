<nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white py-3 shadow-[0_4px_0_0_rgba(15,23,42,1)]' : 'bg-white py-4'"
     class="sticky top-0 z-50 transition-all duration-200 w-full border-b-4 border-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Brand / Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('home') }}" wire:navigate class="flex items-center gap-3 group">
                    @if($settings->logo)
                        <img class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-105" src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->app_name }}" width="160" height="40" loading="lazy">
                    @else
                        <!-- Premium SVG Logo fallback -->
                        <div class="h-11 w-11 rounded-none border-2 border-slate-900 bg-secondary flex items-center justify-center text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all duration-300 group-hover:rotate-3">
                            <span class="font-extrabold tracking-tight font-pixel text-2xl">M</span>
                        </div>
                    @endif
                    <div class="flex flex-col">
                        <span class="font-bold text-lg leading-none tracking-tight text-slate-900 group-hover:text-primary transition-colors duration-300 font-pixel text-2xl uppercase">
                            UNEMO
                        </span>
                        <span class="text-[10px] text-slate-500 tracking-wider uppercase font-bold">Unggul & Voxel</span>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-1.5">
                @php
                    $navLinks = [
                        ['name' => 'Home', 'route' => 'home'],
                        ['name' => 'Fakultas', 'route' => 'faculty'],
                        ['name' => 'Struktur Organisasi', 'route' => 'organization'],
                        ['name' => 'Tentang Kami', 'route' => 'about'],
                        ['name' => 'Alumni', 'route' => 'alumni'],
                        ['name' => 'SMPT', 'route' => 'smpt.register'],
                        ['name' => 'Panduan SMPT', 'route' => 'smpt.guide'],
                        ['name' => 'Hubungi Kami', 'route' => 'contact'],
                    ];
                @endphp

                @foreach($navLinks as $link)
                    <a href="{{ route($link['route']) }}" 
                       wire:navigate
                       class="px-3 py-1.5 border-2 {{ request()->routeIs($link['route']) ? 'border-slate-900 bg-primary text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50' }} text-xs font-extrabold uppercase tracking-wide transition-all duration-150">
                        {{ $link['name'] }}
                    </a>
                @endforeach
            </div>

            <!-- CTA / Action Button -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard.profile') }}" class="inline-flex items-center justify-center px-4 py-2 border-2 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Dashboard
                    </a>
                    <button onclick="document.getElementById('logout-form').submit();" class="inline-flex items-center justify-center px-4 py-2 border-2 border-slate-900 bg-red-600 hover:bg-red-700 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="/admin/login" class="inline-flex items-center justify-center px-4 py-2 border-2 border-slate-900 bg-secondary hover:bg-secondary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Portal Admin
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        type="button" 
                        class="inline-flex items-center justify-center p-2 rounded-none border-2 border-slate-900 text-slate-800 bg-white hover:bg-slate-50 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer" 
                        aria-controls="mobile-menu" 
                        :aria-expanded="mobileMenuOpen.toString()">
                    <span class="sr-only">Buka menu utama</span>
                    <!-- Icon Open (Hamburger) -->
                    <i x-show="!mobileMenuOpen" class="fa-solid fa-bars text-base block h-5 w-5 flex items-center justify-center"></i>
                    <!-- Icon Close -->
                    <i x-show="mobileMenuOpen" x-cloak class="fa-solid fa-xmark text-base block h-5 w-5 flex items-center justify-center"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu, show/hide based on menu state. -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-150"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-100"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         x-cloak
         class="md:hidden bg-white" 
         id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            @foreach($navLinks as $link)
                <a href="{{ route($link['route']) }}" 
                   wire:navigate
                   class="block px-4 py-3 border-2 {{ request()->routeIs($link['route']) ? 'border-slate-900 bg-primary text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50' }} rounded-none text-sm font-extrabold uppercase transition-all duration-150">
                    {{ $link['name'] }}
                </a>
            @endforeach
            <div class="pt-4 pb-2 border-t-2 border-slate-900 px-4 space-y-2">
                @auth
                    <a href="{{ route('dashboard.profile') }}" class="block w-full text-center px-4 py-3 border-2 border-slate-900 bg-primary text-white font-bold uppercase font-pixel text-sm shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        Dashboard
                    </a>
                    <button onclick="document.getElementById('logout-form-mobile').submit();" class="block w-full text-center px-4 py-3 border-2 border-slate-900 bg-red-600 text-white font-bold uppercase font-pixel text-sm shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Logout
                    </button>
                    <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="/admin/login" class="block w-full text-center px-4 py-3 border-2 border-slate-900 bg-secondary text-white font-bold uppercase font-pixel text-sm shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all">
                        Portal Admin
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>
