<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Dukungan & Donasi
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Donasi <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">Untuk UNEMO</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Dukung keberlangsungan operasional server kami. Setiap donasi dari Anda sangat berarti untuk memelihara kestabilan Nether portal dan infrastruktur Redstone kami.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Side: QRIS and Instructions -->
            <div class="lg:col-span-7 space-y-6">
                <div class="bg-white border-4 border-slate-900 p-6 sm:p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] rounded-none space-y-6">
                    <h3 class="text-lg font-extrabold text-slate-900 uppercase font-pixel tracking-wide border-b-2 border-slate-100 pb-3">
                        Pindai QRIS di Bawah Ini
                    </h3>
                    
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <!-- QR Image -->
                        <div class="w-48 h-48 sm:w-56 sm:h-56 border-4 border-slate-900 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] bg-slate-50 flex items-center justify-center relative overflow-hidden flex-shrink-0">
                            @if($settings && $settings->qris_image)
                                <img src="{{ asset('storage/' . $settings->qris_image) }}" alt="QRIS QR Code" class="w-full h-full object-contain">
                            @else
                                <div class="text-center p-4">
                                    <i class="fa-solid fa-qrcode text-slate-300 text-5xl mb-2"></i>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase">QRIS Belum Tersedia</p>
                                </div>
                            @endif
                        </div>

                        <!-- Instructions -->
                        <div class="space-y-3 font-sans text-xs text-slate-600">
                            <h4 class="font-extrabold text-slate-800 uppercase text-xs">Petunjuk Pembayaran:</h4>
                            <ol class="list-decimal list-inside space-y-2 font-bold">
                                <li>Buka aplikasi e-wallet (GoPay, OVO, Dana, LinkAja) atau Mobile Banking Anda.</li>
                                <li>Pilih opsi scan QRIS.</li>
                                <li>Arahkan kamera ke kode QR di samping atau simpan gambar QR tersebut.</li>
                                <li>Masukkan jumlah nominal donasi sesuka hati Anda.</li>
                                <li>Konfirmasi nama merchant resmi **UNEMO** dan selesaikan transaksi.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- Banner / Info -->
                <div class="bg-primary/5 border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] rounded-none space-y-2">
                    <h4 class="font-extrabold text-primary uppercase text-xs font-pixel">Pemberitahuan Transparansi</h4>
                    <p class="text-[11px] font-sans font-bold text-slate-600 leading-relaxed">
                        Seluruh dana yang masuk akan dialokasikan 100% untuk membiayai sewa server host, lisensi domain, dan pengembangan fitur akademik petualangan Minecraft UNEMO.
                    </p>
                </div>
            </div>

            <!-- Right Side: Donor Wall -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-white border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] rounded-none space-y-6">
                    <h3 class="text-lg font-extrabold text-slate-900 uppercase font-pixel tracking-wide border-b-2 border-slate-100 pb-3 flex justify-between items-center">
                        <span>Daftar Donatur</span>
                        <span class="text-xs font-extrabold font-sans bg-secondary/15 text-secondary border-2 border-slate-900 px-2 py-0.5 shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)]">
                            {{ count($donors) }} TOTAL
                        </span>
                    </h3>

                    <div class="space-y-4 max-h-[450px] overflow-y-auto pr-2">
                        @if(collect($donors)->isEmpty())
                            <div class="text-center py-12 text-slate-400 font-sans">
                                <i class="fa-solid fa-heart-pulse text-4xl mb-2 text-slate-300"></i>
                                <p class="text-xs font-extrabold uppercase">Belum ada donatur</p>
                                <p class="text-[10px] text-slate-400 mt-1">Jadilah donatur pertama untuk mengukir namamu di dinding sejarah!</p>
                            </div>
                        @else
                            @foreach($donors as $donor)
                                <div class="bg-slate-50 border-2 border-slate-900 p-4 shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] space-y-2 rounded-none hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all duration-150">
                                    <div class="flex justify-between items-start gap-2">
                                        <h4 class="font-extrabold text-slate-900 text-xs uppercase leading-tight">
                                            {{ $donor->name }}
                                        </h4>
                                        <span class="text-xxs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300 px-1.5 py-0.5">
                                            Rp {{ number_format($donor->amount, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    @if($donor->message)
                                        <p class="text-[11px] text-slate-500 font-sans italic">
                                            "{{ $donor->message }}"
                                        </p>
                                    @endif
                                    <div class="text-[9px] text-slate-400 font-bold uppercase flex justify-between">
                                        <span>Dinding Kehormatan</span>
                                        <span>{{ $donor->donated_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
