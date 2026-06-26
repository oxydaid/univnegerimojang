<div class="relative bg-brutal-bg min-h-screen">
    <!-- Hero Section -->
    <div class="relative pt-12 pb-16 px-4 sm:px-6 lg:pt-16 lg:pb-20 lg:px-8 bg-brutal-bg">
        <div class="relative max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Text Column -->
                <div class="lg:col-span-7 space-y-5">
                    <span class="inline-flex items-center px-3 py-1 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/10 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                        PMB 2026/2027
                    </span>
                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-none font-pixel uppercase">
                        Membangun Peradaban Overworld Dengan <br>
                        <span class="text-primary font-pixel text-4xl sm:text-6xl lg:text-7xl">
                            Redstone & Crafting
                        </span>
                    </h1>
                    <p class="text-sm sm:text-base text-slate-600 leading-relaxed max-w-xl">
                        Selamat datang di UNEMO, pusat pendidikan voxel terbaik di dunia. Cetak keahlian otomatisasi piston, rekayasa pertambangan Netherite, dan rancang bangun megastruktur.
                    </p>
                    <div class="flex flex-row gap-3 pt-2">
                        <a href="{{ route('faculty') }}" wire:navigate class="flex-1 sm:flex-initial inline-flex items-center justify-center px-4 sm:px-6 py-3 border-4 border-slate-900 text-xs sm:text-sm font-extrabold uppercase font-pixel tracking-wider text-white bg-primary hover:bg-primary/95 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all cursor-pointer text-center">
                            Lihat Fakultas
                        </a>
                        <a href="{{ route('about') }}" wire:navigate class="flex-1 sm:flex-initial inline-flex items-center justify-center px-4 sm:px-6 py-3 border-4 border-slate-900 text-xs sm:text-sm font-extrabold uppercase font-pixel tracking-wider text-slate-700 bg-white hover:bg-slate-50 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all cursor-pointer text-center">
                            Tentang UNEMO
                        </a>
                    </div>
                </div>

                <!-- Right Graphic Column -->
                <div class="lg:col-span-5 relative">
                    <div class="relative flex flex-col gap-6">
                        <!-- Main Hero Image Container -->
                        <div class="relative rounded-none overflow-hidden border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] aspect-[4/3] group">
                            <img src="{{ asset('images/unemo_campus.png') }}" 
                                 alt="UNEMO Campus" 
                                 width="800"
                                 height="600"
                                 loading="lazy"
                                 class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>

                            <!-- Floating Badge 1: Akreditasi -->
                            <div class="absolute top-4 left-4 bg-white px-3.5 py-2 border-2 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] flex items-center gap-2">
                                <span class="flex h-2.5 w-2.5 relative">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                                <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wide">Mojang Studios (A+)</span>
                            </div>

                            <!-- Floating Badge 2: Beasiswa -->
                            <div class="absolute bottom-4 right-4 bg-primary px-4 py-2 border-2 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] text-white flex items-center gap-2">
                                <i class="fa-solid fa-graduation-cap text-yellow-400"></i>
                                <span class="text-xs font-bold font-pixel tracking-wider">Beasiswa 100% Emerald</span>
                            </div>
                        </div>

                        <!-- Mini Agenda Widget -->
                        <div class="bg-white p-6 border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] space-y-4">
                            <div class="flex items-center justify-between border-b-2 border-slate-900 pb-3">
                                <div class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 bg-primary border border-slate-900"></span>
                                    <h3 class="font-extrabold text-slate-900 text-xs uppercase tracking-wide">Kalender Akademik Terdekat</h3>
                                </div>
                                <span class="text-[10px] text-primary font-extrabold tracking-wide uppercase hover:underline cursor-pointer">Lihat Semua</span>
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="bg-primary/15 text-primary border-2 border-slate-900 p-1.5 flex flex-col items-center justify-center h-10 w-10 flex-shrink-0 font-bold text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="leading-none text-sm font-pixel font-bold">28</span>
                                        <span class="text-[8px] uppercase tracking-wider">Jun</span>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-slate-800 text-xs hover:text-primary cursor-pointer transition-colors duration-150 uppercase">Praktikum Mengalahkan Ender Dragon</h4>
                                        <p class="text-[10px] text-slate-500">09:00 WIB di Dimensi The End (Lab Multidimensi)</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="bg-secondary/15 text-secondary border-2 border-slate-900 p-1.5 flex flex-col items-center justify-center h-10 w-10 flex-shrink-0 font-bold text-xs shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="leading-none text-sm font-pixel font-bold">05</span>
                                        <span class="text-[8px] uppercase tracking-wider">Jul</span>
                                    </div>
                                    <div>
                                        <h4 class="font-extrabold text-slate-800 text-xs hover:text-primary cursor-pointer transition-colors duration-150 uppercase">Kuliah Umum: Optimalisasi Redstone Clocks</h4>
                                        <p class="text-[10px] text-slate-500">Gedung Lab Redstone Mumbo Lt. 1</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Campus Statistics Section -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 z-10">
        <div class="bg-white border-4 border-slate-900 p-6 md:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x-2 divide-slate-900">
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl md:text-4xl font-extrabold text-primary font-pixel">{{ number_format($studentCount) }}</span>
                    <span class="block text-xs text-slate-500 font-extrabold uppercase mt-1">Mahasiswa Terdaftar</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl md:text-4xl font-extrabold text-primary font-pixel">{{ $facultyCount }}</span>
                    <span class="block text-xs text-slate-500 font-extrabold uppercase mt-1">Fakultas Multidimensi</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl md:text-4xl font-extrabold text-primary font-pixel">{{ $departmentCount }}</span>
                    <span class="block text-xs text-slate-500 font-extrabold uppercase mt-1">Program Studi Voxel</span>
                </div>
                <div class="pt-4 md:pt-0">
                    <span class="block text-3xl md:text-4xl font-extrabold text-primary font-pixel">{{ $lecturerCount }}</span>
                    <span class="block text-xs text-slate-500 font-extrabold uppercase mt-1">Dosen & Mob</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl font-pixel uppercase">
                Mengapa Harus Kuliah di <span class="text-primary font-pixel text-4xl block sm:inline">{{ $settings->app_name }}</span>?
            </h2>
            <p class="text-sm sm:text-base text-slate-600">
                Kami berkomitmen menyediakan lingkungan pembelajaran voxel berkualitas tinggi dengan fasilitas mutakhir untuk menunjang kreativitas tanpa batas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-primary-pastel p-8 border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 transition-all duration-200 group">
                <div class="h-12 w-12 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] bg-primary text-white flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-bolt text-lg"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-2 uppercase font-pixel tracking-wide">Kurikulum Redstone & Crafting</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Materi ajar yang dinamis, mulai dari dasar-dasar sirkuit piston hingga pembuatan gerbang logika komputasi kompleks berbahan Redstone Dust.
                </p>
            </div>

            <div class="bg-secondary-pastel p-8 border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 transition-all duration-200 group">
                <div class="h-12 w-12 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] bg-secondary text-white flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-trowel-bricks text-lg"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-2 uppercase font-pixel tracking-wide">Fasilitas Lab Lengkap & Aman</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Dilengkapi tungku peleburan otomatis (blast furnace), ruang penyimpanan obsidian anti-ledakan creeper, laboratorium redstone murni, dan perpustakaan Stronghold.
                </p>
            </div>

            <div class="bg-white p-8 border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 transition-all duration-200 group">
                <div class="h-12 w-12 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] bg-primary/10 text-primary flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-globe text-lg"></i>
                </div>
                <h3 class="font-extrabold text-slate-900 text-lg mb-2 uppercase font-pixel tracking-wide">Kerjasama Lintas Dimensi</h3>
                <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                    Program pertukaran mahasiswa ke dimensi Nether (Bastion Campus) dan The End (City Observatory) untuk riset ekologi dan eksplorasi Netherite.
                </p>
            </div>
        </div>
    </div>

    <!-- New Student Admission (PMB) Promotion Section -->
    <div class="py-16 bg-brutal-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto space-y-4 mb-12">
                <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-secondary/15 text-secondary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    Jalur Pendaftaran
                </span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight sm:text-4xl font-pixel uppercase">
                    Pilih Jalur Masuk Survival-mu
                </h2>
                <p class="text-xs sm:text-sm text-slate-600">
                    Bergabunglah dengan generasi inovator berikutnya di {{ $settings->app_name }}. Pilih jalur masuk yang paling sesuai dengan keahlian survival-mu.
                </p>
            </div>

            <!-- Admission Pathways -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <!-- Path 1 -->
                <div class="bg-primary-pastel border-4 border-slate-900 p-8 flex flex-col justify-between hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 group shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="space-y-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold text-sm font-pixel text-lg">
                            01
                        </div>
                        <h3 class="text-base font-bold text-slate-900 uppercase font-pixel tracking-wide min-h-[3rem] flex items-center">Jalur Nilai Rapot (SS Statistik Minecraft)</h3>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Seleksi masuk berdasarkan nilai rapot sekolah menengah serta lampiran screenshot statistik pencapaian petualangan Minecraft Anda.
                        </p>
                    </div>
                    <a href="{{ route('smpt.register') }}" wire:navigate class="pt-6 border-t-2 border-slate-900 mt-6 flex justify-between items-center text-xs font-extrabold text-primary uppercase hover:underline">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Path 2 -->
                <div class="bg-white border-4 border-slate-900 p-8 flex flex-col justify-between hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 group shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="space-y-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-secondary text-white flex items-center justify-center font-bold text-sm font-pixel text-lg">
                            02
                        </div>
                        <h3 class="text-base font-bold text-slate-900 uppercase font-pixel tracking-wide min-h-[3rem] flex items-center">Jalur Prestasi (Karya / Piagam)</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Seleksi tanpa tes tertulis bagi pendaftar yang memiliki piagam kejuaraan atau portofolio karya kreatif voxel/redstone.
                        </p>
                    </div>
                    <a href="{{ route('smpt.register') }}" wire:navigate class="pt-6 border-t-2 border-slate-900 mt-6 flex justify-between items-center text-xs font-extrabold text-secondary uppercase hover:underline">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Path 3 -->
                <div class="bg-secondary-pastel border-4 border-slate-900 p-8 flex flex-col justify-between hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 group shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="space-y-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold text-sm font-pixel text-lg">
                            03
                        </div>
                        <h3 class="text-base font-bold text-slate-900 uppercase font-pixel tracking-wide min-h-[3rem] flex items-center">Jalur Ujian Online (Trivia Test)</h3>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            Seleksi melalui ujian tertulis online berupa Trivia Test interaktif mengenai pengetahuan survival dasar, rekayasa piston, dan crafting.
                        </p>
                    </div>
                    <a href="{{ route('smpt.register') }}" wire:navigate class="pt-6 border-t-2 border-slate-900 mt-6 flex justify-between items-center text-xs font-extrabold text-primary uppercase hover:underline">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>

                <!-- Path 4 -->
                <div class="bg-white border-4 border-slate-900 p-8 flex flex-col justify-between hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 group shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <div class="space-y-4">
                        <div class="h-10 w-10 border-2 border-slate-900 bg-secondary text-white flex items-center justify-center font-bold text-sm font-pixel text-lg">
                            04
                        </div>
                        <h3 class="text-base font-bold text-slate-900 uppercase font-pixel tracking-wide min-h-[3rem] flex items-center">Jalur Beasiswa Kemitraan</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Jalur pendaftaran bagi calon mahasiswa yang memiliki rekomendasi kemitraan strategis dengan institusi atau civitas akademika UNEMO.
                        </p>
                    </div>
                    <a href="{{ route('smpt.register') }}" wire:navigate class="pt-6 border-t-2 border-slate-900 mt-6 flex justify-between items-center text-xs font-extrabold text-secondary uppercase hover:underline">
                        <span>Daftar Sekarang</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Registration Flow -->
            <div class="bg-white border-4 border-slate-900 p-8 md:p-12 mb-16 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)]">
                <h3 class="text-xl font-bold text-slate-900 text-center mb-10 font-pixel uppercase tracking-wide text-2xl">Alur Pendaftaran Mahasiswa Baru</h3>
                <div class="grid grid-cols-1 sm:grid-cols-5 gap-6 text-center relative">
                    <!-- Flow Step 1 -->
                    <div class="space-y-3 relative z-10">
                        <div class="mx-auto h-12 w-12 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-pixel text-lg rounded-none">
                            1
                        </div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase">Registrasi Formulir</h4>
                        <p class="text-[10px] text-slate-500">Kirim data diri melalui portal resmi pendaftaran UNEMO.</p>
                    </div>

                    <!-- Flow Step 2 -->
                    <div class="space-y-3 relative z-10">
                        <div class="mx-auto h-12 w-12 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-pixel text-lg rounded-none">
                            2
                        </div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase">Unggah Dokumen Wajib</h4>
                        <p class="text-[10px] text-slate-500">Unggah berkas ijazah Mojang, skin petualang, dan screenshot statistik.</p>
                    </div>

                    <!-- Flow Step 3 -->
                    <div class="space-y-3 relative z-10">
                        <div class="mx-auto h-12 w-12 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-pixel text-lg rounded-none">
                            3
                        </div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase">Trivia Test Online</h4>
                        <p class="text-[10px] text-slate-500">Ikuti ujian tertulis interaktif mengenai survival dan redstone.</p>
                    </div>

                    <!-- Flow Step 4 -->
                    <div class="space-y-3 relative z-10">
                        <div class="mx-auto h-12 w-12 border-2 border-slate-900 bg-primary text-white flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-pixel text-lg rounded-none">
                            4
                        </div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase">Verifikasi Berkas</h4>
                        <p class="text-[10px] text-slate-500">Proses pencocokan kebenaran dokumen oleh pihak panitia Rektorat Steve.</p>
                    </div>

                    <!-- Flow Step 5 -->
                    <div class="space-y-3 relative z-10">
                        <div class="mx-auto h-12 w-12 border-2 border-slate-900 bg-secondary text-white flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] font-pixel text-lg rounded-none">
                            5
                        </div>
                        <h4 class="font-extrabold text-slate-800 text-xs uppercase">Cek Status Hasil</h4>
                        <p class="text-[10px] text-slate-500">Lihat pengumuman kelulusan dan ikuti orientasi Nether OSPEK.</p>
                    </div>
                </div>
            </div>

            <!-- Call to Actions -->
            <div class="bg-primary-pastel border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-slate-900 p-8 md:p-12 text-center space-y-6 relative overflow-hidden">
                <div class="relative z-10 max-w-2xl mx-auto space-y-4">
                    <h3 class="text-2xl md:text-3xl font-extrabold font-pixel text-primary uppercase">Siap Bergabung dengan Universitas Negeri Mojang?</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-xl mx-auto">
                        Unduh brosur pendaftaran lengkap untuk mempelajari informasi syarat pendaftaran, rincian biaya pendaftaran (dalam Emerald), program beasiswa, dan kurikulum jurusan.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 pt-4">
                        <a href="{{ route('smpt.register') }}" wire:navigate class="px-6 py-3 bg-primary text-white font-extrabold border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150 rounded-none uppercase font-pixel text-sm cursor-pointer">
                            Daftar Online (SMPT)
                        </a>
                        <a href="{{ asset('images/unemo_poster_nano_banana.png') }}" download="Poster_PMB_UNEMO_Nano_Banana.png" class="px-6 py-3 bg-white text-slate-800 border-2 border-slate-900 hover:bg-slate-50 font-extrabold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all duration-150 rounded-none uppercase font-pixel text-sm cursor-pointer inline-flex items-center justify-center">
                            Unduh Brosur Poster
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
