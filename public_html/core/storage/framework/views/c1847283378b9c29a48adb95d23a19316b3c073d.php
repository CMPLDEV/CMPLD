<?php if($categories->isNotEmpty()): ?>
<div class="category-area fix pt-2 pb-20">
<div class="container-fluid">
    <div class="blog-active-6 owl-carousel">
<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="">
<a href="<?php echo e(categoryURL($row->slug)); ?>">
<div class="single-category p-rel wow fadeInUp" data-wow-delay=".3s" style="margin-bottom:4px">
<div class="cat-thumb fix">
<img src="<?php echo e(showImage($row->image,'uploaded_files/category')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>">
</div>
<!--<div class="cat-content p-abs bottom-left"> -->
<!--<span class="cat-subtitle"><?php echo e($row->name); ?></span>-->
<!--</div>-->
</div>
</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
<?php endif; ?><?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/index-category.blade.php ENDPATH**/ ?>