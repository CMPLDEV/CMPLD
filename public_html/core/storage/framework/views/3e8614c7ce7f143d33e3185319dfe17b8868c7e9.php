

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('custom-css'); ?>
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- ======slider-area-start=========================================== --> 
<div class="slider-area over-hidden">
<div class="single-page page-height d-flex align-items-center" <?php if(!empty($page->banner)): ?> data-background="uploaded_files/page/<?php echo e($page->banner); ?>" <?php else: ?> data-background="<?php echo e(noBanner()); ?>" <?php endif; ?>>
<div class="container">
<div class="row">
<div class="col-xl-12  col-lg-12  col-md-12  col-sm-12 col-12">
<div class="page-title text-start">
<h2 class="text-capitalize text-white  mb-25 pt-35" style="font-size:30px !important; letter-spacing:1px"><?php echo e($page->name); ?></h2>
</div><!-- /page title -->
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
<!-- </div> -->
</div><!-- /single-slider -->
</div>
<!-- slider-area-end=  -->

<!-- contact-wrap-start --> 
<section class="contact-wrap">
    
<div class="contact-form-area over-hidden">
<div class="container-wrapper pl-15 pr-15 pl-80 pr-80 pt-50 pb-50 bg-white">
<div class="row">
<div class="col-xl-6  col-lg-6  col-md-12  col-sm-12 col-12">
<!--<div class="contact-form-left mb-30 pr-100">
<div class="section-title text-left pb-30">
<span class="secondary-color pb-2 d-block">Contact us</span>
<h2>Please contact us quickly if
    you need help.</h2>
</div>
<div class="contact-address pb-3">
<span class="blue-color">Location Details</span>
<p><?php echo e(setting()->address); ?> <?php echo e(setting()->city); ?> - <?php echo e(setting()->pincode); ?> <?php echo e(state(setting()->state)); ?> <?php echo e(country(setting()->country)); ?></p>
</div>
<div class="contact-address pb-3">
<span class="blue-color">Contacts</span>
<p class="m-0"><a href="tel:<?php echo e(setting()->mobile); ?>" style="color: #000;"><?php echo e(setting()->mobile); ?></a></p>
<?php if(!empty(setting()->phone)): ?>
<p class="m-0"><a href="tel:<?php echo e(setting()->phone); ?>" style="color: #000;"><?php echo e(setting()->phone); ?></a></p>
<?php endif; ?>
</div>
<div class="contact-address">
<span class="blue-color">Email Address</span>
<p><a href="mailto:<?php echo e(setting()->email); ?>" style="color: #000;"><?php echo e(setting()->email); ?></a></p>
<?php if(!empty(setting()->alt_email)): ?>
<p><a href="mailto:<?php echo e(setting()->alt_email); ?>" style="color: #000;"><?php echo e(setting()->alt_email); ?></a></p>
<?php endif; ?>
</div>
</div>-->
<div class="ckeditor-content">
<?php echo $page->content; ?>

</div>
</div><!-- /col -->
<div class="col-xl-6  col-lg-6  col-md-12  col-sm-12 col-12">
<div class="contact-form-right mb-30">

<form action="<?php echo e(route('enquiry.submit')); ?>" method="post">
<?php echo csrf_field(); ?> 
<input type="hidden" name="source" value="<?php echo e(Request::fullUrl()); ?>">  
<span class="secondary-color pb-10 d-block">Write to us</span>
<div class="name mb-30">
 <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" id="name" placeholder="Name*" >
 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
  <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="email mb-30">
 <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" id="c-email" placeholder="Email*" >
 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
  <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="row">

<div class="col-lg-6">
 <div class="email mb-30">
 <select name="country" class="form-control">
 <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if($row->id==101): ?> selected <?php endif; ?>>[+<?php echo e($row->phonecode); ?>] <?php echo e($row->name); ?></option> 
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
</div>
 </div> 

 <div class="col-lg-6">
 <div class="email mb-30">
 <input type="text" class="form-control <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mobile" value="<?php echo e(old('mobile')); ?>" id="c-email" placeholder="Mobile No*" >
 <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
  <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
 </div> 
</div>

<div class="comment mb-30">
 <textarea name="message" class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="message" placeholder="Comments"><?php echo e(old('message')); ?></textarea>
 <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
  <span class="invalid-feedback" role="alert">
  <strong><?php echo e($message); ?></strong>
  </span>
  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
<div class="g-recaptcha" data-sitekey="<?php echo e(setting()->g_recaptcha_site_key); ?>"></div>
<?php if($errors->has('g-recaptcha-response')): ?>
 <span class="invalid-feedback d-block fw-bold" role="alert"><?php echo e($errors->first('g-recaptcha-response')); ?></span>
<?php endif; ?>
</div>

<div class="text-center">
<button type="submit" class="btn form-control text-white transition">Send</button>
</div>
</form>
</div>
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
</div>
</section>
<!-- contact-wrap-end -->

<!-- conatct-map-start --> 
<section class="map-wrap">
<div class="contact-map position-relative">
<div class="container-fluid px-0">
<?php echo setting()->map; ?>

</div>
</div>
</section>
<!-- conatct-map-end -->

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/contact-us.blade.php ENDPATH**/ ?>