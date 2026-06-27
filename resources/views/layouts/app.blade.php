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
        @if($settings && $settings->favicon)
            <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings->favicon) }}">
        @else
            <link rel="icon" type="image/x-icon" href="https://laravel.com/img/logomark.min.svg">
        @endif

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
        @if($settings && $settings->show_announcement)
            <div x-data="{ showAnnounce: true }" x-show="showAnnounce" 
                 style="background-color: {{ $settings->announcement_bg_color }}; color: {{ $settings->announcement_text_color }}; border-color: #0f172a;"
                 class="border-b-4 text-xs md:text-sm py-3 px-4 relative flex items-center justify-between transition-all duration-200">
                <div class="flex items-center gap-2 mx-auto pr-6 prose prose-sm max-w-none" style="--tw-prose-body: {{ $settings->announcement_text_color }}; --tw-prose-bold: {{ $settings->announcement_text_color }}; --tw-prose-headings: {{ $settings->announcement_text_color }}; color: {{ $settings->announcement_text_color }};">
                    {!! $settings->announcement_text !!}
                </div>
                <button @click="showAnnounce = false" 
                        style="background-color: #0f172a; border-color: #0f172a; color: #ffffff;"
                        class="hover:opacity-90 transition-opacity p-1 border-2 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] rounded-none absolute right-3 flex items-center justify-center cursor-pointer">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
        @endif

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
