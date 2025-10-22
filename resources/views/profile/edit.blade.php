<x-app-layout>
    <div class="content-header">
        <h1>Profil Pengguna</h1>
    </div>

    {{-- Gunakan layout grid jika perlu, atau tumpuk card --}}
    <div class="profile-page-container">

        {{-- Card 1: Informasi Profil --}}
        <div class="content-card">
            <h2 class="section-title mb-4">Informasi Profil</h2>
            <p class="mb-4 text-muted">Perbarui informasi profil dan alamat email akun Anda.</p>
            {{-- Include partial view bawaan Breeze untuk form info profil --}}
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Card 2: Update Password --}}
        <div class="content-card">
            <h2 class="section-title mb-4">Update Password</h2>
            <p class="mb-4 text-muted">Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.</p>
             {{-- Include partial view bawaan Breeze untuk form update password --}}
            @include('profile.partials.update-password-form')
        </div>

        {{-- Card 3: Hapus Akun --}}
        <div class="content-card danger-zone"> {{-- Tambah class khusus --}}
            <h2 class="section-title mb-4 text-danger">Hapus Akun</h2>
            <p class="mb-4 text-muted">Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.</p>
             {{-- Include partial view bawaan Breeze untuk tombol hapus akun --}}
            @include('profile.partials.delete-user-form')
        </div>

        <div style="margin-top: 1.5rem; text-align: right;"> {{-- Ganti left jadi right --}}
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>

    </div>

</x-app-layout>
