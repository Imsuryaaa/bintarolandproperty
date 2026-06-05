<?php $__env->startSection('title', 'Manajemen Promo KPR'); ?>
<?php $__env->startSection('page-title', 'Manajemen Promo KPR'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col lg:flex-row gap-6">

    <!-- Kolom Kiri: Form Tambah -->
    <div class="w-full lg:w-1/3">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm p-5 md:p-6 sticky top-24">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Tambah Promo KPR Baru</h3>
            
            <form action="<?php echo e(route('admin.kpr-promos.store')); ?>" method="POST" class="space-y-4">
                <?php echo csrf_field(); ?>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Promo / Bank <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" required placeholder="Contoh: BNI Griya Fixed 3 Tahun" 
                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 focus:border-amber-500 focus:ring-amber-500 text-sm">
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bunga Fix (%) <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" min="0" name="bunga_fix" required placeholder="Contoh: 4.5" 
                               class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <?php $__errorArgs = ['bunga_fix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Masa Fix (Tahun) <span class="text-red-500">*</span></label>
                        <input type="number" min="0" name="masa_fix" required placeholder="Contoh: 3" 
                               class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <?php $__errorArgs = ['masa_fix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bunga Floating (%) <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" min="0" name="bunga_floating" required placeholder="Contoh: 13.5" 
                           class="w-full rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-800 focus:border-amber-500 focus:ring-amber-500 text-sm">
                    <?php $__errorArgs = ['bunga_floating'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex items-center gap-3 py-2">
                    <input type="checkbox" id="is_active" name="is_active" value="1" checked 
                           class="w-4 h-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500 dark:bg-gray-800 dark:border-gray-700">
                    <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktifkan Segera</label>
                </div>
                
                <button type="submit" class="w-full py-2.5 px-4 bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold rounded-lg transition-colors">
                    Simpan Promo
                </button>
            </form>
        </div>
    </div>

    <!-- Kolom Kanan: Tabel -->
    <div class="w-full lg:w-2/3">
        <div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-xl shadow-sm overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-gray-800/50">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Daftar Promo KPR</h3>
            </div>

            <?php if(session('success')): ?>
                <div class="p-4 bg-green-50 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-sm border-b border-green-200 dark:border-green-800">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-4 font-semibold">Nama Promo</th>
                            <th class="px-6 py-4 font-semibold">Bunga Fix & Masa</th>
                            <th class="px-6 py-4 font-semibold">Bunga Floating</th>
                            <th class="px-6 py-4 font-semibold text-center">Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800 text-gray-700 dark:text-gray-300">
                        <?php $__empty_1 = true; $__currentLoopData = $kprPromos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-medium text-gray-900 dark:text-white"><?php echo e($promo->nama); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo e($promo->bunga_fix); ?>% untuk <?php echo e($promo->masa_fix); ?> Tahun
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo e($promo->bunga_floating); ?>%
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <form action="<?php echo e(route('admin.kpr-promos.toggle-status', $promo->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide transition-colors <?php echo e($promo->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 hover:bg-green-200' : 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400 hover:bg-gray-200'); ?>"
                                                title="Klik untuk ubah status">
                                            <?php echo e($promo->is_active ? 'AKTIF' : 'NONAKTIF'); ?>

                                        </button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="<?php echo e(route('admin.kpr-promos.destroy', $promo->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo KPR ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-500 hover:text-red-700 p-2 rounded-md hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors" title="Hapus Promo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        <p>Belum ada data Promo KPR.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if($kprPromos->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-800">
                    <?php echo e($kprPromos->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Gawe\website landing page\bintaro-property\resources\views/admin/kpr-promos/index.blade.php ENDPATH**/ ?>