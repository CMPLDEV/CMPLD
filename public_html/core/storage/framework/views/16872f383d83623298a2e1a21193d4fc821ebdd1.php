<?php $__env->startSection('title', setting()->comp_name.' | Login'); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- login area start -->
<section class="login-area pt-100 pb-100">
<div class="container">
<div class="row">
<div class="col-lg-8 offset-lg-2">
<div class="basic-login">
<h3 class="text-center mb-60">Login From Here</h3>
<form method="POST" action="<?php echo e(route('login')); ?>">
<?php echo csrf_field(); ?> 
<label for="name">Email Address <span>**</span></label>
<input id="name" type="text" placeholder="Email address..." name="email" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
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

<label for="pass">Password <span>**</span></label>
<input id="pass" type="password" placeholder="Enter password..." name="password" class="<?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
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

<div class="login-action mb-20 fix">
<span class="log-rem f-left">
<input id="remember" name="remember" type="checkbox" />
<label for="remember">Remember me!</label>
</span>
<span class="forgot-login f-right">
<a href="<?php echo e(route('password.request')); ?>">Lost your password?</a>
</span>
</div>

<div class="row">
 <div class="col-lg-8">
  <button class="s-btn s-btn-4 w-100">Login Now</button>   
 </div>
 <div class="col-lg-4">
  <a href="<?php echo e(route('social.redirect', 'google')); ?>" class="login-with-google-btn">Sign in with Google</a>     
 </div>
</div>

<div class="or-divide"><span>or</span></div>
<a href="<?php echo e(route('register')); ?>" class="s-btn s-btn-2 w-100">Register Now</a>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- login area end -->


</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/auth/login.blade.php ENDPATH**/ ?>