<?php $__env->startSection('title', 'Kelola Properti'); ?>
<?php $__env->startSection('page-title', 'Kelola Properti'); ?>

<?php $__env->startSection('content'); ?>


<div class="flex flex-col md:flex-row md:items-center justify-end gap-4 mb-6">
    <a href="<?php echo e(route('admin.properties.create')); ?>" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg transition-colors duration-200 whitespace-nowrap w-full sm:w-auto">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Properti
    </a>
</div>


<div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm" id="propTableRoot">

    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3 border-b border-gray-100 dark:border-gray-800/60">
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
            <span>Tampilkan</span>
            <select id="ptPerPage" class="ct-select">
                <option value="10">10</option>
                <option value="15" selected>15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="-1">Semua</option>
            </select>
            <span>baris</span>
        </div>
        <div class="relative w-full sm:w-auto">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="ptSearch" placeholder="Cari properti..." class="ct-search-input">
        </div>
    </div>

    
    <div class="overflow-x-auto" style="touch-action:pan-x pan-y;-webkit-overflow-scrolling:touch;">
        <table class="w-full text-sm min-w-[900px]">
            <thead>
                <tr class="border-b border-gray-200 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-800/30">
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Kode Agen</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider min-w-[250px]">Properti</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Harga</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Tipe Iklan</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Spesifikasi</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider min-w-[130px]">Kategori</th>
                    <th class="text-left px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Status</th>
                    <th class="text-right px-5 py-3 text-xs font-semibold text-gray-500 dark:text-gray-300 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody id="ptBody" class="divide-y divide-gray-100 dark:divide-gray-800">
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="ct-row hover:bg-amber-50/40 dark:hover:bg-amber-900/10 transition-colors duration-150"
                    data-search="<?php echo e(strtolower($property->property_code . ' ' . $property->title . ' ' . $property->full_location . ' ' . $property->formatted_price)); ?>">
                    <td class="px-5 py-4">
                        <span class="inline-block px-2 py-1 text-xs font-bold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-800 rounded"><?php echo e($property->property_code); ?></span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <img src="<?php echo e($property->image_url); ?>" alt="<?php echo e($property->title); ?>"
                                 width="40" height="40" loading="lazy" decoding="async"
                                 class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700"
                                 onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=80&q=60'">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e(Str::limit($property->title, 40)); ?></p>
                                <p class="text-xs text-gray-400 mt-0.5"><?php echo e($property->full_location); ?></p>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <span class="font-semibold text-gray-800 dark:text-gray-200 text-sm"><?php echo e($property->formatted_price); ?></span>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap">
                        <?php if(($property->listing_type ?? 'dijual') === 'disewa'): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-white rounded-md" style="background-color:#ea580c;">
                                🔑 Sewa
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-white rounded-md" style="background-color:#0891b2;">
                                🏷️ Jual
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs space-y-0.5">
                        <div><?php echo e($property->bedrooms); ?> KT · <?php echo e($property->bathrooms); ?> KM</div>
                        <div>LT <?php echo e($property->formatted_land_area); ?></div>
                    </td>
                    <td class="px-5 py-4 min-w-[130px]">
                        <div class="flex flex-wrap gap-1">
                            <?php $__currentLoopData = $property->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 rounded-md"><?php echo e($cat->name); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <?php if($property->is_featured): ?>
                            <span class="inline-block px-2 py-0.5 text-xs bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-md font-medium">Hotsale</span>
                        <?php else: ?>
                            <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-500 rounded-md">Biasa</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo e(route('property.show', $property)); ?>" target="_blank"
                               class="p-2 rounded-md bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:hover:bg-blue-900/40 transition-all shadow-sm"
                               title="Lihat di website">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            <a href="<?php echo e(route('admin.properties.edit', $property)); ?>"
                               class="p-2 rounded-md bg-amber-50 text-amber-600 hover:bg-amber-100 dark:bg-amber-900/20 dark:text-amber-400 dark:hover:bg-amber-900/40 transition-all shadow-sm"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.properties.destroy', $property)); ?>" onsubmit="return confirm('Hapus properti ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="p-2 rounded-md bg-red-50 text-red-600 hover:bg-red-100 dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/40 transition-all shadow-sm"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3 border-t border-gray-100 dark:border-gray-800">
        <p id="ptInfo" class="text-xs text-gray-500 dark:text-gray-400"></p>
        <div id="ptPagination" class="flex items-center flex-wrap gap-1"></div>
    </div>
</div>


<style>
    .ct-search-input {
        width: 100%;
        padding: 0.5rem 0.75rem 0.5rem 2.25rem;
        border: 1px solid #e5e7eb;
        border-radius: 9999px;
        background: #f9fafb;
        color: #111827;
        font-size: 0.8125rem;
        outline: none;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .ct-search-input:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
        background: #fff;
    }
    .dark .ct-search-input {
        background: #1f2937;
        border-color: #374151;
        color: #f3f4f6;
    }
    .dark .ct-search-input:focus {
        background: #111827;
        border-color: #f59e0b;
    }
    @media (min-width: 640px) {
        .ct-search-input { width: 240px; }
        .ct-search-input:focus { width: 300px; }
    }
    .ct-select {
        padding: 0.25rem 1.75rem 0.25rem 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        background: #f9fafb url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E") no-repeat right 0.35rem center / 0.875rem;
        appearance: none;
        font-size: 0.8125rem;
        color: #111827;
        outline: none;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .ct-select:focus { border-color: #f59e0b; }
    .dark .ct-select { background-color: #1f2937; border-color: #374151; color: #f3f4f6; }
    .ct-page-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
        padding: 0 0.5rem;
        border: 1px solid #e5e7eb;
        border-radius: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        color: #6b7280;
        background: #fff;
        cursor: pointer;
        transition: all 0.15s;
        user-select: none;
    }
    .ct-page-btn:hover:not(.active):not(.disabled) { background: #fffbeb; color: #d97706; border-color: #fcd34d; }
    .ct-page-btn.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
    .ct-page-btn.disabled { opacity: 0.4; cursor: default; pointer-events: none; }
    .dark .ct-page-btn { background: #1f2937; border-color: #374151; color: #9ca3af; }
    .dark .ct-page-btn:hover:not(.active):not(.disabled) { background: #374151; color: #fcd34d; }
    .dark .ct-page-btn.active { background: #f59e0b; color: #fff; border-color: #f59e0b; }
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
    var allRows  = Array.from(document.querySelectorAll('#ptBody .ct-row'));
    var filtered = allRows.slice();
    var page     = 1;
    var perPage  = 15;

    var searchEl  = document.getElementById('ptSearch');
    var perPageEl = document.getElementById('ptPerPage');
    var infoEl    = document.getElementById('ptInfo');
    var pagEl     = document.getElementById('ptPagination');

    function applyFilter() {
        var q = searchEl.value.trim().toLowerCase();
        filtered = q
            ? allRows.filter(function (r) { return r.dataset.search.indexOf(q) !== -1; })
            : allRows.slice();
        page = 1;
        render();
    }

    function render() {
        var total = filtered.length;
        var pp    = perPage < 0 ? total : perPage;
        var pages = Math.max(1, Math.ceil(total / pp));
        if (page > pages) page = pages;
        var start = (page - 1) * pp;
        var end   = perPage < 0 ? total : Math.min(start + pp, total);

        // hide all, show filtered slice
        allRows.forEach(function (r) { r.style.display = 'none'; });
        for (var i = start; i < end; i++) filtered[i].style.display = '';

        // info
        infoEl.textContent = total === 0
            ? 'Tidak ada data'
            : 'Menampilkan ' + (start + 1) + '–' + end + ' dari ' + total + ' baris';

        // pagination
        pagEl.innerHTML = '';
        if (pages <= 1) return;

        addBtn('‹', page > 1 ? page - 1 : 0, page <= 1);
        for (var p = 1; p <= pages; p++) {
            if (pages > 7 && p > 2 && p < pages - 1 && Math.abs(p - page) > 1) {
                if (p === 3 || p === pages - 2) {
                    var dots = document.createElement('span');
                    dots.className = 'ct-page-btn disabled';
                    dots.textContent = '…';
                    pagEl.appendChild(dots);
                }
                continue;
            }
            addBtn(p, p, false, p === page);
        }
        addBtn('›', page < pages ? page + 1 : 0, page >= pages);
    }

    function addBtn(label, target, disabled, active) {
        var btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'ct-page-btn' + (active ? ' active' : '') + (disabled ? ' disabled' : '');
        btn.textContent = label;
        if (target && !disabled) {
            btn.addEventListener('click', function () { page = target; render(); });
        }
        pagEl.appendChild(btn);
    }

    searchEl.addEventListener('input', applyFilter);
    perPageEl.addEventListener('change', function () {
        perPage = parseInt(this.value);
        page = 1;
        render();
    });

    render();
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Gawe\website landing page\bintaro-propertyv2\resources\views/admin/properties/index.blade.php ENDPATH**/ ?>