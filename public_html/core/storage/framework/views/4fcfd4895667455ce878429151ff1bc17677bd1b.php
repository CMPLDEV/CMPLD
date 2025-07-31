

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

<?php if(!empty($row->banner)): ?>
 <img src="uploaded_files/blog/<?php echo e($row->banner); ?>" width="100%" />
<?php endif; ?>

<!-- blog area start -->
<section class="blog__area pt-100 pb-100">
<div class="container">
<div class="row">
<div class="col-xxl-9 col-xl-9 col-lg-8">
<div class="postbox__wrapper pr-45">
<div class="postbox__details">
<div class="postbox__details-thumb w-img mb-50">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>">
<img src="<?php echo e(showImage($row->image,'uploaded_files/blog')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>">
</a>
</div>
<div class="postbox__details-content">

<h3 class="postbox__details-title">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><?php echo e($row->name); ?></a>
</h3>
<div class="postbox__meta postbox__meta-2">
<div class="blog-meta d-inline-block mr-55 postbox__meta-2-line">
Post date 
<a href="#"><span><?php echo e(date('d M, Y',strtotime($row->created_at))); ?></span></a> 
</div>
</div>
<div class="postbox__text">
<?php echo $row->content; ?>

</div>
<div class="postbox__line mt-50 mb-45"></div> 
</div>
</div>
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-4">
<div class="blog__sidebar">
<?php if($blogs->isNotEmpty()): ?>
<div class="sidebar__widget sidebar__widget-padding mb-30">
<h5 class="sidebar__widget-title mb-30">Popular Posts</h5>
<div class="sidebar__post">
<div class="rc-post-wrapper">
<div class="row">
    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-12 col-md-6">
    <div class="rc-post-item">
<div class="rc-post-thumb mr-10">
<a href="<?php echo e(route('blog.detail',$blog->slug)); ?>">
<img src="<?php echo e(showImage($blog->image,'uploaded_files/blog')); ?>" alt="<?php echo e($blog->alt); ?>" title="<?php echo e($blog->title); ?>">
</a>
</div>
<div class="rc-post-content">
<h5 class="rc-post-title">
<a href="<?php echo e(route('blog.detail',$blog->slug)); ?>"><?php echo e($blog->name); ?></a>
</h5>
<div class="rc-post-meta">
<span><?php echo e(date('d M, Y',strtotime($blog->created_at))); ?></span>
</div>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
</div>
<?php endif; ?>
</div>
</div>
</div>
</div>
</section>
<!-- blog area end -->

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/blog-detail.blade.php ENDPATH**/ ?>