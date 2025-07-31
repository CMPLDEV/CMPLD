

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>
<style>
.support-text{
top: 50%;
left: 5%;
transform: translate(-5%, -50%);
max-width: 500px;
}
.support-text h2{
font-size: 36px;
line-height: 36px;
color:#ffffff;
margin-bottom:20px;
}
.support-text p{
color:#ffffff;
}
.custm_button{
padding: 8px 20px;font-size: 18px;background-color: rgb(6 114 203);border: 2px solid rgb(6 114 203);color: #fff;border-radius: 4px;
}
.cstm_one:hover{
color: rgb(6 114 203);
background-color: transparent;
border: 2px solid rgb(6 114 203);
}
.cstm_two{
color: rgb(6 114 203);
background-color: transparent;
}
.cstm_two:hover{
background-color: rgb(6 114 203);
color: #fff;
}
.video-section {
box-shadow: 0px 0px 2px #0000003b;
padding: 22px;
}
.warnt-card{    cursor: pointer;
background: linear-gradient(65deg, #fe3138fa, #a94045);
outline: 1px dashed #fff;
outline-offset: -5px;}
.wt-sec .col-lg-3{padding: 0px 5px;}
.pds{font-size: 12px;}
.buttn{padding: 5px 10px;border: 1px solid rgb(6 114 203);font-size: 14px;
border-radius: 4px;color: rgb(6 114 203);position: absolute;bottom: 25px;}
.support{position: relative;padding: 10px;
box-shadow: 0px 0px 2px #0000003b;}
.new{background-color: #f5f5f5; padding: 20px;}
.cmp-new {padding: 10px;font-size: 13px;color: darkgray;}
</style>

<main>

<?php if(!empty($page->banner)): ?>   
<div class="position-relative mb-5">
<img src="<?php echo e(showImage($page->banner,'uploaded_files/page')); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" class="w-100 sp-bann" > 
<div class="position-absolute support-text">
<h2>Welcome To CMPL Support</h2>
<p>Support for all your needs, in one place. Sign in to get personalized help and access your registered devices, software and existing service requests.</p>
</div>
</div>
<?php endif; ?>

<div id="">
<section class="blog__area pt-100">
<div class="container"> 
<h4 class="text-center text-capitalize"></h4>
<div class="row align-items-center justify-content-center">

<div class="col-lg-3">

<img src="assets/img/support-person.png" alt="">
<!--<?php if(auth()->guard()->check()): ?>-->
<!-- Welcome <?php echo e(user()->name); ?> | <a href="<?php echo e(route('userpanel.ticket')); ?>">Raise Ticket</a>-->
<!--<?php else: ?>-->
<!-- <a href="<?php echo e(route('login')); ?>">Login</a>-->
<!--<?php endif; ?>-->
</div>    

<div class=" col-lg-7 col-md-7">

<div class="support-heading text-center">
<h3>What product do you need help with?</h3>
<p>Enter your device's serial number (e.g., CMPL) and uncover your warranty status instantly</p>
</div>    

<form method="GET" class="support-box" action="<?php echo e(route('support.search')); ?>">
<?php echo csrf_field(); ?>    
<div class="input-group mb-3">
<input type="text" name="serial_no" class="form-control <?php $__errorArgs = ['serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Enter Product Serial Number">
<button class="btn btn-success" type="submit"><i class="fal fa-search"></i></button>
</div>
<?php $__errorArgs = ['serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="invalid-feedback"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</form>
</div>
</div>

</div>

</section>

</div>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/warranty.blade.php ENDPATH**/ ?>