<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group">
            <label for="current_password" class="form-label">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Password Baru</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 input-error" />
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password"/>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 input-error" />
        </div>

        <div class="flex items-center gap-4 mt-4" style="text-align: right;">
            <button type="submit" class="btn btn-primary">Simpan</button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-muted"
                     style="margin-left: 1rem; display: inline-block;"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
