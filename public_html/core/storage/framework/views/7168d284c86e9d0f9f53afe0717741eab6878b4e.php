<?php if($our_associates->isNotEmpty()): ?>
<div class="container pb-15 mt-5">
<div class="row">
<div class="col-lg-12">
<div class="section-title text-center">
<h3 class="p-title mb-0">Our Associates</h3>
</div>      
<div class="custom-slick">
<?php $__currentLoopData = $our_associates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
<div class="slick-item-partner">
<center>
<img src="<?php echo e(showImage($row->image, 'uploaded_files/our_associates')); ?>"/>
<p class="text-muted text-center mt-2 fw-bold"><?php echo e(Str::limit($row->title, 25, $end='..')); ?></p>
</center>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>  
</div>     
</div>    
</div>
<?php endif; ?>

<section class="blog__area pt-100 pb-50">
<div class="container"> 
<div class="row">
<!--<h1 style="font-size: 28px;text-align: center;">Connect on Social Media</h1>-->
<div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-12">

<a href="https://www.instagram.com/cmplcomputronicsmultivision/" target="_blank"><img src="assets/img/camp1.jpeg" alt="" title="" class="float-start mb-3" style="max-width: 300px;width: 100%;padding: 0;border: 5px solid #fff;
border-radius: 10px;margin: 10px;"></a>



</div>
<div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-12">

<h1 style="font-size: 28px;text-align: center;">Connect on Social Media</h1>
</div>
<div class="col-xxl-4 col-xl-4 col-lg-12 col-md-12 col-12">
<a href="https://www.youtube.com/@cmplcomputronicsmultivisio9842" target="_blank">
<img src="assets/img/camp2.jpeg" alt="" title="" class="float-start mb-3" style="max-width: 300px;width: 100%;padding: 0;border: 5px solid #fff;
border-radius: 10px;margin: 10px;"></a>



</div>


</div>
</div>
</section>
<?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/index-associates.blade.php ENDPATH**/ ?>