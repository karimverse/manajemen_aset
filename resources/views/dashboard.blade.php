<x-app-layout>
    <!-- Judul Halaman -->
    <div class="content-header">
        <h1>Dashboard Overview</h1>
    </div>

    <!-- Kartu Statistik -->
    <div class="stat-card-grid">

        <div class="stat-card primary">
            <div class="icon">💻</div>
            <div class="info">
                <h3>Total Aset</h3>
                <p>{{ $totalAssets }}</p>
            </div>
        </div>

        <div class="stat-card success">
            <div class="icon">✅</div>
            <div class="info">
                <h3>Aset (Baik)</h3>
                <p>{{ $assetsBaik }}</p>
            </div>
        </div>

        <div class="stat-card danger">
            <div class="icon">⚠️</div>
            <div class="info">
                <h3>Aset (Rusak)</h3>
                <p>{{ $assetsRusak }}</p>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="icon">🛠️</div>
            {{-- PERBAIKAN TYPO DI SINI --}}
            <div class="info">
                <h3>Aset (Perbaikan)</h3>
                <p>{{ $assetsPerbaikan }}</p>
            </div>
        </div>

    </div>

    <!-- Grid untuk Chart -->
    <div class="chart-grid">

        <div class="chart-container">
            <h3>Aset per Kategori</h3>
            <canvas id="chartKategori"></canvas>
        </div>

        <div class="chart-container">
            <h3>Kondisi Aset</h3>
            <canvas id="chartKondisi"></canvas>
        </div>

    </div>


    <!-- Kode JavaScript untuk Chart -->
    @push('scripts')
    <script>
        // Data untuk Chart Kondisi Aset (Diagram Lingkaran)
        const kondisiLabels = ['Baik', 'Perbaikan', 'Rusak'];
        const kondisiData = [{{ $assetsBaik }}, {{ $assetsPerbaikan }}, {{ $assetsRusak }}];
        const kondisiBackgroundColors = ['#28a745', '#ffc107', '#dc3545'];

        const ctxKondisi = document.getElementById('chartKondisi').getContext('2d');
        new Chart(ctxKondisi, {
            type: 'doughnut',
            data: {
                labels: kondisiLabels,
                datasets: [{
                    label: 'Kondisi Aset',
                    data: kondisiData,
                    backgroundColor: kondisiBackgroundColors,
                    hoverOffset: 8,
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Data untuk Chart Kategori Aset (Diagram Batang)
        const kategoriLabels = {!! json_encode($chartKategori->pluck('name')) !!};
        const kategoriData = {!! json_encode($chartKategori->pluck('assets_count')) !!};

        const ctxKategori = document.getElementById('chartKategori').getContext('2d');
        new Chart(ctxKategori, {
            type: 'bar',
            data: {
                labels: kategoriLabels,
                datasets: [{
                    label: 'Jumlah Aset',
                    data: kategoriData,
                    backgroundColor: '#0052cc', // Biru IMST
                    borderRadius: 4,
                    barPercentage: 0.7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
    @endpush

</x-app-layout>
