<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['property']));

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

foreach (array_filter((['property']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>


<article class="prop-card group relative">

    
    <a href="<?php echo e(route('property.show', $property->slug)); ?>"
       class="absolute inset-0 z-10 rounded-lg"
       aria-label="<?php echo e($property->title); ?>"></a>

    
    <div class="relative overflow-hidden aspect-[4/3]">
        <img src="<?php echo e($property->image_url); ?>"
             alt="<?php echo e($property->title); ?>"
             width="400" height="300"
             loading="lazy"
             class="w-full h-full object-cover group-hover:scale-[1.04] transition-transform duration-500"
             onerror="this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&q=70'">

        
        <div class="absolute inset-0 bg-gradient-to-t from-black/55 via-black/10 to-transparent"></div>

        
        <div class="absolute top-2 left-2 sm:top-3 sm:left-3 flex flex-wrap items-center gap-1 sm:gap-1.5 z-20 max-w-[90%]">
            
            <?php if($property->property_condition): ?>
                <?php
                    $condColors = [
                        'baru' => 'bg-emerald-500/90',
                        'second' => 'bg-blue-500/90',
                        'aset-bank' => 'bg-purple-500/90'
                    ];
                    $condLabels = [
                        'baru' => '✨ Baru',
                        'second' => '🔄 Second',
                        'aset-bank' => '🏦 Aset Bank'
                    ];
                    $colorClass = $condColors[$property->property_condition] ?? 'bg-gray-500/90';
                    $label = $condLabels[$property->property_condition] ?? ucfirst($property->property_condition);
                ?>
                <span class="inline-flex items-center px-1.5 py-0.5 sm:px-2 sm:py-1 text-[8px] sm:text-[10px] uppercase tracking-wider font-bold text-white rounded <?php echo e($colorClass); ?> backdrop-blur-sm shadow-sm">
                    <?php echo e($label); ?>

                </span>
            <?php endif; ?>

            
            <?php if($property->is_featured): ?>
                <span class="inline-flex items-center gap-0.5 sm:gap-1 px-1.5 py-0.5 sm:px-2 sm:py-1 text-[8px] sm:text-[10px] uppercase tracking-wider font-bold text-white rounded bg-red-600/90 backdrop-blur-sm shadow-sm">
                    <svg class="w-2.5 h-2.5 sm:w-3.5 sm:h-3.5 text-yellow-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"></path>
                    </svg>
                    Hotsale
                </span>
            <?php endif; ?>
        </div>

        
        <div class="absolute bottom-0 left-0 right-0 px-2 py-1.5 sm:px-4 sm:py-3">
            <p class="text-xs sm:text-base font-bold text-white leading-tight drop-shadow">
                <?php echo e($property->formatted_price); ?>

            </p>
        </div>
    </div>

    
    <div class="p-2 sm:p-4">

        
        <?php if($property->categories->count()): ?>
            <div class="flex flex-wrap gap-1 mb-1.5 sm:mb-2">
                <?php $__currentLoopData = $property->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="badge-gold text-[9px] sm:text-[11px] px-1.5 py-0.5 sm:px-2 sm:py-0.5"><?php echo e($cat->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        
        <h3 class="text-[11px] sm:text-sm font-semibold text-gray-900 dark:text-white leading-snug mb-1 sm:mb-1.5 line-clamp-2 group-hover:text-brand-700 dark:group-hover:text-brand-400 transition-colors duration-150">
            <?php echo e($property->title); ?>

        </h3>

        
        <?php if($property->city || $property->district): ?>
            <p class="flex items-center gap-1 text-[10px] sm:text-xs text-gray-500 dark:text-charcoal-400 mb-2 sm:mb-3">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span class="truncate"><?php echo e($property->location_label); ?></span>
            </p>
        <?php endif; ?>

        
        <div class="flex flex-wrap items-center gap-1.5 sm:gap-3 text-[10px] sm:text-xs text-gray-500 dark:text-charcoal-400 pt-2 sm:pt-3 border-t border-gray-100 dark:border-charcoal-800">
            <?php if($property->bedrooms > 0): ?>
                <span class="flex items-center gap-0.5 sm:gap-1">
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 10V7a2 2 0 012-2h12a2 2 0 012 2v3M4 10h16v5a1 1 0 01-1 1H5a1 1 0 01-1-1v-5zM6 16v2M18 16v2"/>
                    </svg>
                    <?php echo e($property->bedrooms); ?> KT
                </span>
            <?php endif; ?>
            <?php if($property->bathrooms > 0): ?>
                <span class="flex items-center gap-0.5 sm:gap-1">
                    <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 12h16M4 12a2 2 0 00-2 2v2a2 2 0 002 2h16a2 2 0 002-2v-2a2 2 0 00-2-2M8 18v2M16 18v2M7 12V8a2 2 0 012-2h1m4 0h3a2 2 0 012 2v4"/>
                    </svg>
                    <?php echo e($property->bathrooms); ?> KM
                </span>
            <?php endif; ?>
            <span class="flex items-center gap-0.5 sm:gap-1">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 8V4m0 0h4M4 4l5 5m11-2V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
                LT <?php echo e(number_format($property->land_area, 0, ',', '.')); ?>

            </span>
            <span class="flex items-center gap-0.5 sm:gap-1">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-brand-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                LB <?php echo e(number_format($property->build_area, 0, ',', '.')); ?>

            </span>
        </div>

        
        <a href="<?php echo e(route('property.show', $property->slug)); ?>"
           class="relative z-20 mt-2 sm:mt-3 block w-full text-center py-1.5 sm:py-2 text-[10px] sm:text-xs font-semibold text-brand-700 dark:text-brand-400 border border-brand-200 dark:border-brand-800/60 hover:bg-brand-50 dark:hover:bg-brand-900/20 rounded-md transition-colors duration-150">
            Lihat Detail →
        </a>
    </div>
</article>
<?php /**PATH D:\Gawe\website landing page\bintaro-propertyv2\resources\views/components/property-card.blade.php ENDPATH**/ ?>