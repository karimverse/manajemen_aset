<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Alpine.js tidak diperlukan lagi untuk layout ini --}}

</head>
{{-- Hapus x-data dari body --}}
<body class="app-body">
    <div class="app-container">

        <header class="app-header">
            <div>
                {{-- Kosongkan div kiri header --}}
            </div>

            <div class="header-user" x-data="{ open: false }" @click.away="open = false">
                {{-- Memindahkan semua konten ke dalam user-name-trigger untuk display flex --}}
                <div @click="open = !open" class="user-name-trigger">
                    <span>{{ date('l, d/m/Y') }}</span>
                    <span class="separator">|</span> {{-- Tambahkan separator dengan class khusus --}}
                    <span class="user-name">Hay, <strong>{{ Auth::user()->name }}</strong></span> {{-- Gunakan <strong> untuk membuat nama user tebal --}}
                </div>
                <div x-show="open"
                    x-transition
                    class="user-dropdown-menu-header" style="display: none;">
                    {{-- ... dropdown items ... --}}
                </div>
                <div x-show="open"
                     x-transition
                     class="user-dropdown-menu-header" style="display: none;">
                     <a href="{{ route('profile.edit') }}" class="dropdown-item">
                         <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                         Profile
                     </a>
                     <form method="POST" action="{{ route('logout') }}"> @csrf
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
                <img src="{{ asset('logo-imst.png') }}" alt="PT. IMST Logo" class="logo-imst">
            </div>

            <div class="sidebar-user">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div class="user-avatar">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    {{-- Hapus x-show dari user-info --}}
                    <div class="user-info">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p>Online</p>
                    </div>
                </div>
                {{-- Tombol toggle dihapus --}}
            </div>

            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" title="Dashboard">
                        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M4 11H1v3h3zm5-4H6v7h3zm5-5H11v11h3zM1 1a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1z"/></svg>
                        <span class="menu-text">DASHBOARD</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('assets.index') }}" class="{{ request()->routeIs('assets.*') ? 'active' : '' }}" title="Aset">
                        <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5zM5 3h-.5a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5H5zM.5 3h-.5A1.5 1.5 0 0 0 0 4.5v7A1.5 1.5 0 0 0 1.5 13h1A1.5 1.5 0 0 0 4 11.5v-7A1.5 1.5 0 0 0 2.5 3h-1A1.5 1.5 0 0 0 .5 3"/></svg>
                        <span class="menu-text">ASET</span>
                    </a>
                </li>
                 <li>
                     <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}" title="Kategori">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2zm6-8a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2zm0 8a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                         <span class="menu-text">KATEGORI</span>
                     </a>
                </li>
                <li>
                     <a href="{{ route('locations.index') }}" class="{{ request()->routeIs('locations.*') ? 'active' : '' }}" title="Lokasi">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/></svg>
                         <span class="menu-text">LOKASI</span>
                     </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn" title="Keluar Aplikasi">
                         <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2.146a.5.5 0 0 1-1 0V4.5a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2.146a.5.5 0 0 1 1 0z"/><path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/></svg>
                         <span class="menu-text">KELUAR APLIKASI</span>
                    </button>
                </form>
            </div>

        </aside>

        <main class="app-content">
            {{ $slot }}
        </main>

    </div>

    @stack('scripts')
</body>
</html>
