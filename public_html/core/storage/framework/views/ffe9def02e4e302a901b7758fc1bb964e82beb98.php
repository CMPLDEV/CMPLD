

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>
<style>
    .ban-img img{
        max-height: 350px;
    }
    .overlay {
    height: 100%;
    left: 0px;
    top: 0px;
    position: absolute;
    width: 100%;
    background: #0d111385;
    opacity: 1.9;
}
.img-text{z-index: 1;}
.cc_bx img{border: 1px solid #000; border-bottom: 0px;}
.cc_bx{box-shadow: 0px 0px 5px #00000036}
.cc_text {
    background-color: #e3120b;
    padding: 10px 10px;
    outline: 1px dashed #fff;
    outline-offset: -5px;
}
</style>

<main>


<?php if(!empty($page->banner)): ?>   
<div class="ban-img position-relative">
     <img src="<?php echo e(showImage($page->banner,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100"> 
     <div class="img-text position-absolute top-50 start-50 translate-middle">
         <span class="fs-2 fw-bold text-white">Our Clients</span>
     </div>
     <div class="overlay"></div>
</div>
<?php endif; ?>
<section class="blog__area partner-area pt-100 pb-50">
<div class="container"> 
<?php if($data->isNotEmpty()): ?>
<div class="row justify-content-center">
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6 mb-4">
<div class="cc_bx">
     <img src="uploaded_files/our_client/<?php echo e($row->image); ?>" alt="<?php echo e(setting()->comp_name); ?>" />
     <div class="cc_text text-center">
         <p class="m-0 text-white"><?php echo e($row->title); ?></p>
     </div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
 <div class="row">
  <div class="col-lg-6 offset-lg-3">
    <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>No data available to show</strong>.
  </div>  
  </div>     
 </div>
<?php endif; ?>
</div>
</section>
<!-- blog area end -->
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/our-client.blade.php ENDPATH**/ ?>