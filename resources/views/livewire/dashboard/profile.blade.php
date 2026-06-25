<div class="py-12 bg-brutal-bg min-h-screen font-sans selection:bg-primary/20 selection:text-primary">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Dashboard Sidebar (3 Cols) -->
            <aside class="lg:col-span-3 space-y-6">
                <!-- User Quick Info -->
                <div class="bg-white border-4 border-slate-900 p-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-2 bg-primary"></div>
                    @if($user && $user->student)
                        <img src="{{ $user->student->getAvatarUrl() }}" alt="Avatar" class="h-20 w-20 mx-auto border-4 border-slate-900 bg-primary-pastel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] object-contain mb-4">
                    @else
                        <div class="h-20 w-20 mx-auto border-4 border-slate-900 bg-secondary-pastel shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] flex items-center justify-center text-slate-800 font-pixel text-4xl mb-4 uppercase">
                            {{ substr($user->name ?? 'U', 0, 1) }}
                        </div>
                    @endif
                    <h3 class="font-pixel text-xl font-extrabold text-slate-900 uppercase tracking-wide">{{ $user->name }}</h3>
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mt-1">{{ $user->roles->first()?->name ?? 'User' }}</p>
                </div>

                <!-- Navigation Menu -->
                <div class="bg-white border-4 border-slate-900 p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                    <nav class="space-y-2">
                        <a href="{{ route('dashboard.overview') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-slate-50 font-extrabold uppercase text-xs tracking-wider transition-all">
                            <i class="fa-solid fa-chart-simple text-sm"></i>
                            <span>Statistik & Jadwal</span>
                        </a>
                        <a href="{{ route('dashboard.profile') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-slate-900 bg-primary text-white font-extrabold uppercase text-xs tracking-wider shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] transition-all">
                            <i class="fa-solid fa-user text-sm"></i>
                            <span>Profil Saya</span>
                        </a>
                        @if($user && ($user->hasRole('Super Admin') || $user->hasRole('Academic Staff') || $user->hasRole('Lecturer') || $user->hasRole('Student')))
                            <a href="/admin" 
                               class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-slate-700 hover:border-slate-900 hover:bg-secondary-pastel font-extrabold uppercase text-xs tracking-wider transition-all">
                                <i class="fa-solid fa-shield-halved text-sm text-secondary"></i>
                                <span>Portal Admin (Filament)</span>
                            </a>
                        @endif
                        <hr class="border-slate-900 border-t-2 my-2">
                        <a href="{{ route('home') }}" 
                           wire:navigate
                           class="flex items-center gap-3 px-4 py-3 border-2 border-transparent text-red-600 hover:border-slate-900 hover:bg-red-50 font-extrabold uppercase text-xs tracking-wider transition-all">
                            <i class="fa-solid fa-house text-sm"></i>
                            <span>Kembali Ke Beranda</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Dashboard Content Area (9 Cols) -->
            <main class="lg:col-span-9 space-y-8">
                
                <!-- Main Profile Details Card -->
                <section class="bg-white border-4 border-slate-900 p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] space-y-6">
                    <div class="border-b-2 border-slate-900 pb-4">
                        <h2 class="text-2xl font-extrabold text-slate-900 font-pixel uppercase tracking-wide">Informasi Profil Akun</h2>
                        <p class="text-xs text-slate-500">Informasi utama identitas civitas akademika UNEMO.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left Details List -->
                        <div class="space-y-4">
                            <div>
                                <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Nama Lengkap</span>
                                <span class="text-sm font-extrabold text-slate-900 uppercase font-pixel tracking-wide text-lg">{{ $user->name }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Alamat E-mail</span>
                                <span class="text-sm font-bold text-slate-700">{{ $user->email }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Status Peran</span>
                                <span class="inline-flex items-center px-2 py-0.5 border-2 border-slate-900 text-[10px] font-extrabold uppercase bg-secondary-pastel text-slate-800 shadow-[1px_1px_0px_0px_rgba(0,0,0,1)] mt-1">
                                    {{ $user->roles->first()?->name ?? 'User' }}
                                </span>
                            </div>
                        </div>

                        <!-- Right Role-Specific Details -->
                        <div class="space-y-4 md:border-l-2 md:border-slate-100 md:pl-6">
                            @if($user && $user->student)
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Nomor Induk Mahasiswa (NIM)</span>
                                    <span class="text-sm font-bold text-slate-800 font-pixel text-lg">{{ $user->student->nim }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Program Studi / Fakultas</span>
                                    <span class="text-xs font-bold text-slate-800 uppercase">
                                        {{ $user->student->department->name ?? '-' }} ({{ $user->student->department->faculty->name ?? '-' }})
                                    </span>
                                </div>
                            @elseif($user && $user->lecturer)
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">NIP Dosen</span>
                                    <span class="text-sm font-bold text-slate-800 font-pixel text-lg">{{ $user->lecturer->nip }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider font-pixel">Program Studi Terikat</span>
                                    <span class="text-xs font-bold text-slate-800 uppercase">{{ $user->lecturer->department->name ?? '-' }}</span>
                                </div>
                            @elseif($user && $user->staff)
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">NIP Staff</span>
                                    <span class="text-sm font-bold text-slate-800 font-pixel text-lg">{{ $user->staff->nip }}</span>
                                </div>
                                <div>
                                    <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Jabatan Kerja</span>
                                    <span class="text-xs font-bold text-slate-800 uppercase">{{ $user->staff->position ?? '-' }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </section>

                <!-- Student Statistics Block in Profile Page -->
                @if($user && $user->student)
                    <section class="bg-white border-4 border-slate-900 p-8 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] space-y-6">
                        <div class="border-b-2 border-slate-900 pb-4 flex items-center gap-2">
                            <i class="fa-solid fa-award text-primary text-xl"></i>
                            <h2 class="text-2xl font-extrabold text-slate-900 font-pixel uppercase tracking-wide">Statistik & Nilai Kelulusan</h2>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div class="bg-primary-pastel p-4 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] text-center">
                                <span class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider">Indeks Prestasi (IPK)</span>
                                <span class="text-2xl font-extrabold font-pixel text-slate-900">{{ number_format($user->student->gpa, 2) }}</span>
                            </div>
                            <div class="bg-secondary-pastel p-4 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] text-center">
                                <span class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider">Jumlah SKS Lulus</span>
                                <span class="text-2xl font-extrabold font-pixel text-slate-900">{{ $user->student->credit_hours }} SKS</span>
                            </div>
                            <div class="bg-white p-4 border-2 border-slate-900 shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] text-center">
                                <span class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-wider">Semester Saat Ini</span>
                                <span class="text-2xl font-extrabold font-pixel text-slate-900">0{{ $user->student->current_semester }}</span>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <span class="block text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Prestasi Terdaftar:</span>
                            @if($user->student->achievements && count($user->student->achievements) > 0)
                                <div class="flex flex-wrap gap-2 pt-1">
                                    @foreach($user->student->achievements as $ach)
                                        <span class="px-2.5 py-1 border-2 border-slate-900 bg-emerald-100 text-emerald-800 text-[10px] font-extrabold uppercase shadow-[1.5px_1.5px_0px_0px_rgba(0,0,0,1)]">
                                            🎖 {{ $ach }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-xs text-slate-400 italic">Belum ada prestasi tercatat.</span>
                            @endif
                        </div>
                    </section>
                @endif

                <!-- Edit Profile Details & Password Settings forms side-by-side -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Edit Profile Details Form -->
                    <section class="bg-white border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="border-b-2 border-slate-900 pb-3">
                                <h3 class="text-lg font-extrabold text-slate-900 font-pixel uppercase tracking-wide">Ubah Detail Kontak</h3>
                                <p class="text-[10px] text-slate-500">Sesuaikan data nomor telepon dan alamat tinggal Anda.</p>
                            </div>

                            @if (session()->has('profile_success'))
                                <div class="p-3 border-2 border-emerald-900 bg-emerald-100 text-emerald-800 font-bold text-xs uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    {{ session('profile_success') }}
                                </div>
                            @endif

                            <div class="space-y-3">
                                <div>
                                    <label for="phone" class="block text-xs font-bold text-slate-700 uppercase">Nomor Telepon</label>
                                    <input type="text" id="phone" wire:model="phone" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none">
                                    @error('phone') <span class="text-red-600 text-[10px] font-extrabold uppercase mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                @if($user && $user->student)
                                    <div>
                                        <label for="tiktok" class="block text-xs font-bold text-slate-700 uppercase">Username TikTok (Tanpa @)</label>
                                        <input type="text" id="tiktok" wire:model="tiktok" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none" placeholder="unemo.student">
                                        @error('tiktok') <span class="text-red-600 text-[10px] font-extrabold uppercase mt-1 block">{{ $message }}</span> @enderror
                                    </div>
                                @endif

                                <div>
                                    <label for="address" class="block text-xs font-bold text-slate-700 uppercase">Alamat Tinggal</label>
                                    <textarea id="address" wire:model="address" rows="3" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none"></textarea>
                                    @error('address') <span class="text-red-600 text-[10px] font-extrabold uppercase mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button wire:click="saveProfile" class="w-full inline-flex items-center justify-center px-4 py-2.5 border-2 border-slate-900 bg-primary hover:bg-primary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                Simpan Detail Profil
                            </button>
                        </div>
                    </section>

                    <!-- Change Password Form -->
                    <section class="bg-white border-4 border-slate-900 p-6 shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] flex flex-col justify-between">
                        <div class="space-y-4">
                            <div class="border-b-2 border-slate-900 pb-3">
                                <h3 class="text-lg font-extrabold text-slate-900 font-pixel uppercase tracking-wide">Ganti Password</h3>
                                <p class="text-[10px] text-slate-500">Amankan akun Anda dengan memperbarui password secara berkala.</p>
                            </div>

                            @if (session()->has('password_success'))
                                <div class="p-3 border-2 border-emerald-900 bg-emerald-100 text-emerald-800 font-bold text-xs uppercase shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                    {{ session('password_success') }}
                                </div>
                            @endif

                            <div class="space-y-3">
                                <div>
                                    <label for="current_password" class="block text-xs font-bold text-slate-700 uppercase">Password Saat Ini</label>
                                    <input type="password" id="current_password" wire:model="current_password" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none">
                                    @error('current_password') <span class="text-red-600 text-[10px] font-extrabold uppercase mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="new_password" class="block text-xs font-bold text-slate-700 uppercase">Password Baru</label>
                                    <input type="password" id="new_password" wire:model="new_password" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none">
                                    @error('new_password') <span class="text-red-600 text-[10px] font-extrabold uppercase mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700 uppercase">Konfirmasi Password Baru</label>
                                    <input type="password" id="new_password_confirmation" wire:model="new_password_confirmation" class="mt-1 block w-full px-3 py-2 border-2 border-slate-900 bg-slate-50 focus:bg-white text-xs font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] focus:shadow-none focus:translate-x-0.5 focus:translate-y-0.5 transition-all outline-none">
                                </div>
                            </div>
                        </div>

                        <div class="pt-6">
                            <button wire:click="changePassword" class="w-full inline-flex items-center justify-center px-4 py-2.5 border-2 border-slate-900 bg-secondary hover:bg-secondary/95 text-white font-extrabold uppercase font-pixel tracking-wider text-xs shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                                Perbarui Password
                            </button>
                        </div>
                    </section>

                </div>

            </main>
            
        </div>
    </div>
</div>
