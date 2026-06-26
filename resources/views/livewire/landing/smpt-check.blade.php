<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Header Banner -->
        <div class="bg-slate-900 border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] text-white text-center">
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight font-pixel uppercase">
                <i class="fa-solid fa-compass-drafting mr-2 text-secondary"></i> Cek Status Kelulusan SMPT
            </h1>
            <p class="text-xxs sm:text-xs text-slate-400 mt-1">
                Universitas Negeri Mojang (UNEMO)
            </p>
        </div>

        @if(session()->has('success_registration'))
            <div class="bg-emerald-100 border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] space-y-2">
                <div class="flex items-center gap-2 text-emerald-800 font-pixel font-bold text-lg">
                    <i class="fa-solid fa-circle-check text-xl text-emerald-600"></i>
                    <span>Pendaftaran Berhasil!</span>
                </div>
                <p class="text-xs text-slate-700 leading-relaxed">
                    Terima kasih telah mendaftar di Universitas Negeri Mojang. Simpan kode pendaftaran berikut untuk memantau status kelulusan Anda:
                </p>
                <div class="p-3 bg-white border-2 border-slate-900 font-mono font-bold text-center text-xl tracking-widest text-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] uppercase">
                    {{ session('success_registration') }}
                </div>
            </div>
        @endif

        @if(!$searched)
            <!-- Search Form Screen -->
            <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 space-y-6">
                <div class="space-y-2 text-center">
                    <h3 class="font-bold text-slate-800 text-lg uppercase font-pixel">Masukkan Nomor Pendaftaran</h3>
                    <p class="text-xs text-slate-500">Nomor pendaftaran yang Anda dapatkan saat mengirimkan formulir SMPT (e.g., REG-2026-XXXX).</p>
                </div>

                <form wire:submit.prevent="checkStatus" class="space-y-4">
                    <div class="space-y-1.5">
                        <input type="text" wire:model="registration_number" class="w-full px-4 py-3 rounded-none border-2 border-slate-900 text-sm focus:border-primary outline-none font-mono text-center text-lg tracking-widest uppercase" placeholder="REG-2026-XXXX">
                        @error('registration_number') <span class="text-xs text-rose-600 font-semibold block text-center mt-1">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="w-full inline-flex items-center justify-center px-6 py-3 border-4 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-base shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                        Cek Hasil Seleksi <i class="fa-solid fa-magnifying-glass ml-1.5"></i>
                    </button>
                </form>
            </div>
        @else
            <!-- Result Screen -->
            @if($admission)
                
                @if($admission->status === 'pending')
                    <!-- PENDING STATE: Closed Chest / Hourglass -->
                    <div class="bg-slate-100 border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 text-center space-y-6 relative overflow-hidden">
                        <div class="text-6xl text-slate-600 animate-pulse"><i class="fa-solid fa-lock"></i></div>
                        
                        <div class="space-y-2">
                            <span class="inline-flex items-center px-3 py-1 bg-slate-200 text-slate-700 border-2 border-slate-900 text-xs font-bold uppercase tracking-wider font-pixel">
                                ⏳ PENDING - Sedang Ditinjau
                            </span>
                            <h2 class="text-2xl font-bold text-slate-800 font-pixel uppercase tracking-wide">
                                Berkas Sedang Diverifikasi
                            </h2>
                            <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
                                Halo <strong>{{ $admission->name }}</strong>, berkas pendaftaran Anda untuk program studi <strong>{{ $admission->department->name }}</strong> sedang diperiksa secara ketat oleh Rektor Steve. Siapkan armor besi Anda dan waspada terhadap mob malam hari!
                            </p>
                        </div>

                        @if($admission->test_score !== null)
                            <div class="p-3 bg-white border border-slate-200 inline-block font-mono text-xs text-slate-600">
                                Nilai Ujian Trivia: <strong>{{ $admission->test_score }} / 100</strong>
                            </div>
                        @endif

                        <div class="pt-4 border-t border-slate-200 flex justify-center">
                            <button wire:click="resetSearch" class="px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 font-bold text-xs uppercase tracking-wider text-slate-700 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                            </button>
                        </div>
                    </div>

                @elseif($admission->status === 'accepted')
                    <!-- ACCEPTED STATE: Fireworks & Emeralds -->
                    <div class="bg-emerald-50 border-4 border-emerald-500 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 text-center space-y-6 relative overflow-hidden">
                        
                        <!-- Confetti/Emerald particle effect mockup -->
                        <div class="absolute inset-0 pointer-events-none opacity-20 flex justify-around items-center">
                            <i class="fa-solid fa-gem text-emerald-600 text-4xl animate-bounce"></i>
                            <i class="fa-solid fa-star text-yellow-500 text-3xl animate-pulse"></i>
                            <i class="fa-solid fa-gem text-emerald-500 text-4xl animate-bounce duration-1000"></i>
                        </div>

                        <div class="text-7xl text-emerald-600 animate-bounce"><i class="fa-solid fa-gem text-emerald-500 drop-shadow-[0_4px_6px_rgba(16,185,129,0.3)]"></i></div>
                        
                        <div class="space-y-3 relative z-10">
                            <span class="inline-flex items-center px-3 py-1 bg-emerald-500 text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider font-pixel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                🎉 LULUS - DITERIMA
                            </span>
                            <h2 class="text-3xl font-extrabold text-slate-900 font-pixel uppercase tracking-wide leading-none">
                                Selamat! Anda Diterima
                            </h2>
                            <p class="text-xs text-slate-700 max-w-lg mx-auto leading-relaxed">
                                Selamat bergabung <strong>{{ $admission->name }}</strong>! Anda resmi diterima sebagai mahasiswa di program studi <strong>{{ $admission->department->name }}</strong>, Universitas Negeri Mojang.
                            </p>
                        </div>

                        <!-- Card detailing status and score -->
                        <div class="bg-white border-2 border-slate-900 p-4 max-w-md mx-auto text-left space-y-3 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] font-sans">
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <span class="text-slate-400 font-bold uppercase">No. Pendaftaran:</span>
                                <span class="text-slate-800 font-mono font-bold">{{ $admission->registration_number }}</span>
                                
                                <span class="text-slate-400 font-bold uppercase">Jalur Seleksi:</span>
                                <span class="text-slate-800 font-bold uppercase">{{ $admission->path }}</span>
                                
                                @if($admission->test_score !== null)
                                    <span class="text-slate-400 font-bold uppercase">Skor Ujian Trivia:</span>
                                    <span class="text-emerald-600 font-mono font-bold">{{ $admission->test_score }} / 100</span>
                                @endif
                            </div>
                            
                            @if($admission->status_notes)
                                <div class="pt-2.5 border-t border-slate-100">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Catatan Panitia:</span>
                                    <p class="text-xs text-slate-600 italic bg-slate-50 p-2 border-l-4 border-emerald-500 font-medium">
                                        "{{ $admission->status_notes }}"
                                    </p>
                                </div>
                            @endif
                        </div>

                        <p class="text-[10px] text-emerald-800 font-bold animate-pulse">
                            📢 Silakan siapkan Diamond/Emerald untuk biaya daftar ulang, dan bawa perlengkapan survival Anda untuk OSPEK Nether!
                        </p>

                        <div class="pt-2 flex justify-center gap-4">
                            <button wire:click="resetSearch" class="px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 font-bold text-xs uppercase tracking-wider text-slate-700 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                            </button>
                        </div>
                    </div>

                @elseif($admission->status === 'rejected')
                    <!-- REJECTED STATE: Creeper / TNT Exploding -->
                    <div class="bg-rose-50 border-4 border-rose-500 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 text-center space-y-6 relative overflow-hidden animate-shake">
                        
                        <div class="text-7xl text-rose-600"><i class="fa-solid fa-bomb text-rose-500"></i></div>
                        
                        <div class="space-y-2">
                            <span class="inline-flex items-center px-3 py-1 bg-rose-600 text-white border-2 border-slate-900 text-xs font-bold uppercase tracking-wider font-pixel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                💥 GAGAL - DITOLAK
                            </span>
                            <h2 class="text-2xl font-bold text-slate-900 font-pixel uppercase tracking-wide">
                                BOOM! Pendaftaran Meledak
                            </h2>
                            <p class="text-xs text-slate-600 max-w-md mx-auto leading-relaxed">
                                Mohon maaf <strong>{{ $admission->name }}</strong>, berkas pendaftaran Anda untuk prodi <strong>{{ $admission->department->name }}</strong> dinyatakan ditolak oleh Panitia Seleksi UNEMO.
                            </p>
                        </div>

                        @if($admission->status_notes)
                            <div class="bg-white border-2 border-slate-950 p-4 max-w-md mx-auto text-left shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                                <span class="text-[10px] text-slate-400 font-bold uppercase block mb-1">Alasan Penolakan:</span>
                                <p class="text-xs text-rose-700 italic font-medium">
                                    "{{ $admission->status_notes }}"
                                </p>
                            </div>
                        @endif

                        <p class="text-[10px] text-rose-600 font-semibold leading-relaxed">
                            Jangan patah arang! Silakan kumpulkan lebih banyak resource, upgrade armor Anda, kalahkan lebih banyak mob, dan coba mendaftar lagi di season berikutnya!
                        </p>

                        <div class="pt-2 flex justify-center">
                            <button wire:click="resetSearch" class="px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 font-bold text-xs uppercase tracking-wider text-slate-700 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                            </button>
                        </div>
                    </div>
                @endif

            @else
                <!-- Admission Not Found State -->
                <div class="bg-white border-4 border-slate-900 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] p-8 text-center space-y-6">
                    <div class="text-6xl text-amber-500"><i class="fa-solid fa-triangle-exclamation"></i></div>
                    <div class="space-y-2">
                        <h2 class="text-xl font-bold text-slate-800 font-pixel uppercase">Nomor Pendaftaran Salah</h2>
                        <p class="text-xs text-slate-500 max-w-md mx-auto leading-relaxed">
                            Nomor pendaftaran yang Anda masukkan tidak terdaftar di server database UNEMO. Silakan periksa kembali kode Anda.
                        </p>
                    </div>
                    <div class="pt-2 flex justify-center">
                        <button wire:click="resetSearch" class="px-4 py-2 border-2 border-slate-900 bg-white hover:bg-slate-50 font-bold text-xs uppercase tracking-wider text-slate-700 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Coba Lagi
                        </button>
                    </div>
                </div>
            @endif
        @endif

    </div>

    <!-- Style for shake and wobble animation effects -->
    <style>
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-4px); }
            20%, 40%, 60%, 80% { transform: translateX(4px); }
        }
        .animate-shake {
            animation: shake 0.6s cubic-bezier(.36,.07,.19,.97) both;
        }
    </style>
</div>
