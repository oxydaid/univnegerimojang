<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-gradient-to-r from-primary to-secondary text-white p-8 rounded-none border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] relative overflow-hidden">
            <div class="absolute right-4 -bottom-10 opacity-10 font-pixel text-[120px] pointer-events-none select-none">SMPT</div>
            <div class="relative z-10 space-y-3">
                <span class="inline-flex items-center px-3 py-1 bg-white/20 text-white border border-white/30 text-xs font-bold uppercase tracking-wider">
                    Portal Seleksi Masuk (SMPT)
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight font-pixel uppercase">
                    Pendaftaran Mahasiswa Baru UNEMO 2026/2027
                </h1>
                <p class="text-xs sm:text-sm text-slate-100 max-w-xl leading-relaxed">
                    Daftarkan akun petualang akademikmu sekarang. Unggah skin terbaikmu, screenshot rapot statistik survival, dan ijazah sekolah menengah Mojang untuk bergabung!
                </p>
            </div>
        </div>

        <!-- Main Form -->
        <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8">
            @if(session()->has('error'))
                <div class="bg-rose-50 border-4 border-slate-900 p-4 mb-6 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                    <span class="text-rose-600 font-bold font-pixel uppercase flex items-center gap-2">
                        <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                        {{ session('error') }}
                    </span>
                </div>
            @endif

            @if($settings && !$settings->spmb_open)
                <div class="text-center py-12 space-y-6">
                    <div class="text-8xl text-rose-600 animate-pulse"><i class="fa-solid fa-ban"></i></div>
                    <div class="space-y-2">
                        <h2 class="text-3xl font-extrabold text-slate-900 font-pixel uppercase">Pendaftaran SPMB Ditutup</h2>
                        <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                            Mohon maaf, pendaftaran mahasiswa baru (SPMB) Universitas Negeri Mojang untuk periode ini saat ini sedang ditutup. Pantau terus halaman web ini untuk informasi pembukaan gelombang pendaftaran selanjutnya!
                        </p>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="submit" class="space-y-6">
                    
                    <!-- Section 1: Data Diri -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-slate-900 font-pixel uppercase border-b-2 border-slate-100 pb-2">
                            <i class="fa-solid fa-user-astronaut mr-2 text-primary"></i> Identitas Petualang (Calon Mahasiswa)
                        </h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div class="space-y-1.5">
                                <label for="name" class="block text-sm font-bold text-slate-700">Nama Lengkap</label>
                                <input type="text" id="name" wire:model="name" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="e.g., Steve Creeperson">
                                @error('name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Email -->
                            <div class="space-y-1.5">
                                <label for="email" class="block text-sm font-bold text-slate-700">Alamat E-mail</label>
                                <input type="email" id="email" wire:model="email" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="e.g., steve@email.com">
                                @error('email') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Phone -->
                            <div class="space-y-1.5">
                                <label for="phone" class="block text-sm font-bold text-slate-700">Nomor Telepon</label>
                                <input type="text" id="phone" wire:model="phone" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="e.g., 08123456789">
                                @error('phone') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>

                            <!-- High School -->
                            <div class="space-y-1.5">
                                <label for="high_school" class="block text-sm font-bold text-slate-700">Sekolah Asal (SMA/SMK/MAN Negeri Mojang)</label>
                                <input type="text" id="high_school" wire:model="high_school" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none" placeholder="e.g., SMAN 1 Mojang">
                                @error('high_school') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Pilihan Jurusan & Jalur -->
                    <div class="space-y-4 pt-4">
                        <h3 class="text-lg font-bold text-slate-900 font-pixel uppercase border-b-2 border-slate-100 pb-2">
                            <i class="fa-solid fa-graduation-cap mr-2 text-primary"></i> Pilihan Program Studi & Jalur Masuk
                        </h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <!-- Department -->
                            <div class="space-y-1.5">
                                <label for="department_id" class="block text-sm font-bold text-slate-700">Program Studi Tujuan</label>
                                <select id="department_id" wire:model="department_id" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none bg-white">
                                    <option value="">-- Pilih Program Studi --</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }} ({{ $dept->code }})</option>
                                    @endforeach
                                </select>
                                @error('department_id') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>

                            <!-- Path -->
                            <div class="space-y-1.5">
                                <label for="path" class="block text-sm font-bold text-slate-700">Jalur Seleksi</label>
                                <select id="path" wire:model.live="path" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none bg-white">
                                    <option value="nilai">Jalur Nilai Rapot (SS Statistik Minecraft)</option>
                                    <option value="prestasi">Jalur Prestasi (Karya / Piagam)</option>
                                    <option value="test">Jalur Ujian Online (Trivia Test)</option>
                                    <option value="beasiswa">Jalur Beasiswa Kemitraan</option>
                                </select>
                                @error('path') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Beasiswa Kemitraan Code Input -->
                        @if($path === 'beasiswa')
                            <div class="p-4 bg-amber-50 border-2 border-amber-300 space-y-3">
                                <div class="flex gap-2 text-amber-800 font-bold text-sm font-pixel">
                                    <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                                    <span>Perhatian: Anda memilih Jalur Beasiswa Kemitraan</span>
                                </div>
                                <p class="text-xs text-amber-700 font-medium">
                                    Masukkan nama civitas akademika pemberi rekomendasi atau kode akses kemitraan khusus untuk verifikasi.
                                </p>
                                <div class="space-y-1.5 max-w-md">
                                    <label for="ordal_code" class="block text-xs font-bold text-slate-700">Kode Rekomendasi / Nama Pejabat Kemitraan</label>
                                    <input type="text" id="ordal_code" wire:model="ordal_code" class="w-full px-3 py-2 rounded-none border-2 border-slate-900 text-xs focus:border-primary outline-none bg-white" placeholder="e.g., REKTOR-STEVE / MITRA-EMERALD">
                                    @error('ordal_code') <span class="text-xs text-rose-600 font-semibold block mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Section 3: Berkas Dokumen Wajib -->
                    <div class="space-y-4 pt-4" x-data="{ openExamples: false }">
                        <div class="flex justify-between items-center border-b-2 border-slate-100 pb-2">
                            <h3 class="text-lg font-bold text-slate-900 font-pixel uppercase">
                                <i class="fa-solid fa-file-arrow-up mr-2 text-primary"></i> Unggah Dokumen Persyaratan
                            </h3>
                            <!-- Example statistics trigger -->
                            <button type="button" @click="openExamples = !openExamples" class="text-xs font-bold text-primary hover:underline flex items-center gap-1">
                                <i class="fa-solid fa-images"></i> Lihat Contoh Rapot Statistik
                            </button>
                        </div>

                        <!-- Collapsible Container for Rapot Examples -->
                        <div x-show="openExamples" x-collapse x-cloak class="p-4 bg-slate-100 border-2 border-slate-300 space-y-3 transition-all duration-300">
                            <h4 class="text-xs font-bold text-slate-800">Contoh Screenshot Statistik Minecraft yang Sah (sebagai Rapot):</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-white p-2 border border-slate-200">
                                    <img src="{{ asset('images/documents/dokumen1.jpg') }}" alt="Contoh Statistik 1" class="w-full h-40 object-cover border border-slate-200">
                                    <span class="text-xxs text-slate-500 text-center block mt-1">Halaman Utama Statistik Game</span>
                                </div>
                                <div class="bg-white p-2 border border-slate-200">
                                    <img src="{{ asset('images/documents/dokumen2.jpg') }}" alt="Contoh Statistik 2" class="w-full h-40 object-cover border border-slate-200">
                                    <span class="text-xxs text-slate-500 text-center block mt-1">Detail Blok / Item Crafted</span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <!-- Skin Minecraft -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-800">
                                    <i class="fa-solid fa-shirt mr-1.5 text-primary"></i> Skin (.png, min 800KB)
                                </label>
                                <label class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-900 bg-slate-50 hover:bg-slate-100 hover:border-primary transition-all cursor-pointer text-center min-h-[160px]">
                                    <input type="file" wire:model="skin" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                    <div class="space-y-2">
                                        <div class="text-3xl text-slate-400 group-hover:text-primary transition-colors"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="text-xs font-bold text-slate-800">Pilih Berkas Skin</div>
                                        <div class="text-[10px] text-slate-500 font-mono">Min 800KB, Max 2MB</div>
                                    </div>
                                    <div wire:loading wire:target="skin" class="absolute inset-0 bg-white/90 z-20 flex flex-col items-center justify-center p-4">
                                        <i class="fa-solid fa-spinner animate-spin text-primary text-2xl"></i>
                                        <span class="text-xxs font-bold text-primary mt-1">Mengunggah...</span>
                                    </div>
                                    @if ($skin)
                                        <div class="absolute inset-0 bg-emerald-50 border border-emerald-500 z-30 flex flex-col items-center justify-center p-4">
                                            <div class="text-2xl text-emerald-500 mb-1"><i class="fa-solid fa-circle-check"></i></div>
                                            <div class="text-[10px] font-bold text-emerald-800 leading-tight">Skin Terunggah!</div>
                                            <div class="text-[9px] text-emerald-600 truncate max-w-full font-mono mt-0.5">{{ $skin->getClientOriginalName() }}</div>
                                        </div>
                                    @endif
                                </label>
                                @error('skin') <span class="text-xs text-rose-600 font-semibold block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Rapot (Minecraft Stats) -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-800">
                                    <i class="fa-solid fa-chart-simple mr-1.5 text-primary"></i> SS Statistik (min 800KB)
                                </label>
                                <label class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-900 bg-slate-50 hover:bg-slate-100 hover:border-primary transition-all cursor-pointer text-center min-h-[160px]">
                                    <input type="file" wire:model="minecraft_stats" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                    <div class="space-y-2">
                                        <div class="text-3xl text-slate-400 group-hover:text-primary transition-colors"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="text-xs font-bold text-slate-800">Pilih SS Statistik</div>
                                        <div class="text-[10px] text-slate-500 font-mono">Min 800KB, Max 2MB</div>
                                    </div>
                                    <div wire:loading wire:target="minecraft_stats" class="absolute inset-0 bg-white/90 z-20 flex flex-col items-center justify-center p-4">
                                        <i class="fa-solid fa-spinner animate-spin text-primary text-2xl"></i>
                                        <span class="text-xxs font-bold text-primary mt-1">Mengunggah...</span>
                                    </div>
                                    @if ($minecraft_stats)
                                        <div class="absolute inset-0 bg-emerald-50 border border-emerald-500 z-30 flex flex-col items-center justify-center p-4">
                                            <div class="text-2xl text-emerald-500 mb-1"><i class="fa-solid fa-circle-check"></i></div>
                                            <div class="text-[10px] font-bold text-emerald-800 leading-tight">Statistik Terunggah!</div>
                                            <div class="text-[9px] text-emerald-600 truncate max-w-full font-mono mt-0.5">{{ $minecraft_stats->getClientOriginalName() }}</div>
                                        </div>
                                    @endif
                                </label>
                                @error('minecraft_stats') <span class="text-xs text-rose-600 font-semibold block mt-1">{{ $message }}</span> @enderror
                            </div>

                            <!-- Ijazah -->
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-slate-800">
                                    <i class="fa-solid fa-certificate mr-1.5 text-primary"></i> Ijazah (min 800KB)
                                </label>
                                <label class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-slate-900 bg-slate-50 hover:bg-slate-100 hover:border-primary transition-all cursor-pointer text-center min-h-[160px]">
                                    <input type="file" wire:model="certificate" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                    <div class="space-y-2">
                                        <div class="text-3xl text-slate-400 group-hover:text-primary transition-colors"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="text-xs font-bold text-slate-800">Pilih Berkas Ijazah</div>
                                        <div class="text-[10px] text-slate-500 font-mono">Min 800KB, Max 2MB</div>
                                    </div>
                                    <div wire:loading wire:target="certificate" class="absolute inset-0 bg-white/90 z-20 flex flex-col items-center justify-center p-4">
                                        <i class="fa-solid fa-spinner animate-spin text-primary text-2xl"></i>
                                        <span class="text-xxs font-bold text-primary mt-1">Mengunggah...</span>
                                    </div>
                                    @if ($certificate)
                                        <div class="absolute inset-0 bg-emerald-50 border border-emerald-500 z-30 flex flex-col items-center justify-center p-4">
                                            <div class="text-2xl text-emerald-500 mb-1"><i class="fa-solid fa-circle-check"></i></div>
                                            <div class="text-[10px] font-bold text-emerald-800 leading-tight">Ijazah Terunggah!</div>
                                            <div class="text-[9px] text-emerald-600 truncate max-w-full font-mono mt-0.5">{{ $certificate->getClientOriginalName() }}</div>
                                        </div>
                                    @endif
                                </label>
                                @error('certificate') <span class="text-xs text-rose-600 font-semibold block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Conditional Prestasi Proof Input -->
                        @if($path === 'prestasi')
                            <div class="space-y-2">
                                <label class="block text-sm font-bold text-emerald-950">
                                    <i class="fa-solid fa-trophy mr-1.5 text-amber-500"></i> Bukti Prestasi Tambahan (min 800KB)
                                </label>
                                <label class="group relative flex flex-col items-center justify-center p-6 border-2 border-dashed border-primary bg-emerald-50/10 hover:bg-emerald-50/30 transition-all cursor-pointer text-center min-h-[140px]">
                                    <input type="file" wire:model="achievement_proof" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                                    <div class="space-y-2">
                                        <div class="text-3xl text-amber-400 group-hover:text-primary transition-colors"><i class="fa-solid fa-cloud-arrow-up"></i></div>
                                        <div class="text-xs font-bold text-slate-800">Pilih Bukti Prestasi</div>
                                        <div class="text-[10px] text-slate-500 font-mono">Min 800KB, Max 2MB</div>
                                    </div>
                                    <div wire:loading wire:target="achievement_proof" class="absolute inset-0 bg-white/90 z-20 flex flex-col items-center justify-center p-4">
                                        <i class="fa-solid fa-spinner animate-spin text-primary text-2xl"></i>
                                        <span class="text-xxs font-bold text-primary mt-1">Mengunggah...</span>
                                    </div>
                                    @if ($achievement_proof)
                                        <div class="absolute inset-0 bg-emerald-50 border border-emerald-500 z-30 flex flex-col items-center justify-center p-4">
                                            <div class="text-2xl text-emerald-500 mb-1"><i class="fa-solid fa-circle-check"></i></div>
                                            <div class="text-[10px] font-bold text-emerald-800 leading-tight">Bukti Terunggah!</div>
                                            <div class="text-[9px] text-emerald-600 truncate max-w-full font-mono mt-0.5">{{ $achievement_proof->getClientOriginalName() }}</div>
                                        </div>
                                    @endif
                                </label>
                                @error('achievement_proof') <span class="text-xs text-rose-600 font-semibold block mt-1">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button type="submit" wire:loading.attr="disabled" class="w-full inline-flex items-center justify-center px-6 py-4 border-4 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-lg shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all cursor-pointer">
                            <span wire:loading class="mr-2">
                                <i class="fa-solid fa-spinner animate-spin"></i>
                            </span>
                            {{ $path === 'test' ? 'Mulai Ujian Online' : 'Kirim Berkas Pendaftaran' }}
                        </button>
                    </div>
                </form>
            @endif
        </div>
        </div>
        
        <!-- Status check promo banner -->
        <div class="bg-white border-4 border-slate-900 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-5 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-compass text-secondary text-2xl"></i>
                <div>
                    <h4 class="font-bold text-slate-800 text-sm">Sudah mendaftar sebelumnya?</h4>
                    <p class="text-xs text-slate-500">Periksa pengumuman kelulusan berkas atau hasil ujian Anda menggunakan nomor pendaftaran.</p>
                </div>
            </div>
            <a href="{{ route('smpt.check') }}" wire:navigate class="px-4 py-2 border-2 border-slate-900 hover:bg-slate-50 font-bold text-xs uppercase tracking-wider text-slate-700 whitespace-nowrap shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Cek Kelulusan <i class="fa-solid fa-arrow-right ml-1"></i>
            </a>
        </div>

    </div>
</div>
