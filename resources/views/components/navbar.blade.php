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
            <div class="hidden md:flex items-center space-x-1.5" x-data="{ openMenu: null }">
                <a href="{{ route('home') }}" 
                   wire:navigate
                   class="px-3 py-1.5 border-2 {{ request()->routeIs('home') ? 'border-slate-900 bg-primary text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50' }} text-xs font-extrabold uppercase tracking-wide transition-all duration-150">
                    Home
                </a>

                <!-- Akademik Dropdown -->
                <div class="relative" @mouseenter="openMenu = 'akademik'" @mouseleave="openMenu = null" @click.away="if (openMenu === 'akademik') openMenu = null">
                    <button type="button" @click="openMenu = (openMenu === 'akademik' ? null : 'akademik')"
                            class="px-3 py-1.5 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 text-xs font-extrabold uppercase tracking-wide transition-all duration-150 flex items-center gap-1">
                        Akademik <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    <div x-show="openMenu === 'akademik'" 
                         x-transition 
                         x-cloak
                         class="absolute left-0 mt-1 w-48 bg-white border-2 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] py-1 z-50">
                        <a href="{{ route('faculty') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Fakultas</a>
                        <a href="{{ route('academic.calendar') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Kalender Akademik</a>
                        <a href="{{ route('organization') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Struktur Organisasi</a>
                        <a href="{{ route('partner-schools.index') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Mitra Sekolah</a>
                    </div>
                </div>

                <!-- SMPT Dropdown -->
                <div class="relative" @mouseenter="openMenu = 'smpt'" @mouseleave="openMenu = null" @click.away="if (openMenu === 'smpt') openMenu = null">
                    <button type="button" @click="openMenu = (openMenu === 'smpt' ? null : 'smpt')"
                            class="px-3 py-1.5 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 text-xs font-extrabold uppercase tracking-wide transition-all duration-150 flex items-center gap-1">
                        SMPT <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    <div x-show="openMenu === 'smpt'" 
                         x-transition 
                         x-cloak
                         class="absolute left-0 mt-1 w-48 bg-white border-2 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] py-1 z-50">
                        <a href="{{ route('smpt.guide') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Panduan SMPT</a>
                        <a href="{{ route('smpt.register') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Pendaftaran SMPT</a>
                        <a href="{{ route('smpt.check') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Cek Kelulusan</a>
                        <a href="{{ route('smpt.graduation-list') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Hasil Seleksi</a>
                    </div>
                </div>

                <!-- Tentang Kami Dropdown -->
                <div class="relative" @mouseenter="openMenu = 'tentang'" @mouseleave="openMenu = null" @click.away="if (openMenu === 'tentang') openMenu = null">
                    <button type="button" @click="openMenu = (openMenu === 'tentang' ? null : 'tentang')"
                            class="px-3 py-1.5 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 text-xs font-extrabold uppercase tracking-wide transition-all duration-150 flex items-center gap-1">
                        Tentang Kami <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </button>
                    <div x-show="openMenu === 'tentang'" 
                         x-transition 
                         x-cloak
                         class="absolute right-0 mt-1 w-48 bg-white border-2 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] py-1 z-50">
                        <a href="{{ route('about') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Tentang UNEMO</a>
                        <a href="{{ route('alumni') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Alumni</a>
                        <a href="{{ route('contact') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-700 hover:bg-slate-50 uppercase">Hubungi Kami</a>
                    </div>
                </div>
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
          class="md:hidden bg-white border-t-2 border-slate-900" 
          id="mobile-menu"
          x-data="{ activeDropdown: null }">
         <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
             <a href="{{ route('home') }}" 
                wire:navigate
                class="block px-4 py-3 border-2 {{ request()->routeIs('home') ? 'border-slate-900 bg-primary text-white shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]' : 'border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50' }} rounded-none text-sm font-extrabold uppercase transition-all duration-150">
                 Home
             </a>
 
             <!-- Akademik Dropdown Mobile -->
             <div class="space-y-1">
                 <button type="button" 
                         @click="activeDropdown = (activeDropdown === 'akademik' ? null : 'akademik')"
                         class="w-full flex justify-between items-center px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 rounded-none text-sm font-extrabold uppercase transition-all duration-150">
                     <span>Akademik</span>
                     <i class="fa-solid" :class="activeDropdown === 'akademik' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                 </button>
                 <div x-show="activeDropdown === 'akademik'" x-collapse class="pl-4 space-y-1">
                     <a href="{{ route('faculty') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Fakultas</a>
                     <a href="{{ route('academic.calendar') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Kalender Akademik</a>
                     <a href="{{ route('organization') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Struktur Organisasi</a>
                     <a href="{{ route('partner-schools.index') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Mitra Sekolah</a>
                 </div>
             </div>
 
             <!-- SMPT Dropdown Mobile -->
             <div class="space-y-1">
                 <button type="button" 
                         @click="activeDropdown = (activeDropdown === 'smpt' ? null : 'smpt')"
                         class="w-full flex justify-between items-center px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 rounded-none text-sm font-extrabold uppercase transition-all duration-150">
                     <span>SMPT</span>
                     <i class="fa-solid" :class="activeDropdown === 'smpt' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                 </button>
                 <div x-show="activeDropdown === 'smpt'" x-collapse class="pl-4 space-y-1">
                     <a href="{{ route('smpt.guide') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Panduan SMPT</a>
                     <a href="{{ route('smpt.register') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Pendaftaran SMPT</a>
                     <a href="{{ route('smpt.check') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Cek Kelulusan</a>
                     <a href="{{ route('smpt.graduation-list') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Hasil Seleksi</a>
                 </div>
             </div>
 
             <!-- Tentang Kami Dropdown Mobile -->
             <div class="space-y-1">
                 <button type="button" 
                         @click="activeDropdown = (activeDropdown === 'tentang' ? null : 'tentang')"
                         class="w-full flex justify-between items-center px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 rounded-none text-sm font-extrabold uppercase transition-all duration-150">
                     <span>Tentang Kami</span>
                     <i class="fa-solid" :class="activeDropdown === 'tentang' ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                 </button>
                 <div x-show="activeDropdown === 'tentang'" x-collapse class="pl-4 space-y-1">
                     <a href="{{ route('about') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Tentang UNEMO</a>
                     <a href="{{ route('alumni') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Alumni</a>
                     <a href="{{ route('contact') }}" wire:navigate class="block px-4 py-2 text-xs font-bold text-slate-600 hover:bg-slate-50 uppercase border-l-2 border-slate-300">Hubungi Kami</a>
                 </div>
             </div>
 
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
