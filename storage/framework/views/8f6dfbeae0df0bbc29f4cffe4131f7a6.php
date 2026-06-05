<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between mt-8 lg:mt-12">
        
        
        <div class="flex justify-between flex-1 sm:hidden gap-4">
            <?php if($paginator->onFirstPage()): ?>
                <span class="btn-outline px-4 py-2 opacity-50 cursor-not-allowed w-full">
                    <?php echo __('pagination.previous'); ?>

                </span>
            <?php else: ?>
                <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="btn-outline px-4 py-2 hover:border-brand-300 dark:hover:border-brand-700 w-full text-center">
                    <?php echo __('pagination.previous'); ?>

                </a>
            <?php endif; ?>

            <?php if($paginator->hasMorePages()): ?>
                <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="btn-outline px-4 py-2 hover:border-brand-300 dark:hover:border-brand-700 w-full text-center">
                    <?php echo __('pagination.next'); ?>

                </a>
            <?php else: ?>
                <span class="btn-outline px-4 py-2 opacity-50 cursor-not-allowed w-full">
                    <?php echo __('pagination.next'); ?>

                </span>
            <?php endif; ?>
        </div>

        
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 dark:text-charcoal-400">
                    Menampilkan
                    <span class="font-medium text-gray-900 dark:text-white"><?php echo e($paginator->firstItem()); ?></span>
                    hingga
                    <span class="font-medium text-gray-900 dark:text-white"><?php echo e($paginator->lastItem()); ?></span>
                    dari
                    <span class="font-medium text-gray-900 dark:text-white"><?php echo e($paginator->total()); ?></span>
                    hasil
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
                    
                    <?php if($paginator->onFirstPage()): ?>
                        <span aria-disabled="true" aria-label="<?php echo e(__('pagination.previous')); ?>">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-400 dark:text-charcoal-500 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 cursor-default rounded-l-md" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 dark:text-charcoal-300 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 rounded-l-md hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors focus:z-10 focus:outline-none focus:ring-1 focus:ring-brand-500 focus:border-brand-500" aria-label="<?php echo e(__('pagination.previous')); ?>">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <?php if(is_string($element)): ?>
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 dark:text-charcoal-400 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 cursor-default"><?php echo e($element); ?></span>
                            </span>
                        <?php endif; ?>

                        
                        <?php if(is_array($element)): ?>
                            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($page == $paginator->currentPage()): ?>
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-semibold text-white bg-brand-600 border border-brand-600 cursor-default"><?php echo e($page); ?></span>
                                    </span>
                                <?php else: ?>
                                    <a href="<?php echo e($url); ?>" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 dark:text-charcoal-300 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors focus:z-10 focus:outline-none focus:ring-1 focus:ring-brand-500 focus:border-brand-500" aria-label="<?php echo e(__('Go to page :page', ['page' => $page])); ?>">
                                        <?php echo e($page); ?>

                                    </a>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($paginator->hasMorePages()): ?>
                        <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 dark:text-charcoal-300 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 rounded-r-md hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors focus:z-10 focus:outline-none focus:ring-1 focus:ring-brand-500 focus:border-brand-500" aria-label="<?php echo e(__('pagination.next')); ?>">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <span aria-disabled="true" aria-label="<?php echo e(__('pagination.next')); ?>">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-400 dark:text-charcoal-500 bg-white dark:bg-charcoal-900 border border-gray-300 dark:border-charcoal-700 cursor-default rounded-r-md" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </nav>
<?php endif; ?>
<?php /**PATH D:\Gawe\website landing page\bintaro-property\resources\views/components/pagination.blade.php ENDPATH**/ ?>