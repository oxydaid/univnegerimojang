<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- SEO Meta Tags -->
        <title>{{ $title ?? ($settings->meta_title_default ?? $settings->app_name) }}</title>
        <meta name="description" content="{{ $description ?? ($settings->meta_description_default ?? $settings->app_description) }}">
        <meta name="keywords" content="{{ $settings->meta_keywords ?? '' }}">
        
        <!-- OpenGraph Meta Tags -->
        <meta property="og:title" content="{{ $settings->og_title ?? $settings->app_name }}">
        <meta property="og:description" content="{{ $settings->og_description ?? $settings->app_description }}">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        @if($settings->default_share_image)
            <meta property="og:image" content="{{ asset('storage/' . $settings->default_share_image) }}">
        @endif

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=VT323&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="https://laravel.com/img/logomark.min.svg">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Dynamic Theme Colors -->
        <style>
            :root {
                --primary-color: {{ $settings->primary_color ?? '#1e3a8a' }};
                --secondary-color: {{ $settings->secondary_color ?? '#d97706' }};
                --font-sans: 'Plus Jakarta Sans', 'Outfit', ui-sans-serif, system-ui, sans-serif;
                --font-pixel: 'VT323', monospace;
                
                /* Custom Neo-Brutalist Colors */
                --brutal-bg: #FAF6EE;
                --primary-pastel: color-mix(in srgb, var(--primary-color) 8%, white);
                --secondary-pastel: color-mix(in srgb, var(--secondary-color) 10%, white);
            }
            body {
                font-family: var(--font-sans);
            }
        </style>

        @livewireStyles
    </head>
    <body class="bg-brutal-bg text-slate-900 antialiased flex flex-col min-h-screen selection:bg-primary/20 selection:text-primary">
        
        <!-- Announcement Bar -->
        <div x-data="{ showAnnounce: true }" x-show="showAnnounce" class="bg-primary text-white border-b-4 border-slate-900 text-xs md:text-sm py-3 px-4 relative flex items-center justify-between transition-all duration-200">
            <div class="flex items-center gap-2 mx-auto pr-6">
                <span class="inline-flex items-center justify-center bg-white text-primary border-2 border-slate-900 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">PMB</span>
                <span class="font-bold text-center uppercase font-pixel tracking-wide text-sm">📢 Penerimaan Mahasiswa Baru (PMB) UNEMO 2026/2027 Telah Dibuka! <span class="hidden sm:inline">[Jalur Prestasi & Ujian Survival]</span></span>
            </div>
            <button @click="showAnnounce = false" class="text-white hover:text-slate-100 transition-colors duration-150 p-1 border-2 border-slate-900 bg-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-none absolute right-3 flex items-center justify-center cursor-pointer">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>

        <!-- Reusable Navbar -->
        <x-navbar />

        <!-- Main Content Area -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Reusable Footer -->
        <x-footer />

        @livewireScripts
        
        <!-- GA4 Measurement -->
        @if($settings->ga4_measurement_id)
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->ga4_measurement_id }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '{{ $settings->ga4_measurement_id }}');
            </script>
        @endif
    </body>
</html>
