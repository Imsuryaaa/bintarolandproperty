<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    

    <url>
        <loc><?php echo e(url('/')); ?></loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <url>
        <loc><?php echo e(url('/tentang-kami')); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    <url>
        <loc><?php echo e(url('/simulasi-kpr')); ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>

    

    <?php $__currentLoopData = $properties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $property): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(url('/properti/' . $property->slug)); ?></loc>
        <lastmod><?php echo e($property->updated_at->toAtomString()); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</urlset>
<?php /**PATH /home/u851258633/domains/bintarolandproperty.com/public_html/resources/views/sitemap.blade.php ENDPATH**/ ?>