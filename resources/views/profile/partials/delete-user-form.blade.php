<section class="space-y-6">
    {{-- Kita ganti tombolnya agar pakai class btn --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn btn-danger" {{-- Ganti class di sini --}}
    >Hapus Akun</button>

    {{-- Modal konfirmasi tetap sama --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-sm text-muted">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus permanen. Silakan masukkan password Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6 form-group"> {{-- Tambah class --}}
                <label for="password" class="sr-only">Password</label> {{-- Bisa dihapus jika tidak pakai sr-only --}}
                <label for="password_delete" class="form-label">Password</label> {{-- Tambah label biasa --}}

                <input
                    id="password_delete"
                    name="password"
                    type="password"
                    class="form-control mt-1 block w-3/4" {{-- Tambah class --}}
                    placeholder="Password"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 input-error" />
            </div>

            <div class="mt-6 flex justify-end">
                <button type="button" x-on:click="$dispatch('close')" class="btn btn-secondary"> {{-- Ganti class --}}
                    Batal
                </button>

                <button type="submit" class="btn btn-danger" style="margin-left: 0.5rem;"> {{-- Ganti class --}}
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
