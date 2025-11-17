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
    <div class="content-header">
        <h1>Edit Aset: <?php echo e($asset->name); ?></h1>
    </div>

    <div class="content-card">

        <?php if($errors->any()): ?>
            <div class="alert alert-danger mb-4">
                <strong>Oops! Ada kesalahan:</strong>
                <ul style="list-style-position: inside; padding-left: 1rem;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('assets.update', $asset->id)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?> <div class="form-group">
                <label for="name" class="form-label">Nama Aset</label>
                <input type="text" name="name" id="name" value="<?php echo e(old('name', $asset->name)); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="asset_code" class="form-label">Kode Aset</label>
                <input type="text" name="asset_code" id="asset_code" value="<?php echo e(old('asset_code', $asset->asset_code)); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" required class="form-control">
                    <option value="">Pilih Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $asset->category_id) == $category->id ? 'selected' : ''); ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="location_id" class="form-label">Lokasi</label>
                <select name="location_id" id="location_id" required class="form-control">
                    <option value="">Pilih Lokasi</option>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($location->id); ?>" <?php echo e(old('location_id', $asset->location_id) == $location->id ? 'selected' : ''); ?>>
                            <?php echo e($location->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" required class="form-control">
                    <option value="">Pilih Status</option>
                    <option value="Baik" <?php echo e(old('status', $asset->status) == 'Baik' ? 'selected' : ''); ?>>Baik</option>
                    <option value="Perbaikan" <?php echo e(old('status', $asset->status) == 'Perbaikan' ? 'selected' : ''); ?>>Perbaikan</option>
                    <option value="Rusak" <?php echo e(old('status', $asset->status) == 'Rusak' ? 'selected' : ''); ?>>Rusak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="purchase_date" class="form-label">Tanggal Beli</label>
                <input type="date" name="purchase_date" id="purchase_date" value="<?php echo e(old('purchase_date', $asset->purchase_date)); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="purchase_price" class="form-label">Harga Beli (Rp)</label>
                <input type="number" name="purchase_price" id="purchase_price" value="<?php echo e(old('purchase_price', $asset->purchase_price)); ?>" required class="form-control">
            </div>

            <div class="form-group">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="4" class="form-control"><?php echo e(old('description', $asset->description)); ?></textarea>
            </div>

            <div style="text-align: right;">
                <button type="submit" class="btn btn-primary">
                    Update Aset
                </button>
                <a href="<?php echo e(route('assets.index')); ?>" class="btn btn-secondary" style="margin-left: 0.5rem;">
                    Batal
                </a>
            </div>
        </form>

    </div>  <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH D:\xampp\htdocs\manajemen-aset\resources\views/assets/edit.blade.php ENDPATH**/ ?>