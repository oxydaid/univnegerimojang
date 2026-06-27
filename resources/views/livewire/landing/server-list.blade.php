<div class="py-12 bg-brutal-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <!-- Page Header -->
        <div class="text-center max-w-3xl mx-auto space-y-4">
            <span class="inline-flex items-center px-4 py-1.5 border-2 border-slate-900 text-xs font-extrabold uppercase tracking-wide bg-primary/15 text-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                Minecraft Server
            </span>
            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight sm:text-5xl font-pixel uppercase">
                Daftar <span class="text-primary font-pixel text-4xl sm:text-5xl block sm:inline">Server UNEMO</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 font-sans">
                Koneksikan Minecraft client kamu ke alamat IP resmi di bawah ini dan mulailah berpetualang bersama ribuan mahasiswa voxel lainnya.
            </p>
        </div>

        <!-- Servers list -->
        @if(collect($servers)->isEmpty())
            <div class="bg-white border-4 border-slate-900 p-8 text-center max-w-md mx-auto shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                <i class="fa-solid fa-server text-slate-400 text-5xl mb-4"></i>
                <h3 class="font-extrabold text-slate-900 text-lg uppercase font-pixel">Tidak Ada Server Aktif</h3>
                <p class="text-xs text-slate-500 mt-2 font-sans">Saat ini seluruh server kami sedang dalam perawatan berkala.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($servers as $server)
                    @php $online = $server['status']['online']; @endphp
                    <div class="bg-white border-4 border-slate-900 p-6 sm:p-8 flex flex-col justify-between hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 transition-all duration-200 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] rounded-none group relative">
                        
                        <!-- Top status row -->
                        <div class="flex justify-between items-start gap-4">
                            <div>
                                <h3 class="font-extrabold text-slate-900 text-xl group-hover:text-primary transition-colors duration-200 uppercase font-pixel tracking-wide">
                                    {{ $server['name'] }}
                                </h3>
                                <p class="text-xs font-bold text-slate-500 uppercase tracking-wider font-sans mt-0.5">
                                    Host: {{ $server['ip'] }}
                                </p>
                            </div>
                            <div>
                                @if($online)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 border-2 border-slate-900 bg-emerald-400 text-slate-900 text-[10px] font-extrabold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        <span class="h-2 w-2 rounded-full bg-emerald-900 animate-pulse"></span>
                                        ONLINE
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 border-2 border-slate-900 bg-rose-400 text-slate-900 text-[10px] font-extrabold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                        OFFLINE
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- MOTD & details -->
                        <div class="mt-6 space-y-4 flex-grow">
                            <!-- MOTD Box -->
                            <div class="border-2 border-slate-900 bg-slate-950 p-4 font-mono text-xs rounded-none overflow-x-auto min-h-[50px] flex items-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] text-emerald-400">
                                <pre class="whitespace-pre-wrap leading-relaxed">{{ $server['status']['motd'] }}</pre>
                            </div>

                            <!-- Details list -->
                            <div class="grid grid-cols-2 gap-4 text-xs font-sans font-bold text-slate-700">
                                <div class="bg-slate-50 p-3 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] space-y-0.5">
                                    <span class="text-[10px] uppercase text-slate-400 block font-pixel">Versi Minecraft</span>
                                    <span class="text-slate-800 uppercase">{{ $server['status']['version'] }}</span>
                                </div>
                                <div class="bg-slate-50 p-3 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] space-y-0.5">
                                    <span class="text-[10px] uppercase text-slate-400 block font-pixel">Pemain Online</span>
                                    <span class="text-slate-800">{{ $server['status']['players_online'] }} / {{ $server['status']['players_max'] }}</span>
                                </div>
                            </div>

                            <!-- Ports Config -->
                            <div class="space-y-2">
                                <h4 class="text-xs uppercase font-extrabold text-slate-500 font-pixel">Port Koneksi</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($server['ports'] as $portInfo)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 border-2 border-slate-900 bg-slate-100 text-slate-800 text-[10px] font-extrabold uppercase shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)]">
                                            @if($portInfo['type'] === 'java')
                                                <i class="fa-solid fa-mug-hot text-amber-600"></i> Java: {{ $portInfo['port'] }}
                                            @else
                                                <i class="fa-solid fa-cube text-emerald-600"></i> Bedrock: {{ $portInfo['port'] }}
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Copy IP button -->
                        <div class="mt-8 pt-4 border-t-2 border-slate-900 flex gap-4" x-data="{ copied: false }">
                            <button @click="navigator.clipboard.writeText('{{ $server['ip'] }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="w-full text-center inline-flex items-center justify-center gap-1.5 px-4 py-2.5 border-2 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                <span x-show="!copied" class="inline-flex items-center gap-1.5">
                                    <i class="fa-solid fa-copy text-sm"></i> Salin Alamat IP
                                </span>
                                <span x-show="copied" class="inline-flex items-center gap-1.5" x-cloak>
                                    <i class="fa-solid fa-check text-sm"></i> Tersalin!
                                </span>
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
