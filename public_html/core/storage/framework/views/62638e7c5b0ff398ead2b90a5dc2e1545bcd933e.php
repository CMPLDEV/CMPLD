<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
     <?php if($row->slug=="home"): ?>    
      <loc><?php echo e(url('/')); ?></loc>
     <?php else: ?>
      <loc><?php echo e(url('/'.$row->slug.'.html')); ?></loc>
     <?php endif; ?>
      <lastmod><?php echo e($row->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
     <loc><?php echo e(url('/'.$row->slug.'.htm')); ?></loc>
     <lastmod><?php echo e($row->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
     <loc><?php echo e(url('/'.$row->slug.'.html')); ?></loc>
     <lastmod>2024-10-29T11:40:15+00:00</lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
     <loc><?php echo e(url('blog/'.$row->slug)); ?></loc>
     <lastmod><?php echo e($row->updated_at->tz('UTC')->toAtomString()); ?></lastmod>
     <changefreq>weekly</changefreq>
     <priority>0.6</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    

</urlset><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/sitemap/sitemap.blade.php ENDPATH**/ ?>