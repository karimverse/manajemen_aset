<x-app-layout>
    <div class="content-header">
        <h1>Edit Lokasi: {{ $location->name }}</h1>
    </div>

    <div class="content-card">

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <strong>Oops! Ada kesalahan:</strong>
                <ul style="list-style-position: inside; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('locations.update', $location->id) }}">
            @csrf
            @method('PUT') <div class="form-group">
                <label for="name" class="form-label">Nama Lokasi</label>
                <input type="text" name="name" id="name" value="{{ old('name', $location->name) }}" required class="form-control">
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">
                    Update Lokasi
                </button>
                <a href="{{ route('locations.index') }}" class="btn btn-secondary" style="margin-left: 0.5rem;">
                    Batal
                </a>
            </div>
        </form>

    </div> </x-app-layout>
