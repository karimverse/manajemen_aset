<x-app-layout>
    <div class="content-header">
        <h1>Tambah Aset Baru</h1>
    </div>

    <div class="content-card">

        @if ($errors->any())
            <div class="alert alert-danger mb-4"> <strong>Oops! Ada kesalahan:</strong>
                <ul style="list-style-position: inside; padding-left: 1rem;"> @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('assets.store') }}">
            @csrf <div class="form-group">
                <label for="name" class="form-label">Nama Aset</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="asset_code" class="form-label">Kode Aset</label>
                <input type="text" name="asset_code" id="asset_code" value="{{ old('asset_code') }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" required class="form-control">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="location_id" class="form-label">Lokasi</label>
                <select name="location_id" id="location_id" required class="form-control">
                    <option value="">Pilih Lokasi</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" required class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="Baik" {{ old('status') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Perbaikan" {{ old('status') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                    <option value="Rusak" {{ old('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="purchase_date" class="form-label">Tanggal Beli</label>
                <input type="date" name="purchase_date" id="purchase_date" value="{{ old('purchase_date') }}" required class="form-control">
            </div>

            <div class="form-group">
                <label for="purchase_price" class="form-label">Harga Beli (Rp)</label>
                <input type="number" name="purchase_price" id="purchase_price" value="{{ old('purchase_price') }}" required class="form-control" placeholder="Contoh: 5000000">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control">{{ old('description') }}</textarea>
            </div>

            <div style="text-align: right;"> <button type="submit" class="btn btn-primary">
                    Simpan Aset
                </button>
                <a href="{{ route('assets.index') }}" class="btn btn-secondary" style="margin-left: 0.5rem;">
                    Batal
                </a>
            </div>
        </form>

    </div> </x-app-layout>
