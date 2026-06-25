<x-mail::message>
# Pengumuman Hasil Seleksi SMPT UNEMO

Halo **{{ $admission->name }}**,

Panitia Penerimaan Mahasiswa Baru Universitas Negeri Mojang (UNEMO) telah selesai melakukan peninjauan terhadap berkas dan hasil ujian seleksi Anda dengan Nomor Registrasi `{{ $admission->registration_number }}`.

@if ($admission->status === 'accepted')
## 🎉 Selamat! Anda Dinyatakan Lulus / Diterima

Berdasarkan hasil evaluasi dokumen kelengkapan survival, skin petualang, serta skor ujian kuis yang memuaskan, Anda secara resmi **Diterima** sebagai mahasiswa baru UNEMO pada Program Studi **{{ $admission->department->name ?? '-' }}**.

**Langkah Registrasi Ulang:**
1. Silakan login ke Dashboard Mahasiswa menggunakan alamat email ini: `{{ $admission->email }}`.
2. Jika belum memiliki password atau ingin memperbaruinya, silakan gunakan fitur ganti password di profil Anda atau reset password.
3. Lengkapi berkas daftar ulang dan ikuti orientasi Nether OSPEK yang akan diumumkan selanjutnya.

<x-mail::button :url="route('login')">
Login ke Dashboard
</x-mail::button>
@else
## Dinyatakan Belum Lulus / Ditolak

Kami memohon maaf karena saat ini berkas pendaftaran atau skor ujian Anda belum memenuhi kualifikasi batas minimal kelulusan untuk jalur masuk tahun ini. Jangan berkecil hati, Anda tetap dapat mencoba mendaftar kembali pada gelombang penerimaan berikutnya.

Tetap semangat dalam mengasah kemampuan redstone dan survival Anda di dunia Overworld!
@endif

Terima kasih atas partisipasi Anda dalam seleksi penerimaan ini.

Salam hangat,<br>
**Rektorat & Panitia Seleksi UNEMO**
</x-mail::message>
