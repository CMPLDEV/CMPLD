

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>
<style>
.drivers-text p{
font-size: 25px;
font-weight: 500;
}
.driver-list{transition: 0.5s ease;}
.driver-list:hover {
transform: translate(0px, -10px);
}
.driver-list a{
padding: 12px 28px;
box-shadow: 0px 0px 2px #0000004a;
background: url('assets/img/driver-li.jpg');
background-size: cover;
background-repeat: no-repeat;
background-position: bottom;
color: #fff;
font-size: 20px;
border-radius: 6px;
}
</style>

<main>

<?php if(!empty($data->banner)): ?>  
<div class="drivers position-relative">
<img src="assets/img/driver.jpg" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100" style="max-height: 300px;object-fit: cover;
">
<div class="drivers-text position-absolute top-50 start-50 translate-middle">
<p class="text-white m-0">Driver's & Download</p>
</div>
</div>
<?php endif; ?>
<section class="blog__area pt-100 pb-100">
<div class="container"> 
<!--<div class="row">-->
<!--<div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1"></div>-->
<!--<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10">-->
<!--<?php if(!empty($data->image)): ?>    -->
<!--<img src="<?php echo e(showImage($data->image,'uploaded_files/category')); ?>" alt="<?php echo e(setting()->comp_name); ?>" class="support-img" title="<?php echo e(setting()->comp_name); ?>">-->
<!--<?php endif; ?>-->
<!--<p><?php echo $data->content; ?></p>-->
<!--</div>-->
<!--</div>-->

<?php if($softwares->isNotEmpty()): ?>
<br>
<div class="row">
<div class="col-lg-12">
<ul>
<?php $__currentLoopData = $softwares; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
<li class="brand-list driver-list"><a <?php if(auth()->guard()->check()): ?> href="<?php echo e($row->link); ?>" target="_blank" <?php else: ?> href="javascript:void(0);" onClick="notification('error','At first please login to download this driver.');" <?php endif; ?>><?php echo e($row->name); ?> <i class="fad fa-cloud-download"></i> </a></li> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
</ul>     
</div>   
</div>
<?php endif; ?>

</div>
</section>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/brand-detail.blade.php ENDPATH**/ ?>