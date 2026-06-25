<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8" x-data="{ activeTab: 'register' }">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-primary to-secondary text-white p-8 rounded-none border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
            <div class="absolute right-4 -bottom-10 opacity-10 font-pixel text-[120px] pointer-events-none select-none">PANDUAN</div>
            <div class="relative z-10 space-y-3">
                <span class="inline-flex items-center px-3 py-1 bg-white/20 text-white border border-white/30 text-xs font-bold uppercase tracking-wider">
                    Informasi & Petunjuk
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-pixel uppercase">
                    Panduan Pendaftaran & Seleksi (SMPT)
                </h1>
                <p class="text-xs sm:text-sm text-slate-100 max-w-xl leading-relaxed">
                    Pelajari langkah-langkah bergabung dengan Universitas Negeri Mojang (UNEMO). Siapkan dokumen terbaik Anda untuk lolos seleksi!
                </p>
            </div>
        </div>

        <!-- Tab Controls (Neo-Brutalism style) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <button 
                @click="activeTab = 'register'"
                :class="activeTab === 'register' ? 'bg-primary text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'bg-white text-slate-700 hover:bg-slate-50 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'"
                class="px-4 py-3 border-4 border-slate-900 font-extrabold uppercase font-pixel tracking-wider text-sm transition-all duration-150 flex items-center justify-center gap-2 cursor-pointer"
            >
                <i class="fa-solid fa-file-signature text-xs"></i> Panduan Daftar
            </button>
            <button 
                @click="activeTab = 'test'"
                :class="activeTab === 'test' ? 'bg-primary text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'bg-white text-slate-700 hover:bg-slate-50 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'"
                class="px-4 py-3 border-4 border-slate-900 font-extrabold uppercase font-pixel tracking-wider text-sm transition-all duration-150 flex items-center justify-center gap-2 cursor-pointer"
            >
                <i class="fa-solid fa-pen-to-square text-xs"></i> Panduan Ujian
            </button>
            <button 
                @click="activeTab = 'status'"
                :class="activeTab === 'status' ? 'bg-primary text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]' : 'bg-white text-slate-700 hover:bg-slate-50 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]'"
                class="px-4 py-3 border-4 border-slate-900 font-extrabold uppercase font-pixel tracking-wider text-sm transition-all duration-150 flex items-center justify-center gap-2 cursor-pointer"
            >
                <i class="fa-solid fa-compass-drafting text-xs"></i> Cek Kelulusan
            </button>
        </div>

        <!-- Tab Contents -->
        <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 space-y-6">
            
            <!-- Register Tab -->
            <div x-show="activeTab === 'register'" class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 font-pixel uppercase border-b-2 border-slate-200 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-circle-info text-primary"></i> Langkah-Langkah Pendaftaran Online
                </h3>
                
                <div class="space-y-4">
                    <!-- Step 1 -->
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">1</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Mempersiapkan Berkas Dokumen</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Siapkan file gambar (.png/.jpg) berukuran maksimal 2MB untuk berkas wajib: **Skin Minecraft** petualang Anda, **Screenshot Statistik Survival** (sebagai Rapot), dan **Ijazah asli** dari SMA/SMK/MAN Negeri Mojang.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">2</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Memilih Program Studi & Jalur Masuk</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Kunjungi <a href="{{ route('smpt.register') }}" wire:navigate class="text-primary hover:underline font-bold">Formulir Pendaftaran</a>, tentukan program studi tujuan, lalu pilih salah satu jalur seleksi yang tersedia: **Nilai Rapot**, **Prestasi**, **Ujian Online (Test)**, atau **Beasiswa Ordal (Orang Dalam)**.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">3</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Mengisi Formulir & Mengunggah Berkas</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Isi nama lengkap, alamat email aktif, nomor telepon, dan asal sekolah. Unggah seluruh file berkas yang disyaratkan secara lengkap pada kolom input yang telah disediakan.
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">4</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Menyelesaikan Pendaftaran</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Kirim berkas pendaftaran Anda. Jika Anda memilih **Jalur Ujian Online (Test)**, sistem akan langsung mengalihkan Anda ke halaman ujian untuk menjawab kuis trivia. Untuk jalur lainnya, Anda akan langsung mendapatkan nomor pendaftaran untuk cek kelulusan.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-emerald-50 border-2 border-emerald-500 text-xs text-emerald-800 flex gap-3 font-medium">
                    <i class="fa-solid fa-circle-check text-lg text-emerald-600 flex-shrink-0"></i>
                    <div>
                        <p class="font-bold">Tips Lolos Seleksi:</p>
                        <p class="mt-0.5 leading-relaxed">Pastikan screenshot statistik Minecraft yang Anda unggah terlihat jelas dan tidak buram. Panitia akan memverifikasi pencapaian survival Anda sebelum mengeluarkan status kelulusan berkas.</p>
                    </div>
                </div>
            </div>

            <!-- Test Tab -->
            <div x-show="activeTab === 'test'" class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 font-pixel uppercase border-b-2 border-slate-200 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-primary"></i> Petunjuk Pelaksanaan Ujian Online
                </h3>

                <div class="space-y-4">
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">1</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Pengalihan Otomatis Ke Ujian</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Setelah melengkapi pendaftaran dengan **Jalur Ujian Online (Test)**, halaman Anda akan diarahkan ke `/smpt/test/{registration_number}`.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">2</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Menjawab Kuis Trivia</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Selesaikan 5 soal pilihan ganda mengenai pengetahuan umum Minecraft vanilla secara teliti. Setiap soal memiliki bobot nilai yang sama.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">3</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Pengiriman Hasil Ujian</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Tekan tombol "Kirim Hasil Ujian" di bagian bawah setelah semua soal terjawab. Nilai Anda akan dihitung secara real-time dan disimpan ke database pendaftaran.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-4 bg-amber-50 border-2 border-amber-500 text-xs text-amber-800 flex gap-3 font-medium">
                    <i class="fa-solid fa-triangle-exclamation text-lg text-amber-600 flex-shrink-0"></i>
                    <div>
                        <p class="font-bold">Peraturan Penting:</p>
                        <p class="mt-0.5 leading-relaxed">Ujian ini hanya dapat dikerjakan sebanyak satu kali untuk setiap nomor pendaftaran. Halaman ujian yang ditutup secara sepihak sebelum menekan tombol submit akan dianggap gugur.</p>
                    </div>
                </div>
            </div>

            <!-- Status Tab -->
            <div x-show="activeTab === 'status'" class="space-y-6">
                <h3 class="text-xl font-bold text-slate-900 font-pixel uppercase border-b-2 border-slate-200 pb-2 flex items-center gap-2">
                    <i class="fa-solid fa-compass-drafting text-primary"></i> Panduan Pemeriksaan Kelulusan
                </h3>

                <div class="space-y-4">
                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">1</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Menuju Portal Cek Status</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Klik tombol "Cek Kelulusan" di navbar utama atau buka tautan <a href="{{ route('smpt.check') }}" wire:navigate class="text-primary hover:underline font-bold">Cek Status Hasil Seleksi</a>.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">2</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Menginput Nomor Pendaftaran</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Masukkan nomor pendaftaran unik (e.g., `REG-2026-XXXX`) yang diberikan oleh sistem sesaat setelah Anda mengunggah formulir.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 items-start">
                        <span class="flex-shrink-0 h-8 w-8 border-2 border-slate-900 bg-secondary text-white font-pixel font-bold flex items-center justify-center text-sm shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">3</span>
                        <div class="space-y-1">
                            <h4 class="font-extrabold text-sm text-slate-800">Membaca Hasil Kelulusan</h4>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                Hasil pendaftaran akan menampilkan salah satu dari tiga status visual Minecraft:
                            </p>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-2">
                                <div class="p-3 border-2 border-slate-900 bg-slate-100 text-center">
                                    <i class="fa-solid fa-lock text-slate-600 text-lg mb-1 block"></i>
                                    <span class="font-bold text-xxs text-slate-700">PENDING</span>
                                    <span class="text-[10px] text-slate-500 block mt-0.5">Berkas dalam verifikasi</span>
                                </div>
                                <div class="p-3 border-2 border-emerald-500 bg-emerald-50 text-center">
                                    <i class="fa-solid fa-gem text-emerald-500 text-lg mb-1 block"></i>
                                    <span class="font-bold text-xxs text-emerald-700">DITERIMA (LULUS)</span>
                                    <span class="text-[10px] text-slate-500 block mt-0.5">Silakan lanjut daftar ulang</span>
                                </div>
                                <div class="p-3 border-2 border-rose-500 bg-rose-50 text-center animate-pulse">
                                    <i class="fa-solid fa-bomb text-rose-500 text-lg mb-1 block"></i>
                                    <span class="font-bold text-xxs text-rose-700">DITOLAK (GAGAL)</span>
                                    <span class="text-[10px] text-slate-500 block mt-0.5">Coba lagi di season depan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Bottom CTA -->
        <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-compass text-secondary text-2xl"></i>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm">Sudah siap mendaftar sekarang?</h4>
                    <p class="text-xs text-slate-500">Mulai petualangan akademikmu dengan mengisi formulir pendaftaran SMPT online.</p>
                </div>
            </div>
            <a href="{{ route('smpt.register') }}" wire:navigate class="px-6 py-3 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                Isi Formulir SMPT <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

    </div>
</div>
