

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<img class="w-100" src="<?php echo e($banner); ?>" />

<!-- section pd-detail -->
<section class="pd-detail">
<div class="container-fluid">
<?php if(categories()->isNotEmpty()): ?>
<div class="">
<div class="pd-box-rl">
<div class="category-box">
<div class="category-feature-list">
<div id="" class="box-category row ">
<?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="category-layout col-lg-4 col-md-4 col-6 my-2">
<div class="category-thumb clearfix">
<div class="images-hover image inner-image">
<a href="<?php echo e(categoryURL($row->slug)); ?>">
<img src="<?php echo e(showImage($row->image,'uploaded_files/category')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>" class="img-responsive" />
</a>
</div>
<!--<div class="caption">-->
<!--<div class="cat-title">-->
<!--<a href="<?php echo e(categoryURL($row->slug)); ?>" class="category-view"><h4> <span><?php echo e($row->name); ?></span> </h4></a>-->
<!--</div>-->
<!--</div>-->
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
</div>
</div>
</div>
<?php else: ?>
 <div class="alert alert-danger alert-dismissible fade in" style="width:50%;margin:auto;">
  <strong>No Record Found</strong>.
 </div>
<?php endif; ?>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/categories.blade.php ENDPATH**/ ?>