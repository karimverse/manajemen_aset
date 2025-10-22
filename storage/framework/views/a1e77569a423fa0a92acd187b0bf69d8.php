<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <title>Manajemen Aset - IMST</title>
    <link rel="icon" href="<?php echo e(asset('logo-icon.png')); ?>" type="image/png">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

</head>
<body class="app-body">
    <div class="app-container">

        <header class="app-header">
            <div>
                
            </div>

            <div class="header-user" x-data="{ open: false }" @click.away="open = false">
                
                <div @click="open = !open" class="user-name-trigger">
                    <span><?php echo e(date('l, d/m/Y')); ?></span>
                    <span class="separator">|</span>
                    <span class="user-name">Hay, <strong><?php echo e(Auth::user()->name); ?></strong></span>
                </div>
                
                <div x-show="open"
                     x-transition
                     class="user-dropdown-menu-header" style="display: none;">
                     <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                         <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                         Profile
                     </a>
                     <form method="POST" action="<?php echo e(route('logout')); ?>"> <?php echo csrf_field(); ?>
                         <button type="submit" class="dropdown-item logout">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                             Log Out
                         </button>
                     </form>
                </div>
            </div>
        </header>

        <aside class="app-sidebar">

            <div class="sidebar-logo-container">
                <img src="<?php echo e(asset('logo-imst.png')); ?>" alt="PT. IMST Logo" class="logo-imst">
            </div>

            <div class="sidebar-user">
                <div class="user-avatar">
                    <?php echo e(substr(Auth::user()->name, 0, 2)); ?>

                </div>
                <div class="user-info">
                    <h4><?php echo e(Auth::user()->name); ?></h4>
                    <p>Online</p>
                </div>
            </div>

            <ul class="sidebar-nav">
                <li>
                    <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" title="Dashboard">
                        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid-1x2-fill" viewBox="0 0 16 16">
                          <path d="M0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1zm0 7a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1z"/>
                        </svg>
                        <span class="menu-text">DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('assets.index')); ?>" class="<?php echo e(request()->routeIs('assets.*') ? 'active' : ''); ?>" title="Aset">
                        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                          <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.75.073a.75.75 0 0 1 .5-.001zM10.414 4H5.586L2.624 5.378A.75.75 0 0 0 2 6.13v4.139l3.586 1.434h4.828L14 10.27v-4.14a.75.75 0 0 0-.624-.752z"/>
                        </svg>
                        <span class="menu-text">ASET</span>
                    </a>
                </li>
                 <li>
                     <a href="<?php echo e(route('categories.index')); ?>" class="<?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>" title="Kategori">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                           <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                         </svg>
                         <span class="menu-text">KATEGORI</span>
                     </a>
                </li>
                <li>
                     <a href="<?php echo e(route('locations.index')); ?>" class="<?php echo e(request()->routeIs('locations.*') ? 'active' : ''); ?>" title="Lokasi">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                           <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                         </svg>
                         <span class="menu-text">LOKASI</span>
                     </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="logout-btn" title="Keluar Aplikasi">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                             <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2.146a.5.5 0 0 1-1 0V4.5a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2.146a.5.5 0 0 1 1 0z"/>
                             <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                         </svg>
                         <span class="menu-text">KELUAR APLIKASI</span>
                    </button>
                </form>
            </div>

        </aside>

        <main class="app-content">
            <?php echo e($slot); ?>

        </main>

    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\manajemen-aset\resources\views/layouts/app.blade.php ENDPATH**/ ?>