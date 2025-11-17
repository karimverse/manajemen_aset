<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title>Manajemen Aset - IMST</title>
    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>" type="image/x-icon">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <style>
        body {
            /* Background batik tetap di body */
            background-image: url('/images/batik-pattern.jpg'); /* Pastikan path benar */
            background-repeat: repeat;
            background-size: auto;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333; /* Default text color */
        }

        .login-card {
            display: flex;
            width: 100%;
            max-width: 900px; /* Lebar card */
            background-color: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* Kolom Kiri (Gambar & Teks) */
        .login-left-column {
            flex: 1; /* Ambil setengah lebar */
            position: relative;
            background-image: url('/images/imst.jpg'); /* <<-- GANTI GAMBAR GEDUNG/KANTOR */
            background-size: cover;
            background-position: center;
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end; /* Teks di bawah */
        }
        .login-left-column::before { /* Overlay gelap */
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.1));
            z-index: 1;
        }
        .login-left-content {
            position: relative;
            z-index: 2;
        }
        .login-left-content h2 { /* SELAMAT DATANG */
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            letter-spacing: 1px;
            border-left: 3px solid #0052cc; /* Aksen biru IMST */
            padding-left: 0.75rem;
        }
        .login-left-content h1 { /* Sistem Informasi... */
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1.3;
        }

        /* Kolom Kanan (Form) */
        .login-right-column {
            flex: 1; /* Ambil setengah lebar */
            padding: 2.5rem 3rem; /* Padding */
            display: flex;
            flex-direction: column;
            background-color: #fff; /* Pastikan background putih */
        }
        .login-logo {
            display: block;
            width: 150px; /* Sesuaikan ukuran */
            height: auto;
            margin: 0 auto 1.5rem auto; /* Logo di tengah atas */
        }
        .login-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #343a40;
            text-align: center;
            margin-bottom: 0.5rem;
        }
        .login-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            text-align: center;
            margin-bottom: 2rem;
            line-height: 1.5; /* Tambah line height jika teks panjang */
        }
        /* Style form dasar (konsisten) */
        .form-group { margin-bottom: 1.25rem; }
        .form-label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #495057; font-size: 0.85rem; }
        .form-input { width: 100%; padding: 0.75rem 1rem; border: 1px solid #ced4da; border-radius: 0.375rem; font-size: 0.9rem; background-color: #f8f9fa; transition: border-color 0.2s ease, box-shadow 0.2s ease; }
        .form-input:focus { outline: none; border-color: #007bff; box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25); background-color: #fff; }
        .form-checkbox-label { display: flex; align-items: center; font-size: 0.85rem; color: #495057; }
        .form-checkbox { margin-right: 0.5rem; }
        .form-button { width: 100%; padding: 0.8rem 1rem; background-color: #0052cc; color: white; border: none; border-radius: 0.375rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; transition: background-color 0.2s ease; margin-top: 1rem; }
        .form-button:hover { background-color: #0041a3; }
        .form-link { color: #007bff; text-decoration: none; font-size: 0.85rem; }
        .form-link:hover { text-decoration: underline; }
        .form-footer-text { margin-top: 1.5rem; text-align: center; font-size: 0.85rem; color: #6c757d; }
        .input-error { color: #dc3545; font-size: 0.8rem; margin-top: 0.25rem; }
        /* Hilangkan separator & google button jika tidak dipakai */
        /* .login-separator { ... } */
        /* .google-login-btn { ... } */
        .password-input-group { position: relative; }
        .password-toggle-icon { position: absolute; top: 50%; right: 1rem; transform: translateY(-50%); cursor: pointer; color: #6c757d; }
        .powered-by { text-align: center; font-size: 0.75rem; color: #adb5bd; margin-top: auto; padding-top: 1rem; }

        /* Responsif: Kolom menumpuk */
        @media (max-width: 768px) {
           body { padding: 0; align-items: stretch; }
           .login-card { flex-direction: column; max-width: 100%; border-radius: 0; box-shadow: none; min-height: 100vh;}
           .login-left-column { display: none; } /* Sembunyikan gambar */
           .login-right-column { padding: 2rem; justify-content: center; /* Center form vertikal */ }
           .login-logo { width: 120px; }
           .powered-by { margin-top: 2rem; } /* Beri jarak atas di mobile */
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased">

    

    
    <div class="login-card">

        
        <div class="login-left-column">
            <div class="login-left-content">
                <h2>SELAMAT DATANG</h2>
                <h1>Sistem Informasi<br>Manajemen Aset<br>PT. IMST</h1>
            </div>
        </div>

        
        <div class="login-right-column">
            
            <img src="<?php echo e(asset('logo-imst.png')); ?>" alt="PT. IMST Logo" class="login-logo">

            
            
            

            
            <?php echo e($slot); ?>


            <div class="powered-by">
                Powered by PT. INKA Multi Solusi Trading
            </div>
        </div>
    </div>

</body>
</html>
<?php /**PATH D:\xampp\htdocs\manajemen-aset\resources\views/layouts/guest.blade.php ENDPATH**/ ?>