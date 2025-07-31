<?php if($testimonials->isNotEmpty()): ?>
<section class="testimonials">
<div class="container-test">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
<h3 class="p-title mb-0">Google Review's</h3>
</div>
</div>
</div>

<div class="owl-carousel client-testimonial-carousel">
<?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<div class="single-testimonial-item">
<p><?php echo e($row->content); ?></p>
<h3> <?php echo e($row->name); ?> <span class="text-muted"><?php echo e($row->designation); ?></span> </h3>
<img src="<?php echo e(showImage($row->image, 'uploaded_files/testimonial')); ?>" alt="<?php echo e($row->name); ?>" class="rounded-circle" width="100" />
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>
</section>
<?php endif; ?>

<?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/index-testimonial.blade.php ENDPATH**/ ?>