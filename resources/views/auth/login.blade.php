<x-guest-layout>
    {{-- Hapus Judul dari sini, sudah ada di layout --}}
    {{-- <h2 style="...">Login ke Akun Anda</h2> --}}

    <x-auth-session-status class="mb-4" :status="session('status')" style="color: #28a745; background-color:#d4edda; border: 1px solid #c3e6cb; padding: 0.75rem 1rem; border-radius: 0.25rem; margin-bottom: 1rem;" />

    {{-- Tombol Google Login (Opsional) --}}
    {{--
    <button type="button" class="google-login-btn">
        <svg viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"></path><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v8.51h13.01c-.59 2.74-2.26 5.09-4.78 6.67l7.4 5.72C43.97 36.4 46.98 31 46.98 24.55z"></path><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.74-2.99-.74-4.59s.26-3.14.74-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"></path><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.4-5.72c-2.17 1.45-4.94 2.3-8.49 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"></path><path fill="none" d="M0 0h48v48H0z"></path></svg>
        Google
    </button>
    <div class="login-separator">atau lanjutkan dengan</div>
    --}}

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email/akun pengguna*</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password*</label>
            <div class="password-input-group">
                <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password"/>
                {{-- Tambahkan ikon mata jika ingin toggle password --}}
                {{-- <span class="password-toggle-icon">👁️</span> --}}
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 input-error" />
        </div>

        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
            <label for="remember_me" class="form-checkbox-label">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="form-link" href="{{ route('password.request') }}">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="form-button">
                Masuk
            </button>
        </div>

        @if (Route::has('register'))
            <p class="form-footer-text">
                Belum punya akun? <a href="{{ route('register') }}" class="form-link">Register</a>
            </p>
        @endif
    </form>
</x-guest-layout>
