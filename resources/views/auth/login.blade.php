<x-guest-layout>
    <h2 style="font-size: 1.5rem; font-weight: 700; text-align: center; margin-bottom: 2rem; color: #343a40;">
        Login ke Akun Anda
    </h2>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email Anda</label>
            <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 input-error" />
        </div>

        <div class="form-group" style="display: flex; justify-content: space-between; align-items: center;">
            <label for="remember_me" class="form-checkbox-label">
                <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="form-link" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="form-button">
                Login
            </button>
        </div>

        @if (Route::has('register'))
            <p class="form-footer-text">
                Belum punya akun? <a href="{{ route('register') }}" class="form-link">Register</a>
            </p>
        @endif
    </form>
</x-guest-layout>
