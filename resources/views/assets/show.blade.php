<x-app-layout>
    <div class="content-header">
        <h1>Detail Aset: {{ $asset->name }}</h1>
    </div>

    <div class="content-card">

        <div class="detail-grid">

            <div class="detail-info">
                <div class="info-item">
                    <span class="info-label">Kode Aset</span>
                    <span class="info-value">{{ $asset->asset_code }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        <span class="badge status-{{ strtolower($asset->status) }}">
                            {{ $asset->status }}
                        </span>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kategori</span>
                    <span class="info-value">{{ $asset->category->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Lokasi</span>
                    <span class="info-value">{{ $asset->location->name ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Beli</span>
                    <span class="info-value">{{ $asset->purchase_date }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Harga Beli</span>
                    <span class="info-value">Rp {{ number_format($asset->purchase_price, 0, ',', '.') }}</span>
                </div>
                <div class="info-item full-width"> <span class="info-label">Deskripsi</span>
                    <span class="info-value">{{ $asset->description ?? '-' }}</span>
                </div>
            </div>

            <div class="detail-qrcode">
                <h3 class="qr-title">Scan QR Code</h3>
                <div class="qr-code-box" id="qrCodeContainer">
                    {{-- QR Code SVG --}}
                    {!! QrCode::size(200)->generate(route('assets.show', $asset->id)) !!}

                    {{-- PINDAHKAN TEXT KE SINI --}}
                    <p class="qr-text-inside">Scan di sini</p>
                </div>
                {{-- HAPUS TEXT DARI SINI
                <p class="qr-caption">Scan Di Sini</p>
                --}}

                <div class="button-group mt-3">
                    <button onclick="printQrCode('{{ $asset->name }}')" class="btn btn-primary">
                        {{-- TAMBAHKAN IKON PRINT --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16" style="margin-right: 0.5rem;">
                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1"/>
                        </svg>
                        Cetak
                    </button>
                    <button onclick="downloadQrCode('{{ $asset->asset_code }}.svg')" class="btn btn-light"> {{-- Ganti ke btn-light --}}
                        {{-- TAMBAHKAN IKON DOWNLOAD --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16" style="margin-right: 0.5rem;">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V5.5a.5.5 0 0 0-1 0v4.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                        </svg>
                        Unduh
                    </button>
                    <a href="{{ route('assets.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
            </div>

        </div> <hr class="separator">

        <div class="history-section">
            <h2 class="section-title">Riwayat Aset</h2>
            <div class="table-responsive">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                            <th>User</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($asset->histories->sortByDesc('created_at') as $history)
                            <tr>
                                <td>{{ $history->created_at->format('d M Y, H:i') }}</td>
                                <td>{{ $history->action }}</td>
                                <td>{{ $history->user->name ?? 'N/A' }}</td>
                                <td>{{ $history->notes }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada riwayat untuk aset ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        </div> @push('scripts')
<script>
    // MODIFIKASI FUNGSI INI
    function printQrCode(assetName) { // Tambahkan parameter assetName
        const qrCodeContent = document.getElementById('qrCodeContainer').innerHTML;
        const printWindow = window.open('', '_blank', 'height=400,width=400');

        // Gunakan assetName di title
        printWindow.document.write(`<html><head><title>Cetak QR Code - ${assetName}</title>`);
        printWindow.document.write('<style> body { margin: 20px; text-align: center; } </style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write(qrCodeContent);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();

        setTimeout(function () {
            printWindow.print();
            printWindow.close();
        }, 250);
    }

    // Fungsi baru untuk mengunduh QR Code
    function downloadQrCode(filename) {
    // Ambil elemen SVG QR Code
    const qrCodeSvg = document.querySelector('#qrCodeContainer svg');

    if (qrCodeSvg) {
        // Buat string SVG dari elemen
        const svgData = new XMLSerializer().serializeToString(qrCodeSvg);
        const svgBlob = new Blob([svgData], {type: "image/svg+xml;charset=utf-8"});
        const svgUrl = URL.createObjectURL(svgBlob);

        const downloadLink = document.createElement("a");
        downloadLink.href = svgUrl;
        downloadLink.download = filename; // Nama file saat diunduh (misal: "kode_aset.svg")
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
        URL.revokeObjectURL(svgUrl); // Bersihkan URL objek setelah digunakan
    } else {
        Swal.fire('Gagal', 'Gambar QR Code tidak ditemukan.', 'error');
    }
}
</script>
@endpush

    </div> </x-app-layout>
