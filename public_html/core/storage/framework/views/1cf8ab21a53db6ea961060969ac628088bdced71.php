<?php if($our_clients->isNotEmpty()): ?>
<div class="container pb-15 mb-5">
<div class="row">
<div class="col-lg-12">
<div class="section-title text-center">
<h3 class="p-title mb-0">Our Clients</h3>
</div>      
<div class="custom-slick">
<?php $__currentLoopData = $our_clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
<div style="border: 1px solid lightgrey; border-radius: 5px;padding:10px;margin-right:10px;">
<img src="<?php echo e(showImage($row->image, 'uploaded_files/our_client')); ?>" />
<p class="text-muted text-center mt-2 fw-bold"><?php echo e(Str::limit($row->title, 25, $end='..')); ?></p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>  
</div>     
</div>    
</div>
<?php endif; ?><?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/index-client.blade.php ENDPATH**/ ?>