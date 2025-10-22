<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <style>
        /* Container utama */
        .guest-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1.5rem;
            position: relative;
            z-index: 1;
        }
        .guest-logo { width: 200px; margin-bottom: 2rem; }
        .guest-card { width: 100%; max-width: 420px; background-color: #ffffff; padding: 2.5rem; border-radius: 0.75rem; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); }
        /* Style dasar untuk form (tetap sama) */
         .form-group { margin-bottom: 1.5rem; }
         .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #495057; }
         .form-input { width: 100%; padding: 0.75rem 1rem; border: 1px solid #ced4da; border-radius: 0.375rem; font-size: 0.95rem; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
         .form-input:focus { outline: none; border-color: #007bff; box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); }
         .form-checkbox-label { display: flex; align-items: center; font-size: 0.9rem; color: #495057; }
         .form-checkbox { margin-right: 0.5rem; }
         .form-button { width: 100%; padding: 0.8rem 1rem; background-color: #0052cc; color: white; border: none; border-radius: 0.375rem; font-size: 1rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease; }
         .form-button:hover { background-color: #0041a3; }
         .form-link { color: #007bff; text-decoration: none; font-size: 0.9rem; }
         .form-link:hover { text-decoration: underline; }
         .form-footer-text { margin-top: 1.5rem; text-align: center; font-size: 0.9rem; color: #6c757d; }
         .input-error { color: #dc3545; font-size: 0.8rem; margin-top: 0.25rem; }

        /* === PERBAIKAN STYLE BACKGROUND BATIK === */
        .batik-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1; /* Di belakang konten */
            /* Pastikan path dan nama file benar */
            background-image: url('/images/batik-pattern.jpg');
            background-repeat: repeat; /* Ulangi pattern */
            background-size: auto; /* Ukuran asli gambar */
            background-attachment: fixed;
        }

        /* Hapus keyframes animasi */
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">

    
    <div class="batik-background"></div>

    <div class="guest-container">
        <div>
            <a href="/">
                <img src="<?php echo e(asset('logo-imst.png')); ?>" alt="PT. IMST Logo" class="guest-logo">
            </a>
        </div>

        <div class="guest-card">
            <?php echo e($slot); ?>

        </div>
    </div>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\manajemen-aset\resources\views/layouts/guest.blade.php ENDPATH**/ ?>