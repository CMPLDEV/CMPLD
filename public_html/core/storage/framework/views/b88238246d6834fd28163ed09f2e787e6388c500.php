

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>
<?php if(!empty($page->banner)): ?>   
<img src="<?php echo e(showImage($page->banner,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100"> 
<?php endif; ?>
<section class="blog__area pt-100 pb-50">
<div class="container"> 
<div class="row">
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
<?php if(!empty($page->image)): ?>    
<img src="<?php echo e(showImage($page->image,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>">
<?php endif; ?>
</div>
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
<?php echo $page->content; ?></div>
</div>

</div>
</section>

<?php if($offers->isNotEmpty()): ?>
<div class="container mt-4 mb-4">
<div class="row">
<?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
<div class="col-lg-3">
<div class="card">
<a href="<?php echo e($row->link); ?>" target="_blank">   
<div class="card-body">
<img src="<?php echo e(showImage($row->image, 'uploaded_files/offer')); ?>" alt="<?php echo e($row->name); ?>" style="width: 100%;
    height: 250px;"  />    
</div>   
<!--<div class="card-footer">
<!--<?php echo e($row->name); ?>    -->
<!--</div>-->
</a>
</div>       
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($offers->appends($_GET)->links()); ?>

</div>
</div>
<?php endif; ?>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/gift-offer.blade.php ENDPATH**/ ?>