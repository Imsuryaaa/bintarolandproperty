<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> — Bintaro Land Property</title>
    <link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <?php if(isset($useDataTables) && $useDataTables): ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.css">
    <?php endif; ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        /* SortableJS drag-and-drop visual states */
        .sortable-ghost   { opacity: .35; outline: 2px solid #f59e0b; outline-offset: 2px; }
        .sortable-chosen  { outline: 2px solid #f59e0b; outline-offset: 2px; }
        .sortable-drag    { box-shadow: 0 20px 40px rgba(0,0,0,.35); transform: rotate(1.5deg) scale(1.04); opacity: .95; }

        /* DataTables: batasi ukuran thumbnail agar baris tidak terlalu tinggi */
        table.dataTable td img { max-width: 48px !important; max-height: 48px !important; object-fit: cover; border-radius: 6px; }

        /* Responsive: sembunyikan kolom kurang penting di mobile */
        @media (max-width: 640px) {
            .dt-hide-mobile { display: none !important; }
        }

        /* ── DataTables Theme & Mobile Fixes ── */
        .dt-container { font-size: 0.875rem; }
        
        /* Modern Search Input (Pill shape + Icon) */
        .dt-container input[type="search"] {
            border: 1px solid #e5e7eb;
            border-radius: 9999px; /* Pill shape */
            padding: 0.5rem 1rem 0.5rem 2.5rem; /* Room for icon */
            background-color: #f9fafb;
            color: #111827;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 0.75rem center;
            background-size: 1.125rem;
            width: 220px;
        }
        .dt-container input[type="search"]:focus {
            background-color: #ffffff;
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1) !important;
            width: 280px;
        }
        .dark .dt-container input[type="search"] {
            background-color: #1f2937;
            border-color: #374151;
            color: #f3f4f6;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'%3E%3C/path%3E%3C/svg%3E");
        }
        .dark .dt-container input[type="search"]:focus {
            background-color: #111827;
            border-color: #f59e0b !important;
        }

        /* Modern Select Dropdown */
        .dt-container select {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.375rem 2rem 0.375rem 0.75rem;
            background-color: #f9fafb;
            color: #111827;
            outline: none;
            cursor: pointer;
            transition: all 0.2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.5rem center;
            background-size: 1rem;
        }
        .dt-container select:focus {
            border-color: #f59e0b !important;
            box-shadow: 0 0 0 2px rgba(245, 158, 11, 0.2) !important;
        }
        .dark .dt-container select {
            background-color: #1f2937;
            border-color: #374151;
            color: #f3f4f6;
        }
        .dark .dt-container select:focus {
            border-color: #f59e0b !important;
        }

        /* Pagination Theme (Amber) */
        .dt-paging nav, .dt-paging .pagination { display: flex; flex-wrap: wrap; justify-content: center; gap: 4px; }
        .dt-paging .page-link, .dt-paging-button {
            padding: 0.375rem 0.75rem;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            color: #374151;
            border-radius: 0.375rem;
            transition: all 0.2s;
            cursor: pointer;
        }
        .dt-paging .page-item.active .page-link, .dt-paging-button.current {
            background: #f59e0b !important;
            border-color: #f59e0b !important;
            color: #ffffff !important;
        }
        .dt-paging .page-item:not(.active):not(.disabled) .page-link:hover, .dt-paging-button:not(.current):not(.disabled):hover {
            background: #fffbeb;
            color: #d97706;
            border-color: #fcd34d;
        }
        .dark .dt-paging .page-link, .dark .dt-paging-button {
            background: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }
        .dark .dt-paging .page-item:not(.active):not(.disabled) .page-link:hover, .dark .dt-paging-button:not(.current):not(.disabled):hover {
            background: #374151;
            color: #fcd34d;
            border-color: #4b5563;
        }

        /* Desktop Alignment Fixes for Controls */
        .dt-container .dt-length label,
        .dt-container .dt-search label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            white-space: nowrap;
        }
        .dt-container > .dt-layout-row:first-child,
        .dt-container > .dt-layout-row:last-child {
            display: flex !important;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        .dt-container > .dt-layout-row:last-child {
            margin-bottom: 0;
            margin-top: 1rem;
        }
        .dt-container > .dt-layout-row:not(:first-child):not(:last-child) {
            display: block !important;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            touch-action: pan-y !important;
            overscroll-behavior-x: contain;
        }
        
        /* Mobile Layout Stack */
        @media (max-width: 640px) {
            .dt-container > .dt-layout-row:first-child,
            .dt-container > .dt-layout-row:last-child {
                flex-direction: column !important;
                align-items: flex-start !important;
            }
            .dt-container > .dt-layout-row:last-child {
                align-items: center !important;
            }
            .dt-container .dt-search, 
            .dt-container .dt-length {
                width: 100%;
                text-align: left !important;
            }
            .dt-container input[type="search"] {
                width: 100%;
                display: block;
                margin-left: 0 !important;
                margin-top: 0.375rem;
            }
            .dt-container input[type="search"]:focus {
                width: 100%;
            }
            .dt-container select {
                width: 100%;
                display: block;
                margin-left: 0 !important;
                margin-top: 0.375rem;
            }
        }
    </style>

    <!-- Dark mode: must run BEFORE stylesheets to prevent flash -->
    <script>
        (function () {
            var s = localStorage.getItem('theme');
            if (s === 'dark') document.documentElement.classList.add('dark');
        })();
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen">

    <!-- Sidebar + Main Wrapper -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-60 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <!-- Logo -->
            <div class="flex items-center gap-3 px-5 py-4 border-b border-gray-200 dark:border-gray-800">
                <img src="<?php echo e(asset('images/logo.jpg')); ?>" alt="Logo" class="h-9 w-auto rounded-md">
                <div>
                    <div class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Bintaro Land</div>
                    <div class="text-[10px] text-gray-400 uppercase tracking-widest">Admin Panel</div>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-3 py-4 space-y-1">
                <a href="<?php echo e(route('admin.dashboard')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2V7zM13 7a2 2 0 012-2h4a2 2 0 012 2v4a2 2 0 01-2 2h-4a2 2 0 01-2-2V7zM3 17a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2zM13 17a2 2 0 012-2h4a2 2 0 012 2v2a2 2 0 01-2 2h-4a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Dashboard
                </a>
                <a href="<?php echo e(route('admin.properties.index')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.properties.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Properti
                </a>
                <a href="<?php echo e(route('admin.promos.index')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.promos.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    Promo Banner
                </a>

                <a href="<?php echo e(route('admin.kpr-promos.index')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.kpr-promos.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                    Promo KPR
                </a>

                <?php if(session('admin_role') === 'super-admin'): ?>
                <a href="<?php echo e(route('admin.admins.index')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium <?php echo e(request()->routeIs('admin.admins.*') ? 'bg-amber-50 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-200">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    Manajemen Admin
                </a>
                <?php endif; ?>
            </nav>

            <!-- Bottom: Back to site -->
            <div class="px-3 py-4 border-t border-gray-200 dark:border-gray-800">
                <a href="<?php echo e(route('home')); ?>"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-50 dark:hover:bg-gray-800 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Ke Website
                </a>
            </div>
        </aside>

        <!-- Overlay for mobile sidebar -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content Area -->
        <div class="flex-1 min-w-0 lg:pl-60 flex flex-col min-h-screen">

            <!-- Top Bar -->
            <header class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-4 lg:px-6 py-3 flex items-center justify-between sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    <!-- Mobile menu toggle -->
                    <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-base font-semibold text-gray-800 dark:text-gray-200"><?php echo $__env->yieldContent('page-title', 'Admin'); ?></h1>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Admin Name -->
                    <?php if(session('admin_name')): ?>
                    <div class="hidden md:flex items-center gap-2 text-sm font-medium text-gray-600 dark:text-gray-300 border-r border-gray-200 dark:border-gray-700 pr-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <?php echo e(session('admin_name')); ?>

                    </div>
                    <?php endif; ?>

                    <!-- Dark Mode Toggle -->
                    <button id="theme-toggle" type="button"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all"
                        aria-label="Toggle Dark Mode">
                        <svg id="theme-toggle-dark-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 24.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <!-- Logout -->
                    <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit"
                                class="flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-red-600 dark:hover:text-red-400 border border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-700 rounded-lg transition-all duration-200"
                                title="Logout">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 min-w-0 p-4 lg:p-6">

                
                <?php if(session('success')): ?>
                    <div class="mb-5 flex items-center gap-3 px-4 py-3 rounded-lg bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-5 flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-300 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

    
    <?php if(isset($useDataTables) && $useDataTables): ?>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Ambil semua tabel yang ditandai data-datatable
        document.querySelectorAll('[data-datatable]').forEach(function (table) {
            if (!window.jQuery || !$.fn.DataTable) return;

            var opts = {
                /* ── Performance ── */
                deferRender:   true,    // Render DOM baris hanya saat dibutuhkan
                autoWidth:     false,   // Matikan auto-width: eliminasi layout thrashing
                processing:    false,   // Tidak perlu spinner; data sudah di DOM

                /* ── UX ── */
                pageLength:    15,      // Baris per halaman: lebih sedikit = lebih ringan
                lengthMenu:    [[10, 15, 25, 50, -1], [10, 15, 25, 50, 'Semua']],
                language: {
                    search:      '',
                    searchPlaceholder: 'Cari properti...',
                    lengthMenu:  'Tampilkan _MENU_ baris',
                    info:        'Menampilkan _START_–_END_ dari _TOTAL_ baris',
                    infoEmpty:   'Tidak ada data',
                    paginate: { first:'«', previous:'‹', next:'›', last:'»' },
                    zeroRecords: 'Data tidak ditemukan',
                    emptyTable:  'Tidak ada data tersedia'
                },

                /* ── Native scroll wrapper will handle overflow, disable DataTables split-table scrollX to fix header misalignment ── */
                scrollX:       false,
                scrollCollapse: false,

                /* ── Column ordering bawaan: kolom pertama descending ── */
                order: [[0, 'desc']],

                /* ── Sembunyikan kolom yang ditandai dt-hide-mobile di mobile ── */
                columnDefs: [
                    {
                        targets:   table.querySelectorAll('th.dt-hide-mobile').length > 0
                                       ? Array.from(table.querySelectorAll('th')).reduce(function(acc,th,i){
                                           if(th.classList.contains('dt-hide-mobile')) acc.push(i);
                                           return acc;
                                       },[])
                                       : [],
                        className: 'dt-hide-mobile'
                    },
                    /* Jangan sort kolom aksi (kolom terakhir biasanya) */
                    { targets: -1, orderable: false }
                ],

                /* ── Gambar/thumbnail: set max-height via initComplete ── */
                initComplete: function () {
                    /* Batasi ukuran semua img di dalam tabel */
                    this.api().rows().nodes().to$().find('img').css({
                        'max-width':  '48px',
                        'max-height': '48px',
                        'object-fit': 'cover',
                        'border-radius': '6px'
                    });
                }
            };

            // Merge opsi custom dari data attribute jika ada
            try {
                var custom = JSON.parse(table.dataset.datatableOpts || '{}');
                Object.assign(opts, custom);
            } catch(e) {}

            $(table).DataTable(opts);
        });
    });
    </script>
    <?php endif; ?>
</body>
</html>
<?php /**PATH /home/u851258633/domains/bintarolandproperty.com/public_html/resources/views/layouts/admin.blade.php ENDPATH**/ ?>