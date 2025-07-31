<?php $__env->startSection('title', setting()->comp_name.' | Forget Password'); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- account-wrap-start --> 
<section class="account-wrap pt-50 pb-50">
<div class="login-register-area mb-60">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-6 offset-xl-3 offset-lg-3 col-md-12  col-sm-12 col-12 d-flex justify-content-center justify-content-md-end">
<div class="login-area mb-60">
<h4>Forgot your password?</h4>
<div class="login-form mt-40 pl-55 pr-55 pt-60 pb-60">
<?php if(session('status')): ?>
<div class="alert alert-success" role="alert">
<?php echo e(session('status')); ?>

</div>
<?php endif; ?>    
<form method="POST" action="<?php echo e(route('password.email')); ?>">
<?php echo csrf_field(); ?>  
<div class="log-email">
<label class="d-block pb-2">Email address<span class="text-danger">*</span></label>
<input type="email" name="email" placeholder="Email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" value="<?php echo e(old('email')); ?>">
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

<button type="submit" class="btn text-white bg-dark transition-3 form-control mt-20">Send Request</button>
<div class="f-get-pass text-right">
<a href="<?php echo e(route('login')); ?>" class="black-color d-inline-block mt-10">Login</a>
</div>
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/auth/passwords/email.blade.php ENDPATH**/ ?>