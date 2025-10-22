<x-guest-layout>
    <h2 style="font-size: 1.5rem; font-weight: 700; text-align: center; margin-bottom: 2rem; color: #343a40;">
        Buat Akun Baru
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama Anda" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Anda</label>
            <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <button type="submit" class="form-button">
                Register
            </button>
        </div>

        <p class="form-footer-text">
            Sudah punya akun? <a href="{{ route('login') }}" class="form-link">Login</a>
        </p>
    </form>
</x-guest-layout>
