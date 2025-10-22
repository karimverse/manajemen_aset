<x-guest-layout>
    <h2 style="font-size: 1.5rem; font-weight: 700; text-align: center; margin-bottom: 1rem; color: #343a40;">
        Lupa Password Anda?
    </h2>

    <div class="mb-4 text-sm text-gray-600" style="color: #6c757d; font-size: 0.9rem; text-align: center; margin-bottom: 1.5rem;">
        Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimkan link reset password melalui email yang memungkinkan Anda memilih yang baru.
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" style="color: #28a745; background-color:#d4edda; border: 1px solid #c3e6cb; padding: 0.75rem 1rem; border-radius: 0.25rem; margin-bottom: 1rem;" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="form-label">Email</label>
            <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus placeholder="Masukkan email Anda"/>
            <x-input-error :messages="$errors->get('email')" class="mt-2 input-error" />
        </div>

        <div class="form-group" style="margin-top: 2rem;">
            <button type="submit" class="form-button">
                Kirim Link Reset Password
            </button>
        </div>

         <p class="form-footer-text">
             Ingat password Anda? <a href="{{ route('login') }}" class="form-link">Login</a>
         </p>
    </form>
</x-guest-layout>
