<x-mail::message>
# Pendaftaran Anda Berhasil!

Halo **{{ $admission->name }}**,

Selamat! Berkas pendaftaran Anda sebagai calon mahasiswa baru **Universitas Negeri Mojang (UNEMO)** telah kami terima dengan sukses.

**Detail Pendaftaran:**
- **Nomor Registrasi:** `{{ $admission->registration_number }}`
- **Program Studi Pilihan:** {{ $admission->department->name ?? '-' }}
- **Jalur Seleksi:** Jalur {{ ucfirst($admission->path) }}

**Langkah Selanjutnya:**
Berkas Anda sedang dalam proses peninjauan oleh Panitia Rektorat Steve. Silakan tunggu pengumuman kelulusan resmi. Anda dapat memantau status kelulusan secara berkala di portal kelulusan kami menggunakan nomor registrasi di atas.

<x-mail::button :url="route('smpt.check', ['search' => $admission->registration_number])">
Cek Status Kelulusan
</x-mail::button>

Terima kasih atas minat Anda bergabung bersama kami. Semoga sukses dalam seleksi survival akademik ini!

Salam hangat,<br>
**Panitia PMB UNEMO**
</x-mail::message>
