<?php $__env->startSection('title', 'Manajemen Admin'); ?>
<?php $__env->startSection('page-title', 'Manajemen Admin'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Daftar Admin</h2>
    <a href="<?php echo e(route('admin.admins.create')); ?>" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
        + Tambah Admin
    </a>
</div>

<div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Nama</th>
                    <th scope="col" class="px-6 py-3">Username</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="border-b dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <?php echo e($admin->name); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php echo e($admin->username); ?>

                        </td>
                        <td class="px-6 py-4">
                            <?php if($admin->role === 'super-admin'): ?>
                                <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-purple-900 dark:text-purple-300">Super Admin</span>
                            <?php else: ?>
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Admin</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <?php if($admin->is_active): ?>
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aktif</span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Nonaktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-right flex justify-end gap-2">
                            <?php if(session('admin_id') != $admin->id): ?>
                                <form action="<?php echo e(route('admin.admins.toggle-status', $admin)); ?>" method="POST" class="inline-block">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="font-medium <?php echo e($admin->is_active ? 'text-orange-600 dark:text-orange-500 hover:underline' : 'text-green-600 dark:text-green-500 hover:underline'); ?>">
                                        <?php echo e($admin->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>

                                    </button>
                                </form>
                            <?php endif; ?>
                            <a href="<?php echo e(route('admin.admins.edit', $admin)); ?>" class="font-medium text-amber-600 dark:text-amber-500 hover:underline">Edit</a>
                            <?php if(session('admin_id') != $admin->id): ?>
                                <form action="<?php echo e(route('admin.admins.destroy', $admin)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus admin ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data admin.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u851258633/domains/bintarolandproperty.com/public_html/resources/views/admin/admins/index.blade.php ENDPATH**/ ?>