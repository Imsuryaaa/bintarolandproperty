<?php $__env->startSection('title', isset($category)
    ? "Jual Properti {$category->name} di Bintaro & Sekitarnya | Bintaro Land Property"
    : 'Jual Rumah di Bintaro & Sekitarnya - Harga Terbaik | Bintaro Land Property'); ?>

<?php $__env->startSection('meta_description', isset($category)
    ? "Cari dan temukan rumah, ruko, atau kavling terbaik di {$category->name} bersama Bintaro Land Property. Dapatkan harga dan penawaran properti eksklusif hari ini."
    : 'Bintaro Land Property adalah spesialis agen properti di Bintaro. Temukan daftar jual rumah di Bintaro, kavling strategis, dan investasi properti terbaik.'); ?>

<?php $__env->startSection('head'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "RealEstateAgent",
  "name": "Bintaro Land Property",
  "image": "<?php echo e(asset('images/logo.jpg')); ?>",
  "@id": "<?php echo e(url('/')); ?>",
  "url": "<?php echo e(url('/')); ?>",
  "telephone": "<?php echo e(env('WHATSAPP_NUMBER', '6281234567890')); ?>",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "Bintaro",
    "addressRegion": "Banten",
    "addressCountry": "ID"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": -6.2828,
    "longitude": 106.7114
  },
  "priceRange": "$$$"
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $requestCategory = request('category');
    $categoryName = null;
    $categorySlug = null;
    
    $groups = [
        'primary' => 'Primary Bintaro Jaya',
        'secondary' => 'Secondary Bintaro Jaya',
        'luar_bintaro' => 'Diluar Bintaro'
    ];

    if (isset($category)) {
        $categoryName = $category->name;
        $categorySlug = $category->slug;
    } elseif (is_string($requestCategory) && isset($groups[$requestCategory])) {
        $categorySlug = $requestCategory;
        $categoryName = $groups[$requestCategory];
    } elseif (is_object($requestCategory)) {
        $categoryName = $requestCategory->name;
        $categorySlug = $requestCategory->slug;
    } elseif ($requestCategory !== null && $requestCategory !== '') {
        $categorySlug = $requestCategory;
        if (is_numeric($requestCategory)) {
            $foundCat = $categories->firstWhere('id', (int) $requestCategory);
        } else {
            $foundCat = $categories->firstWhere('slug', $requestCategory);
        }
        
        if ($foundCat) {
            $categoryName = $foundCat->name;
        }
    }
    $hasCategory = !empty($categorySlug);
?>




<section class="relative pt-16 lg:pt-[68px] overflow-hidden min-h-[72vh] flex items-end">

    
    <div class="absolute inset-0">
        <picture>
            <source
                srcset="<?php echo e(asset('unsplash_image/HalamanHome/Properti_Bintaro.webp')); ?>"
                type="image/webp">
            <img src="<?php echo e(asset('unsplash_image/HalamanHome/Properti_Bintaro.webp')); ?>"
                 alt="Properti Bintaro"
                 width="1920" height="1080"
                 fetchpriority="high"
                 loading="eager"
                 decoding="async"
                 sizes="100vw"
                 class="w-full h-full object-cover object-center">
        </picture>
        <div class="absolute inset-0 bg-gradient-to-r from-charcoal-950/90 via-charcoal-950/65 to-charcoal-950/20"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-charcoal-950/80 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 container-main pb-12 pt-20 lg:pb-16 lg:pt-24 w-full">
        <div class="max-w-2xl">

            
            <div class="flex items-center gap-2 mb-5">
                <span class="inline-block w-8 h-px bg-brand-400"></span>
                <p class="text-brand-300 text-xs font-semibold tracking-[0.18em] uppercase">
                    <?php if(isset($category)): ?>
                        Kategori: <?php echo e($category->name); ?>

                    <?php else: ?>
                        Agen Properti Terpercaya · Bintaro & Sekitarnya
                    <?php endif; ?>
                </p>
            </div>

            
            <h1 class="font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-[1.15] mb-5" data-reveal>
                <?php if(isset($category)): ?>
                    Jual Properti <span class="text-brand-400"><?php echo e($category->name); ?></span><br>
                    Pilihan Terbaik
                <?php else: ?>
                    Jual Rumah & Hunian Premium di Bintaro<br>
                    <span class="text-brand-400">untuk Keluarga Modern</span>
                <?php endif; ?>
            </h1>

            <p class="text-gray-300 text-base leading-relaxed mb-6 max-w-xl" data-reveal data-reveal-delay="1">
                <?php if(isset($category)): ?>
                    Temukan pilihan properti terbaik kategori <?php echo e($category->name); ?> yang sesuai kebutuhan dan anggaran Anda.
                <?php else: ?>
                    Kami membantu Anda menemukan rumah, kavling, dan properti investasi yang tepat — dengan pelayanan profesional dan jujur.
                <?php endif; ?>
            </p>

            <div class="mb-8" data-reveal data-reveal-delay="2">
                <a href="<?php echo e(route('about')); ?>" class="inline-block px-8 py-3 border-2 border-white/50 hover:border-white/80 text-white text-base font-medium rounded-md transition-all duration-300 hover:-translate-y-1 hover:shadow-lg hover:shadow-white/10">
                    Tentang Kami
                </a>
            </div>

            
            <?php if(!isset($category)): ?>
            <div class="hidden md:flex flex-wrap items-center gap-4 sm:gap-6 text-sm text-gray-300" data-reveal data-reveal-delay="3">
                <div>
                    <span class="text-white font-bold text-xl">1.200+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Properti Tersedia</span>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <span class="text-white font-bold text-xl">5+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Tahun Pengalaman</span>
                </div>
                <div class="w-px h-8 bg-white/20"></div>
                <div>
                    <span class="text-white font-bold text-xl">500+</span>
                    <span class="block text-xs text-gray-400 mt-0.5">Keluarga Puas</span>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>




<section id="search-section"
         class="bg-white dark:bg-charcoal-950 border-b border-gray-200 dark:border-charcoal-800 sticky top-16 lg:top-[68px] z-30">
    <div class="container-main">

        
        <div class="hidden lg:block">
            <button type="button" id="search-toggle"
                    class="flex items-center gap-2.5 w-full py-2.5 text-left group">
            <svg class="w-4 h-4 text-gray-400 group-hover:text-brand-500 transition-colors flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <span id="search-summary" class="flex-1 text-sm text-gray-400 dark:text-charcoal-400 truncate">
                <?php if(request('search') || $hasCategory): ?>
                    Filter aktif: <?php echo e(implode(', ', array_filter([
                        request('search'),
                        $categoryName ?: $categorySlug
                    ]))); ?>

                <?php else: ?>
                    Cari nama, lokasi, atau tipe properti…
                <?php endif; ?>
            </span>
            <span class="text-xs text-brand-600 dark:text-brand-400 font-medium flex-shrink-0 flex items-center gap-1">
                Filter
                <svg id="search-chevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                </svg>
            </span>
        </button>

        <div id="search-panel"
             class="transition-all duration-300 ease-in-out"
             style="max-height: 0; overflow: hidden;">
            <form action="<?php echo e(route('search')); ?>" method="POST" id="search-form" class="relative">
                <?php echo csrf_field(); ?>
                <div class="flex flex-col sm:flex-row gap-2 pb-3 pt-1">

                    
                    <div class="relative flex-1">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search"
                               id="search-input"
                               value="<?php echo e(request('search')); ?>"
                               placeholder="Cari nama, lokasi…"
                               class="field pl-9 w-full text-sm">
                    </div>

                    
                    <div class="sm:w-56 relative">
                        <input type="hidden" name="category" id="category-input" value="<?php echo e($categorySlug); ?>">
                        <button type="button" id="mega-menu-btn" class="field-select w-full text-sm text-left flex justify-between items-center cursor-pointer hover:border-brand-300 dark:hover:border-brand-400 transition-colors">
                            <span id="mega-menu-label" class="truncate font-medium text-gray-700 dark:text-gray-200"><?php echo e($categoryName ?: 'Semua Lokasi / Tipe'); ?></span>
                            <svg class="w-4 h-4 ml-2 flex-shrink-0 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                    </div>

                    
                    <div class="sm:w-40">
                        <select name="sort" class="field-select w-full text-sm">
                            <option value="latest"     <?php echo e(request('sort','latest') === 'latest'     ? 'selected' : ''); ?>>Terbaru</option>
                            <option value="price_low"  <?php echo e(request('sort') === 'price_low'  ? 'selected' : ''); ?>>Harga Terendah</option>
                            <option value="price_high" <?php echo e(request('sort') === 'price_high' ? 'selected' : ''); ?>>Harga Tertinggi</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-primary px-5 shrink-0 text-sm">Cari</button>
                </div>

                
                <div id="mega-menu-panel" class="hidden absolute top-[calc(100%-8px)] left-0 right-0 bg-white dark:bg-charcoal-900 border border-gray-200 dark:border-charcoal-800 shadow-2xl rounded-xl p-6 z-[60]" style="max-height: 60vh; overflow-y: auto; overscroll-behavior: contain;">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <?php $__currentLoopData = $parentCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <h3 class="text-brand-800 dark:text-brand-400 font-bold text-sm uppercase tracking-wider border-b border-gray-100 dark:border-charcoal-800 pb-2 mb-3 cursor-pointer hover:text-brand-600 dark:hover:text-brand-300 transition-colors" 
                                    onclick="selectCategory('<?php echo e($parent->group_type); ?>', 'Semua <?php echo e($parent->name); ?>')">
                                    <?php echo e($parent->name); ?>

                                </h3>
                                <ul class="space-y-1.5 text-sm">
                                    <?php $__currentLoopData = $parent->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <a href="#" onclick="selectCategory('<?php echo e($child->id); ?>', '<?php echo e($child->name); ?>'); return false;" 
                                               class="text-gray-600 dark:text-gray-300 hover:text-brand-600 dark:hover:text-brand-400 hover:bg-brand-50 dark:hover:bg-charcoal-800 px-2 py-1.5 -mx-2 rounded-md flex items-center gap-2 transition-colors">
                                                <span class="w-1 h-1 rounded-full bg-gray-400 dark:bg-gray-600"></span>
                                                <?php echo e($child->name); ?>

                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="border-t border-gray-100 dark:border-charcoal-800 mt-5 pt-4 flex justify-between items-center">
                        <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">Pilih "Semua Lokasi" untuk mencari di seluruh area Bintaro.</span>
                        <a href="#" onclick="selectCategory('', 'Semua Lokasi / Tipe'); return false;" class="text-brand-600 dark:text-brand-400 hover:underline text-sm font-semibold">Clear / Semua Lokasi</a>
                    </div>
                </div>
            </form>
            </form>
        </div>

        
        <div class="lg:hidden py-3">
            <form action="<?php echo e(route('search')); ?>" method="POST" id="mobile-search-form" class="relative">
                <?php echo csrf_field(); ?>
                <div class="relative flex items-center">
                    <input type="text" name="search"
                           value="<?php echo e(request('search')); ?>"
                           placeholder="Cari nama, lokasi..."
                           class="w-full bg-gray-50 dark:bg-charcoal-900 border border-gray-200 dark:border-charcoal-800 rounded-full py-2.5 pl-4 pr-12 text-sm focus:ring-2 focus:ring-brand-500 transition-all dark:text-white">
                    <button type="submit" class="absolute right-1.5 p-2 bg-brand-500 hover:bg-brand-600 text-white rounded-full transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                    </button>
                </div>
                
                
                <div class="flex overflow-x-auto no-scrollbar gap-2 mt-3 pb-1">
                    <a href="<?php echo e(route('home')); ?>" class="whitespace-nowrap px-4 py-1.5 rounded-full <?php echo e(!$hasCategory ? 'bg-brand-500 text-white border-brand-500' : 'bg-white dark:bg-charcoal-950 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-charcoal-700'); ?> text-xs font-medium border">Semua</a>
                    <?php $__currentLoopData = $parentCategories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('home', ['category' => $parent->group_type])); ?>" class="whitespace-nowrap px-4 py-1.5 rounded-full <?php echo e($categorySlug === $parent->group_type ? 'bg-brand-500 text-white border-brand-500' : 'bg-white dark:bg-charcoal-950 text-gray-600 dark:text-gray-300 border-gray-200 dark:border-charcoal-700'); ?> text-xs font-medium border"><?php echo e($parent->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </form>
        </div>

    </div>

    
    <script>
    (function() {
        const toggle  = document.getElementById('search-toggle');
        const panel   = document.getElementById('search-panel');
        const chevron = document.getElementById('search-chevron');
        const input   = document.getElementById('search-input');
        
        // Mega Menu elements
        const megaMenuBtn = document.getElementById('mega-menu-btn');
        const megaMenuPanel = document.getElementById('mega-menu-panel');
        const categoryInput = document.getElementById('category-input');
        const megaMenuLabel = document.getElementById('mega-menu-label');

        let open = false;

        window.selectCategory = function(slug, name) {
            if (categoryInput) categoryInput.value = slug;
            if (megaMenuLabel) megaMenuLabel.innerText = name;
            if (megaMenuPanel) megaMenuPanel.classList.add('hidden');
        };

        if (megaMenuBtn && megaMenuPanel) {
            megaMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                megaMenuPanel.classList.toggle('hidden');
            });
            
            // Prevent closing when clicking inside panel
            megaMenuPanel.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        function openPanel() {
            open = true;
            panel.style.maxHeight = panel.scrollHeight + 500 + 'px'; // +500 to account for mega menu overflow potentially
            chevron.style.transform = 'rotate(180deg)';
            setTimeout(() => {
                panel.style.overflow = 'visible';
                if(input) input.focus();
            }, 300);
        }

        function closePanel() {
            open = false;
            panel.style.overflow = 'hidden';
            panel.style.maxHeight = '0';
            chevron.style.transform = '';
            if (megaMenuPanel) megaMenuPanel.classList.add('hidden');
        }

        toggle.addEventListener('click', () => open ? closePanel() : openPanel());

        // Close when clicking outside
        document.addEventListener('click', e => {
            if (open && !document.getElementById('search-section').contains(e.target)) {
                closePanel();
            } else if (open && megaMenuPanel && !megaMenuPanel.classList.contains('hidden') && !megaMenuBtn.contains(e.target) && !megaMenuPanel.contains(e.target)) {
                // If only clicking outside mega menu but inside search section
                megaMenuPanel.classList.add('hidden');
            }
        });

        // If filter is active, auto-open on page load
        <?php if(request('search') || $hasCategory || request('sort') && request('sort') !== 'latest'): ?>
        openPanel();
        <?php endif; ?>
    })();
    </script>
</section>




<?php if(!isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price') && $featuredProperties->count() > 0): ?>
<section class="py-12 lg:py-16 bg-gray-50 dark:bg-charcoal-900/50">
    <div class="container-main">
        
        <div class="flex items-end justify-between mb-7">
            <div>
                <p class="section-label mb-2 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-brand-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                    Rumah Pilihan
                </p>
                <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white relative inline-block">
                    Properti Hotsale
                    <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                </h2>
            </div>
        </div>

        <?php $allFeatured = $featuredProperties->all(); ?>

        
        <div id="hotsale-pool" aria-hidden="true" style="display:none">
            <?php $__currentLoopData = $allFeatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="hotsale-item">
                    <?php echo $__env->make('components.property-card', ['property' => $property], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div id="hotsale-carousel" class="relative px-2">
            
            <div id="hotsale-slides" class="overflow-hidden rounded-lg">
                <div id="hotsale-track" class="flex"></div>
            </div>

            
            <div id="hotsale-dots" class="flex items-center justify-center gap-2 mt-6"></div>

            
            <button type="button" id="hotsale-prev" class="hotsale-arrow hotsale-arrow--left" aria-label="Sebelumnya" style="display:none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" id="hotsale-next" class="hotsale-arrow hotsale-arrow--right" aria-label="Selanjutnya" style="display:none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>

            
            <?php if($featuredProperties->count() > 1): ?>
            <div class="mt-7 text-center">
                <a href="<?php echo e(route('properties.hotsale')); ?>"
                   class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full border border-brand-500/40 text-brand-600 dark:text-brand-400 text-sm font-medium hover:bg-brand-500/10 hover:border-brand-500 transition-all duration-200 group">
                    Lihat Semua Properti Hotsale
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
/* ── Arrows ── */
.hotsale-arrow {
    position: absolute;
    top: 42%;
    transform: translateY(-50%);
    width: 40px; height: 40px;
    border-radius: 50%;
    background: rgba(255,255,255,0.92);
    border: 1.5px solid rgba(0,0,0,0.08);
    display: flex; align-items: center; justify-content: center;
    color: #374151;
    cursor: pointer;
    z-index: 10;
    transition: all 0.2s ease;
    box-shadow: 0 2px 12px rgba(0,0,0,0.10);
}
.dark .hotsale-arrow {
    background: rgba(30,35,45,0.92);
    border-color: rgba(255,255,255,0.12);
    color: #e5e7eb;
}
.hotsale-arrow:hover {
    background: #ea951d; border-color: #ea951d; color: #fff;
    box-shadow: 0 4px 16px rgba(234,149,29,0.4);
    transform: translateY(-50%) scale(1.08);
}
.hotsale-arrow--left  { left: -6px; }
.hotsale-arrow--right { right: -6px; }
@media(max-width:640px) {
    /* Di mobile sembunyikan arrow, cukup swipe */
    .hotsale-arrow { display: none !important; }
}

/* ── Dots ── */
.hotsale-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #d1d5db; border: none; cursor: pointer;
    transition: all 0.25s ease; padding: 0;
    flex-shrink: 0;
}
.dark .hotsale-dot { background: #4b5563; }
.hotsale-dot--active {
    width: 24px; border-radius: 50px;
    background: linear-gradient(90deg, #ea951d, #c97a10);
    box-shadow: 0 2px 8px rgba(234,149,29,0.45);
}
.hotsale-dot:hover:not(.hotsale-dot--active) {
    background: #ea951d; transform: scale(1.2);
}

/* ── Mobile swipe hint ── */
@media(max-width:639px) {
    #hotsale-carousel { padding-left: 0; padding-right: 0; }
    .hotsale-slide .prop-card {
        /* sedikit shadow tambahan di mobile agar terasa kartu tunggal */
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
}
</style>

<script>
(function () {
    var pool    = document.getElementById('hotsale-pool');
    var track   = document.getElementById('hotsale-track');
    var dotsEl  = document.getElementById('hotsale-dots');
    var prevBtn = document.getElementById('hotsale-prev');
    var nextBtn = document.getElementById('hotsale-next');
    if (!pool || !track) return;

    /* Ambil semua item kartu dari pool */
    var items = Array.from(pool.querySelectorAll('.hotsale-item'));
    if (items.length === 0) return;

    var current  = 0;
    var total    = 0;
    var autoTimer = null;

    /* ── Tentukan berapa kartu per slide berdasarkan lebar layar ── */
    function getPerPage() {
        var w = window.innerWidth;
        if (w < 640)  return 2;   /* HP       : 2 kartu, swipe */
        if (w < 1024) return 4;   /* Tablet   : 4 kartu (2×2) */
        return 3;                  /* Desktop  : 3 kartu */
    }

    /* ── Bangun grid class sesuai perPage ── */
    function gridClass(pp) {
        if (pp === 1) return 'grid-cols-1';
        if (pp === 2) return 'grid-cols-2 gap-3 sm:gap-5';
        if (pp === 4) return 'grid-cols-2 gap-3 sm:gap-5';
        return 'grid-cols-3 gap-5';
    }

    /* ── Bangun ulang seluruh carousel ── */
    function build() {
        var pp     = getPerPage();
        var chunks = [];
        for (var i = 0; i < items.length; i += pp) {
            chunks.push(items.slice(i, i + pp));
        }
        total = chunks.length;

        /* Bersihkan */
        track.innerHTML  = '';
        dotsEl.innerHTML = '';

        /* Buat slide per chunk
         * PERF: Gunakan innerHTML (string) bukan cloneNode(true) pada elemen kompleks.
         * cloneNode(true) pada elemen dengan banyak SVG dan child nodes = mahal di main thread. */
        chunks.forEach(function (chunk, idx) {
            var slide = document.createElement('div');
            slide.className = 'hotsale-slide w-full flex-shrink-0';
            slide.style.minWidth = '100%';

            var grid = document.createElement('div');
            grid.className = 'grid ' + gridClass(pp);

            chunk.forEach(function (item) {
                /* innerHTML jauh lebih cepat daripada deep DOM clone */
                var wrapper = document.createElement('div');
                wrapper.innerHTML = item.innerHTML;
                grid.appendChild(wrapper);
            });

            slide.appendChild(grid);
            track.appendChild(slide);

            /* Dot per slide */
            if (total > 1) {
                var dot = document.createElement('button');
                dot.type = 'button';
                dot.className = 'hotsale-dot' + (idx === 0 ? ' hotsale-dot--active' : '');
                dot.dataset.index = idx;
                dot.setAttribute('aria-label', 'Slide ' + (idx + 1));
                dot.addEventListener('click', function () { goTo(+this.dataset.index); });
                dotsEl.appendChild(dot);
            }
        });

        /* Tambahkan card-visible ke SEMUA kartu di carousel.
         * Kartu carousel sudah ada di viewport saat build() — tidak perlu
         * menunggu IntersectionObserver, langsung tampilkan. */
        track.querySelectorAll('.prop-card').forEach(function(card) {
            card.classList.add('card-visible');
        });

        /* Tampilkan / sembunyikan arrow */
        if (total > 1) {
            prevBtn.style.display = '';
            nextBtn.style.display = '';
        } else {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
        }

        /* Reset posisi */
        if (current >= total) current = 0;
        goTo(current, true);
        startAuto();
    }

    /* ── Pindah ke slide idx ── */
    function goTo(idx, instant) {
        if (idx < 0)      idx = total - 1;
        if (idx >= total) idx = 0;
        current = idx;

        track.style.transition = instant ? 'none' : 'transform 0.45s cubic-bezier(0.4,0,0.2,1)';
        track.style.transform  = 'translateX(-' + (current * 100) + '%)';

        dotsEl.querySelectorAll('.hotsale-dot').forEach(function (d, i) {
            d.classList.toggle('hotsale-dot--active', i === current);
        });
    }

    /* ── Auto-advance ── */
    function startAuto() {
        if (autoTimer) clearInterval(autoTimer);
        if (total > 1) autoTimer = setInterval(function () { goTo(current + 1); }, 5000);
    }

    /* ── Touch / swipe support (mobile) ── */
    var tsX = 0;
    track.addEventListener('touchstart', function (e) {
        tsX = e.changedTouches[0].clientX;
    }, { passive: true });
    track.addEventListener('touchend', function (e) {
        var diff = tsX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
    }, { passive: true });

    /* ── Arrow buttons ── */
    prevBtn.addEventListener('click', function () { goTo(current - 1); });
    nextBtn.addEventListener('click', function () { goTo(current + 1); });

    /* ── Build pertama kali ── */
    build();

    /* ── Rebuild saat resize (debounced) ── */
    var rTimer;
    window.addEventListener('resize', function () {
        clearTimeout(rTimer);
        rTimer = setTimeout(build, 200);
    });
})();
</script>
<?php endif; ?>




<section id="properties" class="py-12 lg:py-16 bg-white dark:bg-charcoal-950">
    <div class="container-main">

        <div class="flex items-end justify-between mb-7">
            <div>
                <?php if(isset($category)): ?>
                    <p class="section-label mb-2"><?php echo e($category->name); ?></p>
                    <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white relative inline-block">
                        Properti <?php echo e($category->name); ?>

                        <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                    </h2>
                <?php else: ?>
                    <p class="section-label mb-2">Semua Listing</p>
                    <h2 class="text-3xl lg:text-4xl font-serif font-extrabold text-gray-900 dark:text-white relative inline-block">
                        Daftar Properti
                        <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                    </h2>
                <?php endif; ?>
            </div>
            <div class="flex items-center gap-3">
                <?php if(isset($category)): ?>
                    <a href="<?php echo e(route('home')); ?>" class="btn-outline text-xs px-3 py-1.5">
                        ← Semua
                    </a>
                <?php endif; ?>
                <p class="text-sm text-gray-400 dark:text-charcoal-500 hidden sm:block">
                    <?php echo e($properties->total()); ?> properti ditemukan
                </p>
            </div>
        </div>

        
        <?php if(request('search') || $hasCategory): ?>
            <div class="flex flex-wrap gap-2 mb-5">
                <span class="text-xs text-gray-400 self-center">Filter:</span>
                <?php if(request('search')): ?>
                    <span class="flex items-center gap-1 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 text-xs rounded-full border border-brand-200 dark:border-brand-800">
                        "<?php echo e(request('search')); ?>"
                        <a href="<?php echo e(route('home', array_filter(request()->except('search')))); ?>" class="hover:text-brand-900 ml-0.5">×</a>
                    </span>
                <?php endif; ?>
                <?php if($categoryName): ?>
                    <span class="flex items-center gap-1 px-2.5 py-1 bg-brand-50 dark:bg-brand-900/20 text-brand-700 dark:text-brand-300 text-xs rounded-full border border-brand-200 dark:border-brand-800">
                        <?php echo e($categoryName); ?>

                        <a href="<?php echo e(route('home', array_filter(request()->except('category')))); ?>" class="hover:text-brand-900 ml-0.5">×</a>
                    </span>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        
        <?php if($properties->count() > 0): ?>
            <div id="props-grid" class="grid grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-5 props-grid-anim">
                <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make('components.property-card', ['property' => $property], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-8 text-center">
                <a href="<?php echo e(route('properties.all')); ?>"
                   class="inline-flex items-center gap-2.5 px-8 py-3 rounded-full bg-brand-500/10 border border-brand-500/30 text-brand-600 dark:text-brand-400 text-sm font-semibold hover:bg-brand-500/20 hover:border-brand-500/60 transition-all duration-200 group shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/></svg>
                    Lihat Semua Properti
                    <span class="text-xs text-gray-400 dark:text-charcoal-500 font-normal">(<?php echo e($properties->total()); ?> listing)</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>


            <div class="mt-8" id="props-pagination">
                <?php echo e($properties->links('components.pagination')); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-16 border border-dashed border-gray-200 dark:border-charcoal-700 rounded-lg">
                <svg class="w-10 h-10 text-gray-300 dark:text-charcoal-600 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                </svg>
                <p class="text-gray-500 dark:text-charcoal-400 text-sm mb-4">Tidak ada properti yang sesuai filter.</p>
                <a href="<?php echo e(route('home')); ?>" class="btn-primary text-sm">Reset Filter</a>
            </div>
        <?php endif; ?>

<style>
.props-grid-anim {
    animation: propsGridIn 0.38s cubic-bezier(0.4, 0, 0.2, 1) both;
}
@keyframes propsGridIn {
    from { opacity: 0; transform: translateY(14px); }
    to   { opacity: 1; transform: translateY(0); }
}
</style>

<script>
(function () {
    /* ── AJAX Pagination: swap konten tanpa refresh halaman ── */

    function loadPage(url) {
        var gridEl = document.getElementById('props-grid');
        var pagEl  = document.getElementById('props-pagination');

        /* Fade out */
        if (gridEl) {
            gridEl.style.transition = 'opacity 0.2s ease';
            gridEl.style.opacity    = '0.2';
        }

        fetch(url, { credentials: 'same-origin' })
            .then(function (res) { return res.text(); })
            .then(function (html) {
                var parser = new DOMParser();
                var newDoc = parser.parseFromString(html, 'text/html');

                var ng = newDoc.getElementById('props-grid');
                var np = newDoc.getElementById('props-pagination');
                var nm = newDoc.getElementById('load-more-btn');

                /* Swap grid */
                gridEl = document.getElementById('props-grid');
                pagEl  = document.getElementById('props-pagination');

                if (ng && gridEl) { gridEl.innerHTML = ng.innerHTML; }
                if (np && pagEl)  { pagEl.innerHTML  = np.innerHTML;  }

                /* Swap "Lihat Selengkapnya" */
                var om = document.getElementById('load-more-btn');
                if (om && nm)         { om.outerHTML = nm.outerHTML; }
                else if (om && !nm)   { om.remove(); }
                else if (!om && nm && pagEl) { pagEl.insertAdjacentHTML('beforebegin', nm.outerHTML); }

                /* Fade in + re-observe kartu baru untuk animasi reveal */
                gridEl = document.getElementById('props-grid');
                if (gridEl) {
                    gridEl.style.opacity   = '0';
                    gridEl.style.transform = 'translateY(12px)';
                    void gridEl.offsetWidth; /* force reflow */
                    gridEl.style.transition = 'opacity 0.35s ease, transform 0.35s ease';
                    gridEl.style.opacity    = '1';
                    gridEl.style.transform  = 'translateY(0)';
                    /* Trigger IntersectionObserver untuk kartu baru */
                    if (typeof window.reObserveCards === 'function') {
                        setTimeout(window.reObserveCards, 50);
                    }
                }

                /* Update URL */
                history.pushState({ paginationHref: url }, '', url);

                /* Scroll ke section properties */
                var sec = document.getElementById('properties');
                if (sec) {
                    window.scrollTo({ top: sec.offsetTop - 80, behavior: 'smooth' });
                }
            })
            .catch(function (err) {
                console.warn('Pagination fetch error:', err);
                /* Restore opacity tanpa redirect */
                var g = document.getElementById('props-grid');
                if (g) g.style.opacity = '1';
            });
    }

    /* ── Click delegation di document level ── */
    document.addEventListener('click', function (e) {
        /* Cari anchor dengan class page-btn terdekat dari target klik */
        var link = e.target.closest('a.page-btn');

        /* Juga tangkap klik "Lihat Selengkapnya" */
        if (!link) link = e.target.closest('#load-more-btn[href]');
        if (!link) return;

        /* Ambil URL absolut dari link */
        var url = link.href;
        if (!url || url === '' || url === '#') return;

        /* ── FIX MIXED CONTENT ──
           Laravel bisa generate URL http:// tapi ngrok/server pakai https://.
           Paksa pakai origin yang sama dengan halaman saat ini agar fetch tidak diblokir. */
        try {
            var u = new URL(url);
            /* Ganti host dan protocol dengan yang sekarang dipakai browser */
            url = window.location.origin + u.pathname + u.search;
        } catch (e2) { return; }

        e.preventDefault();
        e.stopPropagation();
        loadPage(url);
    });

    /* ── Back / Forward browser ── */
    window.addEventListener('popstate', function (e) {
        if (e.state && e.state.paginationHref) {
            loadPage(e.state.paginationHref);
        }
    });
})();
</script>

    </div>
</section>




<?php if(!isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price')): ?>





<section class="py-12 lg:py-16 bg-white dark:bg-charcoal-950 border-t border-gray-200 dark:border-charcoal-800">
    <div class="container-main">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">

            
            <div data-reveal="left">
                <p class="section-label mb-2">Keunggulan Kami</p>
                <h2 class="text-2xl lg:text-3xl font-serif font-bold text-gray-900 dark:text-white mb-4 leading-snug">
                    Mengapa Memilih<br>Bintaro Land Property?
                </h2>
                <p class="text-gray-500 dark:text-charcoal-400 text-sm leading-relaxed mb-8">
                    Kami bukan sekadar agen properti. Kami mitra yang memahami kebutuhan keluarga Indonesia — dari pencarian hingga serah terima kunci.
                </p>

                <ul class="space-y-5">
                    <?php
                        $reasons = [
                            ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => 'Legalitas Terjamin', 'desc' => 'Setiap properti yang kami tawarkan telah melalui verifikasi dokumen secara menyeluruh.'],
                            ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => 'Tim Berpengalaman', 'desc' => 'Agen kami memiliki pengalaman lebih dari 5 tahun di pasar properti Bintaro dan sekitarnya.'],
                            ['icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'title' => 'Konsultasi Gratis via WA', 'desc' => 'Hubungi kami kapan saja lewat WhatsApp, tanpa biaya konsultasi. Tim kami siap 7 hari seminggu.'],
                            ['icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => 'Harga Transparan', 'desc' => 'Tidak ada biaya tersembunyi. Kami terbuka mengenai semua biaya sejak awal.'],
                        ];
                    ?>
                    <?php $__currentLoopData = $reasons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="flex gap-4" data-reveal data-reveal-delay="<?php echo e($loop->iteration); ?>">
                            <div class="flex-shrink-0 w-9 h-9 rounded-md bg-brand-50 dark:bg-brand-900/30 flex items-center justify-center mt-0.5">
                                <svg class="w-4.5 h-4.5 text-brand-600 dark:text-brand-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="<?php echo e($r['icon']); ?>"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1"><?php echo e($r['title']); ?></p>
                                <p class="text-sm text-gray-500 dark:text-charcoal-400 leading-relaxed"><?php echo e($r['desc']); ?></p>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            
            <div class="grid grid-cols-2 gap-3" data-reveal="right">
                <div class="rounded-lg overflow-hidden aspect-[3/4]">
                    <img src="<?php echo e(asset('unsplash_image/HalamanHome/Interior2.webp')); ?>" alt="Interior" loading="lazy" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col gap-3">
                    <div class="rounded-lg overflow-hidden aspect-video">
                        <img src="<?php echo e(asset('unsplash_image/HalamanHome/Ruang_tamu2.webp')); ?>" alt="Ruang tamu" loading="lazy" class="w-full h-full object-cover scale-[1.35]">
                    </div>
                    <div class="rounded-lg overflow-hidden flex-1">
                        <img src="<?php echo e(asset('unsplash_image/HalamanHome/Exterior2.webp')); ?>" alt="Eksterior" loading="lazy" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<section id="kontak" class="relative py-16 lg:py-20 overflow-hidden">
    <div class="absolute inset-0">
        
        <picture>
            <source
                srcset="<?php echo e(asset('unsplash_image/HalamanHome/WhatsApp_CTA.webp')); ?>"
                type="image/webp">
            <img src="<?php echo e(asset('unsplash_image/HalamanHome/WhatsApp_CTA.webp')); ?>"
                 alt=""
                 loading="lazy"
                 decoding="async"
                 sizes="100vw"
                 class="w-full h-full object-cover">
        </picture>
        <div class="absolute inset-0 bg-charcoal-950 bg-opacity-75"></div>
    </div>
    <div class="relative z-10 container-main text-center">
        <p class="section-label text-brand-400 mb-3" data-reveal>Mulai Hari Ini</p>
        <h2 class="font-serif text-3xl lg:text-4xl font-bold text-white mb-4 max-w-xl mx-auto leading-snug" data-reveal data-reveal-delay="1">
            Siap Temukan Properti Ideal Anda?
        </h2>
        <p class="text-gray-400 text-sm max-w-md mx-auto mb-8 leading-relaxed" data-reveal data-reveal-delay="2">
            Konsultasi langsung dengan agen kami via WhatsApp.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3" data-reveal data-reveal-delay="3">
            <a href="https://wa.me/<?php echo e(env('WHATSAPP_NUMBER', '6281234567890')); ?>?text=<?php echo e(urlencode('Halo Bintaro Land Property, saya ingin konsultasi properti.')); ?>"
               target="_blank" rel="noopener noreferrer"
               class="btn-wa px-8 py-3 text-base">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
            <a href="<?php echo e(route('home')); ?>#properties" class="px-8 py-3 border border-white/30 hover:border-white/60 text-white text-base font-medium rounded-md transition-colors duration-150">
                Lihat Properti →
            </a>
        </div>
    </div>
</section>
<?php endif; ?>
<?php if(isset($activePromo) && $activePromo && !isset($category) && !$hasCategory && !request('search') && !request('min_price') && !request('max_price')): ?>
    <?php if (isset($component)) { $__componentOriginal26862648dac4b3fba48afbf8a2ad91e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal26862648dac4b3fba48afbf8a2ad91e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.promo-modal','data' => ['promo' => $activePromo]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('promo-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['promo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activePromo)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal26862648dac4b3fba48afbf8a2ad91e1)): ?>
<?php $attributes = $__attributesOriginal26862648dac4b3fba48afbf8a2ad91e1; ?>
<?php unset($__attributesOriginal26862648dac4b3fba48afbf8a2ad91e1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal26862648dac4b3fba48afbf8a2ad91e1)): ?>
<?php $component = $__componentOriginal26862648dac4b3fba48afbf8a2ad91e1; ?>
<?php unset($__componentOriginal26862648dac4b3fba48afbf8a2ad91e1); ?>
<?php endif; ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /media/mangsurr/Linux E/Gawe/Project/bintaroproperty/resources/views/home.blade.php ENDPATH**/ ?>