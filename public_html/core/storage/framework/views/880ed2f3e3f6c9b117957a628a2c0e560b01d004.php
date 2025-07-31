
<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Advance Settings</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Advance Settings</li>
</ol>
</div>

</div>
</div>
</div>
<style>
textarea{min-height:200px !important;}
</style>

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">

<form method="post" enctype="multipart/form-data" action="<?php echo e(route('advancesetting.update')); ?>">
 <?php echo csrf_field(); ?>

<div class="row mb-3">

<div class="col-sm-6">
 <div class="card">
  <div class="card-header"> <strong> Site SEO </strong> </div>
  <div class="card-body">
      
    <input type="checkbox" name="meta_robots" id="meta_robots" <?php if($data->meta_robots): ?> checked <?php endif; ?> >
    <label for="meta_robots">Meta Robots</label>
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control <?php $__errorArgs = ['site_verification'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="site_verification" placeholder="Enter Site Verification Code"><?php if(!empty($data->site_verification)): ?><?php echo e($data->site_verification); ?><?php else: ?><?php echo e(old('site_verification')); ?><?php endif; ?></textarea>
    <label for="floatingInput">Site Verification Code</label>
    <?php $__errorArgs = ['site_verification'];
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
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control <?php $__errorArgs = ['analytics'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="analytics" placeholder="Enter Analytics Code" ><?php if(!empty($data->analytics)): ?><?php echo e($data->analytics); ?><?php else: ?><?php echo e(old('analytics')); ?><?php endif; ?></textarea>
    <label for="floatingInput">Analytics Code</label>
    <?php $__errorArgs = ['analytics'];
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
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control <?php $__errorArgs = ['site_schema'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="site_schema" placeholder="Enter Schema Code" ><?php if(!empty($data->site_schema)): ?><?php echo e($data->site_schema); ?><?php else: ?><?php echo e(old('site_schema')); ?><?php endif; ?></textarea>
    <label for="floatingInput">Schema Code</label>
    <?php $__errorArgs = ['site_schema'];
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
    
     <div class="form-floating mb-3">
    <textarea type="text" class="form-control <?php $__errorArgs = ['robotstxt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="robotstxt" placeholder="Enter Robots.txt" ><?php if(file_exists(("robots.txt"))): ?><?php echo e(file_get_contents("robots.txt")); ?><?php endif; ?></textarea>
    <label for="floatingInput">Robots.txt</label>
    <?php $__errorArgs = ['robotstxt'];
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
</div>

<div class="col-sm-6">
 <div class="card">
  <div class="card-header"> <strong> Google re-Captcha </strong> </div>
  <div class="card-body">
      
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['g_recaptcha_site_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="g_recaptcha_site_key" placeholder="Enter Site Key" <?php if(!empty($data->g_recaptcha_site_key)): ?> value="<?php echo e($data->g_recaptcha_site_key); ?>" <?php else: ?> value="<?php echo e(old('g_recaptcha_site_key')); ?>" <?php endif; ?> >
    <label for="floatingInput">Site Key</label>
    <?php $__errorArgs = ['g_recaptcha_site_key'];
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
    
    <div class="form-floating mb-3">
    <input type="text" class="form-control <?php $__errorArgs = ['g_recaptcha_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="g_recaptcha_secret_key" placeholder="Enter Secret Key" <?php if(!empty($data->g_recaptcha_secret_key)): ?> value="<?php echo e($data->g_recaptcha_secret_key); ?>" <?php else: ?> value="<?php echo e(old('g_recaptcha_secret_key')); ?>" <?php endif; ?> >
    <label for="floatingInput">Secret Key</label>
    <?php $__errorArgs = ['g_recaptcha_secret_key'];
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
</div>

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</div>
</div>


</form><!-- End General Form Elements -->

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/advance-setting.blade.php ENDPATH**/ ?>