<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['promo']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['promo']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php if($promo): ?>
<div x-data="{
        showPromo: false,
        init() {
            if (!sessionStorage.getItem('promo_closed_<?php echo e($promo->id); ?>')) {
                setTimeout(() => {
                    this.showPromo = true;
                }, 1000); // Show after 1 second
            }
        },
        closePromo() {
            this.showPromo = false;
            sessionStorage.setItem('promo_closed_<?php echo e($promo->id); ?>', 'true');
        }
    }"
    x-show="showPromo"
    x-transition.opacity.duration.300ms
    style="display: none; z-index: 9999;"
    class="fixed inset-0 flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm"
>
    <!-- Modal Container -->
    <div 
        @click.away="closePromo()"
        x-show="showPromo"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="relative w-full max-w-[calc(100vw-2rem)] sm:max-w-md max-h-[90vh] overflow-y-auto bg-white dark:bg-charcoal-900 rounded-2xl shadow-2xl overflow-x-hidden border border-gray-100 dark:border-charcoal-800 scrollbar-hide min-w-0"
    >
        <!-- Close Button -->
        <button 
            @click="closePromo()"
            class="absolute top-3 right-3 z-[10000] p-1.5 bg-black/40 hover:bg-black/60 text-white rounded-full backdrop-blur-md transition-colors shadow-sm"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <?php if($promo->link_url): ?>
            <a href="<?php echo e($promo->link_url); ?>" target="_blank" rel="noopener" class="block group">
        <?php else: ?>
            <div class="block">
        <?php endif; ?>

        <!-- Image -->
        <?php if($promo->image_path): ?>
            <img src="<?php echo e(Storage::url($promo->image_path)); ?>" alt="<?php echo e($promo->title); ?>" class="w-full h-auto object-cover">
        <?php else: ?>
            <!-- Fallback Image/Gradient -->
            <div class="w-full h-40 bg-gradient-to-br from-brand-600 via-brand-500 to-amber-500 flex items-center justify-center p-6 text-center">
                 <svg class="w-16 h-16 text-white/30 absolute" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
        <?php endif; ?>

        <!-- Content -->
        <!-- <div class="p-6 md:p-8 text-center relative z-10 bg-white dark:bg-charcoal-900">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-3 leading-snug"><?php echo e($promo->title); ?></h2>
            <?php if($promo->description): ?>
                <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-5 leading-relaxed"><?php echo e($promo->description); ?></p>
            <?php endif; ?>
            
            <?php if($promo->link_url): ?>
                <span class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-lg transition-colors w-full sm:w-auto">
                    Lihat Selengkapnya
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </span>
            <?php endif; ?>
        </div> -->

        <?php if($promo->link_url): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH D:\Gawe\website landing page\bintaro-propertyv2\resources\views/components/promo-modal.blade.php ENDPATH**/ ?>