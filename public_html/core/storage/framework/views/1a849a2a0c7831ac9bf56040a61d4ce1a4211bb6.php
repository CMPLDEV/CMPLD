

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-2 pt-60 pb-60 include-bg" data-background="uploaded_files/page/<?php echo e($page->banner); ?>">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-left">
<h3 class="text-white"><?php echo e($page->name); ?></h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-start">
<li class="breadcrumb-item text-white"><a href="">Home</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e($page->name); ?></li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<!-- blog area start -->
<section class="blog__area pt-100 pb-100">
<div class="container">
<?php if($data->isNotEmpty()): ?>  
<div class="row">
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
<div class="single-blog blog-grid mb-30">
<div class="blog-thumb w-img">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><img src="<?php echo e(showImage($row->image,'uploaded_files/blog')); ?>" alt="<?php echo e($row->alt); ?>" title="<?php echo e($row->title); ?>"></a>
</div>
<div class="blog-content">
<div class="blog-meta">Post date <a href="#"><span><?php echo e(date('d M, Y',strtotime($row->created_at))); ?></span></a>.
</div>
<h5 class="blog-title blog-title-1">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><?php echo e($row->name); ?></a>
</h5>
<p><?php echo e(Str::limit(strip_tags($row->content),100,$end='..')); ?></p>
<div class="blog-btn">
<a class="s-btn s-btn-4" href="<?php echo e(route('blog.detail',$row->slug)); ?>">Continue Reading</a>
</div>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php echo e($data->appends($_GET)->links()); ?>

</div>
<?php else: ?>
<div class="alert alert-danger alert-dismissible fade show w-50 m-auto">
 <strong>No data available to show !</strong>.
</div>
<?php endif; ?>
</div>
</section>
<!-- blog area end -->
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/blog.blade.php ENDPATH**/ ?>