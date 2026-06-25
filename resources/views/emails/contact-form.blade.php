<x-mail::message>
# Pesan Baru Dari Hubungi Kami

Anda menerima pesan baru melalui formulir kontak website **UNEMO**.

**Detail Pengirim:**
- **Nama:** {{ $name }}
- **Email:** {{ $email }}
- **Subjek:** {{ $msgSubject }}

**Isi Pesan:**
{{ $msgContent }}

<x-mail::button :url="url('/admin')">
Buka Portal Admin
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
