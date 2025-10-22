<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
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
                <p><?php echo e($totalAssets); ?></p>
            </div>
        </div>

        <div class="stat-card success">
            <div class="icon">✅</div>
            <div class="info">
                <h3>Aset (Baik)</h3>
                <p><?php echo e($assetsBaik); ?></p>
            </div>
        </div>

        <div class="stat-card danger">
            <div class="icon">⚠️</div>
            <div class="info">
                <h3>Aset (Rusak)</h3>
                <p><?php echo e($assetsRusak); ?></p>
            </div>
        </div>

        <div class="stat-card warning">
            <div class="icon">🛠️</div>
            
            <div class="info">
                <h3>Aset (Perbaikan)</h3>
                <p><?php echo e($assetsPerbaikan); ?></p>
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
    <?php $__env->startPush('scripts'); ?>
    <script>
        // Data untuk Chart Kondisi Aset (Diagram Lingkaran)
        const kondisiLabels = ['Baik', 'Perbaikan', 'Rusak'];
        const kondisiData = [<?php echo e($assetsBaik); ?>, <?php echo e($assetsPerbaikan); ?>, <?php echo e($assetsRusak); ?>];
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
        const kategoriLabels = <?php echo json_encode($chartKategori->pluck('name')); ?>;
        const kategoriData = <?php echo json_encode($chartKategori->pluck('assets_count')); ?>;

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
    <?php $__env->stopPush(); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\manajemen-aset\resources\views/dashboard.blade.php ENDPATH**/ ?>