

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>
<style>
.cc_bx img {
    border: 1px solid #000;
    border-bottom: 0px;
    padding: 15px;
}
.cc_bx {
    margin-bottom: 10px;
}
.cc_text {
    background-color: #e3120b;
    padding: 10px 10px;
    outline: 1px dashed #fff;
    outline-offset: -5px;
}
.cc_bx img{
    aspect-ratio: 3 / 2;
    object-fit: contain;
}
</style>

<main>

<?php if(!empty($page->banner)): ?>   
<div class="position-relative mb-5">
<img src="<?php echo e(showImage($page->banner,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100 sp-bann" > 
<div class="position-absolute support-text">
<h2>Welcome To CMPL Support</h2>
<p>Support for all your needs, in one place. Sign in to get personalized help and access your registered devices, software and existing service requests.</p>
</div>
</div>
<?php endif; ?>

<section class="wt-sec pt-5 pb-3">
<div class="container-fluid">
<h3 class="text-center fs-2 fw-normal text-capitalize mb-3"> Brands </h3>

<?php if($brands->isNotEmpty()): ?>
<div class="category-area fix mt-3-px pb-75">
<div class="row">
<?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-12">
<a href="<?php echo e(route('brand.detail',$row->slug)); ?>">
<div class="single-category p-rel wow fadeInUp" data-wow-delay=".3s" style="margin-bottom:4px">
<div class="cat-thumb cc_bx fix">
<img src="<?php echo e(showImage($row->image,'uploaded_files/category')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>" width="100">
</div>
<div class="cat-content p-abs bottom-left text-center p-0"> 
<span class="cat-subtitle cc_text text-white"><?php echo e($row->name); ?></span>
</div>
</div>
</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php endif; ?>
</div>
</section>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/software-driver.blade.php ENDPATH**/ ?>