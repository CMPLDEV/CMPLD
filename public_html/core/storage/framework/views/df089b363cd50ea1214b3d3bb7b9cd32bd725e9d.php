<?php if($blogs->isNotEmpty()): ?>
<div class="blog-area pt-50 pb-50">
<div class="container">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
<span class="p-subtitle p-subtitle-2">Explore The Blog</span>
<h3 class="p-title pb-15 mb-0">Latest Blog Posts</h3>
</div>
</div>
</div>
<div class="blog-active owl-carousel">
<?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-xxl-12">
<div class="single-blog wow fadeInUp" data-wow-delay=".4s">
<div class="blog-thumb">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><img src="<?php echo e(showImage($row->image,'uploaded_files/blog')); ?>" alt="<?php echo e($row->alt); ?>" title="<?php echo e($row->title); ?>"></a>
</div>
<div class="blog-content blog-content-3">
<div class="blog-meta blog-meta-2">Post date <a href="#"><span><?php echo e(date('d M, Y',strtotime($row->updated_at))); ?></span></a>.
</div>
<h5 class="blog-title blog-title-2"><a href="<?php echo e(route('blog.detail',$row->slug)); ?>"><?php echo e($row->name); ?></a></h5>
<div class="border-bottom-gray border-0">
<p><?php echo e(Str::limit(strip_tags($row->content),100,$end='..')); ?></p>
<div class="p-btn p-btn-3">
<a href="<?php echo e(route('blog.detail',$row->slug)); ?>">Continue Reading</a>
</div>
</div>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>
</div>
<?php endif; ?><?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/index-blog.blade.php ENDPATH**/ ?>