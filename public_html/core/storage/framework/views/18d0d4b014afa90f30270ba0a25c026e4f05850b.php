<?php if($offers->isNotEmpty()): ?>
<div class="container mt-4 mb-4">
<div class="row">
<?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
<div class="col-lg-3">
<div class="card">
<a href="<?php echo e($row->link); ?>" target="_blank">   
<div class="card-body">
<img src="<?php echo e(showImage($row->image, 'uploaded_files/offer')); ?>" alt="<?php echo e($row->name); ?>" width="100%" />    
</div>   
<!--<div class="card-footer">
<?php echo e($row->name); ?>    
</div>-->
</a>
</div>       
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
<?php endif; ?>

<style>

@media screen and (max-width: 600px){
.card {
    
    display: none;
}}
</style><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/index-offer.blade.php ENDPATH**/ ?>