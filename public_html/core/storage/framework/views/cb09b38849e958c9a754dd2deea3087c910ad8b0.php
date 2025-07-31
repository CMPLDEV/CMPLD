<?php $__env->startSection('title', setting()->comp_name.' | Reset Password'); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- breadcrumb-start -->
<section class="page-bradcrumb">
<div class="slider-area over-hidden">
<div class="single-page page-height3 d-flex align-items-center" data-background="assets/images/shop/banner-shop-1.jpg">
<div class="container">
<div class="row">
<div class="col-xl-12  col-lg-12  col-md-12  col-sm-12 col-12  d-flex align-items-center justify-content-center">
<div class="page-title text-center">
<h2 class="text-capitalize text-white  mb-25 pt-35">Reset Password</h2>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center bg-transparent">
<li class="breadcrumb-item"><a class="secondary-color" href="">Home</a></li>
<li class="breadcrumb-item active text-capitalize text-white" aria-current="page">Reset Password</li>
</ol>
</nav>
</div><!-- /page title -->
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
<!-- </div> -->
</div><!-- /single-slider -->
</div>
</section>
<!-- breadcrumb-end -->

<!-- account-wrap-start --> 
<section class="account-wrap pt-50 pb-50">
<div class="login-register-area mb-60">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-6 offset-xl-3 offset-lg-3 col-md-12  col-sm-12 col-12 d-flex justify-content-center justify-content-md-end">
<div class="login-area mb-60">
<h4>Reset Password</h4>
<div class="login-form mt-40 pl-55 pr-55 pt-60 pb-60">
<form method="POST" action="<?php echo e(route('password.update')); ?>">
<?php echo csrf_field(); ?>  
<input type="hidden" name="token" value="<?php echo e($token); ?>">
<div class="log-email">
<label class="d-block pb-2">Email address<span class="text-danger">*</span></label>
<input type="email" name="email" placeholder="Email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e($email ?? old('email')); ?>">
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

<div class="log-pass">
<label class="d-block pt-10 pb-2">Password<span class="text-danger">*</span></label>
<input type="password" name="password" placeholder="Password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
<?php $__errorArgs = ['password'];
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

<div class="log-pass">
<label class="d-block pt-10 pb-2">Confirm Password<span class="text-danger">*</span></label>
<input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control">
</div>

<button type="submit" class="btn text-white bg-dark transition-3 form-control mt-20">Reset Password</button>
</form>
</div>
</div>
</div><!-- /col -->

</div><!-- /row -->
</div><!-- /container -->
</div>
</section>
<!-- account-wrap-end -->

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/auth/passwords/reset.blade.php ENDPATH**/ ?>