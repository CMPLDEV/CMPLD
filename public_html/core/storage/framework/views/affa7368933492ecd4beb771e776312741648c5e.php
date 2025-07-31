

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>
<!-- breadcrumb-start -->
<div class="slider-area over-hidden">
<div class="single-page page-height d-flex align-items-center" <?php if(!empty($page->banner)): ?> data-background="uploaded_files/page/<?php echo e($page->banner); ?>" <?php else: ?> data-background="<?php echo e(noBanner()); ?>" <?php endif; ?>>
<div class="container">
<div class="row">
<div class="col-xl-12  col-lg-12  col-md-12  col-sm-12 col-12  d-flex align-items-center justify-content-center position-static">
<div class="page-title text-center">
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center bg-transparent">
<li class="breadcrumb-item"><a class="" style="color: #000;" href="">Home</a></li>
<li class="breadcrumb-item active text-capitalize text-white" aria-current="page"><?php echo e($page->name); ?></li>
</ol>
</nav> 
</div><!-- /page title -->
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
<!-- </div> -->
</div><!-- /single-slider -->
</div>
<!-- breadcrumb-end -->

<!--start gallery sec -->
<section class="gallery-pg pt-50 pb-50">
<div class="container">
<div class="row">
<div class="col-lg-12">
 <div class="ckeditor-content">
  <?php echo $page->content; ?>   
 </div>
</div>

</div>
</div>
</div>
</section>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/refund-return-policy.blade.php ENDPATH**/ ?>