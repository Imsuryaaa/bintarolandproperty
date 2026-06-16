<?php $__env->startSection('title', (isset($isHotsale) && $isHotsale ? 'Jual Properti Hotsale Pilihan di Bintaro' : 'Daftar Jual Rumah & Properti di Bintaro') . ' | Bintaro Land Property'); ?>
<?php $__env->startSection('meta_description', isset($isHotsale) && $isHotsale ? 'Daftar properti hotsale pilihan terbaik dari Bintaro Land Property dengan harga menarik di kawasan Bintaro.' : 'Temukan daftar lengkap jual rumah, kavling, dan properti komersial di Bintaro dan sekitarnya dengan harga terbaik oleh Bintaro Land Property.'); ?>

<?php $__env->startSection('content'); ?>


<section class="relative pt-[68px] overflow-hidden">

    
    <div class="absolute inset-0">
        <img src="<?php echo e(asset('unsplash_image/Halaman_Semua_Properti/a.webp')); ?>"
             alt="" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-charcoal-950/80"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/95 via-charcoal-950/85 to-charcoal-950/60"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950 via-charcoal-950/30 to-transparent"></div>
    </div>

    <div class="relative z-10 container-main py-14 lg:py-20">

        
        <nav class="flex items-center gap-2 text-xs text-gray-400 mb-6" aria-label="Breadcrumb">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-brand-400 transition-colors flex items-center gap-1">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Beranda
            </a>
            <svg class="w-3 h-3 text-gray-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-300 font-medium"><?php echo e(isset($isHotsale) && $isHotsale ? 'Properti Hotsale' : 'Semua Properti'); ?></span>
        </nav>

        <div class="max-w-2xl">
            <div class="flex items-center gap-2 mb-4">
                <?php if(isset($isHotsale) && $isHotsale): ?>
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-red-500 text-xs font-semibold tracking-[0.18em] uppercase">Rumah Pilihan</p>
                <?php else: ?>
                    <span class="inline-block w-8 h-px bg-brand-400"></span>
                    <p class="text-brand-300 text-xs font-semibold tracking-[0.18em] uppercase">Semua Listing</p>
                <?php endif; ?>
            </div>
            <?php if(isset($isHotsale) && $isHotsale): ?>
                <h1 class="font-serif text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                    Properti <span class="bg-clip-text text-transparent bg-gradient-to-r from-red-600 to-amber-500">Hotsale</span>
                </h1>
                <p class="text-gray-300 text-base leading-relaxed mb-6 max-w-lg">
                    Daftar properti rumah pilihan terbaik kami dengan harga menarik — 
                    <span class="text-brand-300 font-semibold"><?php echo e(number_format($totalCount)); ?> properti hotsale</span>
                    tersedia untuk Anda.
                </p>
            <?php else: ?>
                <h1 class="font-serif text-4xl lg:text-5xl font-extrabold text-white leading-tight mb-4">
                    Daftar <span class="text-brand-400">Properti</span>
                </h1>
                <p class="text-gray-300 text-base leading-relaxed mb-6 max-w-lg">
                    Temukan properti impian Anda dari koleksi lengkap kami —
                    <span class="text-brand-300 font-semibold"><?php echo e(number_format($totalCount)); ?> properti</span>
                    tersedia dari terbaru hingga terlama.
                </p>
            <?php endif; ?>

            
            <div class="flex items-center gap-5 text-sm">
                <div class="flex items-center gap-2 text-gray-300">
                    <div class="w-8 h-8 rounded-full bg-brand-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
                    <span><span class="text-white font-bold"><?php echo e(number_format($totalCount)); ?></span> Properti</span>
                </div>
                <div class="w-px h-5 bg-white/15"></div>
                <div class="flex items-center gap-2 text-gray-300">
                    <div class="w-8 h-8 rounded-full bg-emerald-500/20 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span>Diperbarui <span class="text-white font-bold">Hari ini</span></span>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
@media (max-width: 639px) {
    .mobile-search-wrapper {
        position: fixed;
        bottom: calc(56px + env(safe-area-inset-bottom));
        left: 0;
        right: 0;
        z-index: 40;
    }
}
</style>

<div x-data="{ open: false }" @click.outside="if (window.innerWidth < 640) open = false" class="mobile-search-wrapper sm:sticky sm:top-[68px] sm:z-30 bg-white/95 dark:bg-charcoal-950/95 sm:bg-white/90 sm:dark:bg-charcoal-950/90 sm:backdrop-blur-md border-t sm:border-t-0 sm:border-b border-gray-200 dark:border-charcoal-800 shadow-[0_-4px_10px_-1px_rgba(0,0,0,0.08)] sm:shadow-sm">
    
    <!-- Mobile toggle button -->
    <button @click="open = !open" type="button" class="sm:hidden w-full flex items-center justify-between px-5 py-3.5 bg-white dark:bg-charcoal-950 focus:outline-none active:bg-gray-50 dark:active:bg-charcoal-900 transition-colors">
        <div class="flex items-center gap-2 text-gray-900 dark:text-white">
            <svg class="w-4 h-4 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <span class="text-sm font-semibold">Cari & Filter Properti</span>
            <?php if(request('search') || request('category') || (request('sort') && request('sort') !== 'latest')): ?>
                <span class="w-2 h-2 rounded-full bg-red-500"></span>
            <?php endif; ?>
        </div>
        <svg :class="{'rotate-180': open}" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>
    
    <!-- Form container -->
    <div x-show="open" x-collapse.duration.300ms class="sm:!block sm:!h-auto absolute sm:static bottom-full left-0 w-full bg-white dark:bg-charcoal-950 sm:bg-transparent sm:dark:bg-transparent border-t border-gray-100 dark:border-charcoal-800 sm:border-0 shadow-[0_-15px_25px_-5px_rgba(0,0,0,0.1)] sm:shadow-none transition-all">
        <div class="container-main p-5 sm:p-0 sm:py-3">
            <?php
                $actionRoute = (isset($isHotsale) && $isHotsale) ? route('properties.hotsale') : route('properties.all');
            ?>
            <form action="<?php echo e($actionRoute); ?>" method="GET"
                  class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-2.5">

                
                <?php if(request('sort') && request('sort') !== 'latest'): ?>
                    <input type="hidden" name="sort" value="<?php echo e(request('sort')); ?>">
                <?php endif; ?>

                
                <div class="relative flex-1">
                    <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 dark:text-charcoal-500 pointer-events-none"
                         fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="search"
                           id="all-search-input"
                           value="<?php echo e(request('search')); ?>"
                           placeholder="Cari nama properti, lokasi, tipe…"
                           class="field pl-10 w-full text-sm">
                </div>

                
                <div class="sm:w-52">
                    <select name="category" class="field-select w-full text-sm cursor-pointer">
                        <option value="">Semua Lokasi / Tipe</option>
                        <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <optgroup label="<?php echo e($parent->name); ?>">
                                <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($child->id); ?>" <?php echo e(request('category') == $child->id ? 'selected' : ''); ?>>
                                        <?php echo e($child->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="sm:w-44">
                    <select name="sort" class="field-select w-full text-sm cursor-pointer">
                        <option value="latest"     <?php echo e($sort === 'latest'     ? 'selected' : ''); ?>>📅 Terbaru</option>
                        <option value="price_low"  <?php echo e($sort === 'price_low'  ? 'selected' : ''); ?>>💰 Harga Terendah</option>
                        <option value="price_high" <?php echo e($sort === 'price_high' ? 'selected' : ''); ?>>💎 Harga Tertinggi</option>
                    </select>
                </div>

                
                <button type="submit" class="btn-primary px-5 py-3 sm:py-2.5 text-sm shrink-0">Cari</button>

                
                <?php if(request('search') || request('category')): ?>
                    <a href="<?php echo e($actionRoute . '?' . http_build_query(request('sort') !== 'latest' ? ['sort' => request('sort')] : [])); ?>"
                       class="flex items-center justify-center gap-1 text-sm text-gray-400 dark:text-charcoal-500 hover:text-red-500 dark:hover:text-red-400 transition-colors px-2 py-2 sm:py-0 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        <span class="inline">Reset</span>
                    </a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>


<section class="py-10 lg:py-14 bg-white dark:bg-charcoal-950">
    <div class="container-main">

        
        <div id="all-props-content">
        <?php if($properties->count() > 0): ?>

            
            <div id="all-props-info" class="flex flex-wrap items-center justify-between gap-3 mb-7">
                <div class="flex flex-wrap items-center gap-2">
                    <p class="text-sm text-gray-500 dark:text-charcoal-400">
                        Menampilkan
                        <span class="text-brand-600 dark:text-brand-400 font-semibold"><?php echo e($properties->firstItem()); ?>–<?php echo e($properties->lastItem()); ?></span>
                        dari <span class="text-gray-900 dark:text-white font-semibold"><?php echo e(number_format($properties->total())); ?></span> properti
                    </p>

                    <?php if(request('search')): ?>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 text-xs rounded-full border border-brand-200 dark:border-brand-800">
                            "<?php echo e(request('search')); ?>"
                            <a href="<?php echo e($actionRoute . '?' . http_build_query(array_filter(array_merge(request()->only(['category','sort']), ['search'=>null])))); ?>"
                               class="hover:text-brand-900 ml-0.5 font-bold">×</a>
                        </span>
                    <?php endif; ?>
                </div>

                
                <?php if($properties->lastPage() > 1): ?>
                    <span class="text-xs text-gray-500 dark:text-gray-300 bg-gray-100 dark:bg-charcoal-800 border border-gray-200 dark:border-charcoal-700 px-3 py-1 rounded-full">
                        Halaman <?php echo e($properties->currentPage()); ?> / <?php echo e($properties->lastPage()); ?>

                    </span>
                <?php endif; ?>
            </div>

            
            <div id="all-props-grid"
                 class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-5 all-props-anim">
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('components.property-card', ['property' => $property], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div id="all-props-pag" class="mt-10">
                <?php echo e($properties->links('components.pagination')); ?>

            </div>

        <?php else: ?>
            
            <div class="text-center py-24 rounded-2xl border border-dashed border-gray-200 dark:border-charcoal-800">
                <div class="w-20 h-20 rounded-full bg-gray-100 dark:bg-charcoal-900 flex items-center justify-center mx-auto mb-5">
                    <svg class="w-9 h-9 text-gray-300 dark:text-charcoal-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Properti tidak ditemukan</h3>
                <p class="text-gray-400 dark:text-charcoal-500 text-sm mb-6 max-w-sm mx-auto">
                    Coba ubah kata kunci pencarian atau hapus filter yang aktif.
                </p>
                <a href="<?php echo e($actionRoute); ?>" class="btn-primary text-sm">Reset Filter</a>
            </div>
        <?php endif; ?>
        </div>

    </div>
</section>


<style>
.all-props-anim {
    animation: allPropsIn 0.42s cubic-bezier(0.4, 0, 0.2, 1) both;
}
@keyframes allPropsIn {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

<script>
(function () {
    /* ── AJAX Pagination ── */
    function loadPage(url) {
        var contentEl = document.getElementById('all-props-content');

        if (contentEl) {
            contentEl.style.transition = 'opacity 0.18s ease';
            contentEl.style.opacity    = '0.35';
        }

        fetch(url, { credentials: 'same-origin' })
            .then(function (res) {
                if (!res.ok) throw new Error('HTTP ' + res.status);
                return res.text();
            })
            .then(function (html) {
                var parser = new DOMParser();
                var newDoc = parser.parseFromString(html, 'text/html');

                var newContent = newDoc.getElementById('all-props-content');
                contentEl = document.getElementById('all-props-content');

                if (newContent && contentEl) {
                    // Replace the entire content block (info + grid + pagination)
                    contentEl.innerHTML = newContent.innerHTML;

                    // Make new cards visible — directly add 'card-visible' class
                    // since IntersectionObserver may not fire for elements already in viewport
                    contentEl.querySelectorAll('.prop-card').forEach(function(card, i) {
                        setTimeout(function() {
                            card.classList.add('card-visible');
                        }, i * 50); // stagger each card by 50ms
                    });

                    contentEl.style.opacity = '1';
                    history.pushState({ paginationHref: url }, '', url);

                    // Scroll to content area
                    if (contentEl) {
                        window.scrollTo({ top: contentEl.offsetTop - 140, behavior: 'smooth' });
                    }
                } else {
                    // Fallback: if parsing failed, do a regular navigation
                    window.location.href = url;
                }
            })
            .catch(function (err) {
                console.warn('Pagination fetch error:', err);
                // Fallback: navigate normally so the user still gets the page
                window.location.href = url;
            });
    }

    document.addEventListener('click', function (e) {
        var link = e.target.closest('a.page-btn');
        if (!link) return;

        var url = link.href;
        if (!url || url === '#') return;

        try {
            var u = new URL(url);
            url = window.location.origin + u.pathname + u.search;
        } catch (e2) { return; }

        e.preventDefault();
        e.stopPropagation();
        loadPage(url);
    });

    window.addEventListener('popstate', function (e) {
        if (e.state && e.state.paginationHref) {
            loadPage(e.state.paginationHref);
        }
    });
})();
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /media/mangsurr/Linux E/Gawe/Project/bintaroproperty/resources/views/properties/index.blade.php ENDPATH**/ ?>