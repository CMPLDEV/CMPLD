
<?php $__env->startSection('title','Add/Edit Testimonial'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Testimonial</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Testimonial</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end Blog title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<h5 class="card-title"><?php if(isset($edit)): ?> Edit <?php else: ?> Add <?php endif; ?> Testimonial
<a href="<?php echo e(route('admin.testimonial')); ?>" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" <?php if(isset($edit)): ?> action="<?php echo e(route('testimonial.update',$edit->id)); ?>" <?php else: ?> action="<?php echo e(route('testimonial.create')); ?>" <?php endif; ?>>
 <?php echo csrf_field(); ?>

<div class="row mb-3">

<div class="col-lg-3">
 <?php if(isset($edit) && !empty($edit->image)): ?>
  <img src="<?php echo e(asset(showImage($edit->image,'uploaded_files/testimonial'))); ?>" alt="image" width="100%">
   <br> <a href="<?php echo e(route('testimonial.remove.image',$edit->id)); ?>" class="text-danger">Remove</a>
 <?php else: ?> 
  <img src="<?php echo e(asset(noImage())); ?>" alt="image" width="100%">   
 <?php endif; ?> 
 <input type="file" name="image" id="image" class="form-control <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"> 
 <?php $__errorArgs = ['image'];
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

<div class="col-lg-9">
<div class="row">

<div class="col-sm-5">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="name" placeholder="Name" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?>>
 <label for="floatingInput">Name</label>
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
 </div> 
 
 <div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['designation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="designation" placeholder="Designation" <?php if(isset($edit)): ?> value="<?php echo e($edit->designation); ?>" <?php else: ?> value="<?php echo e(old('designation')); ?>" <?php endif; ?>>
 <label for="floatingInput">Designation</label>
  <?php $__errorArgs = ['designation'];
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
 
 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status">
  <option value="1" <?php if(isset($edit)): ?> <?php if($edit->status == 1): ?> selected <?php endif; ?> <?php endif; ?>>ACTIVE</option>
  <option value="0" <?php if(isset($edit)): ?> <?php if($edit->status == 0): ?> selected <?php endif; ?> <?php endif; ?>>INACTIVE</option>
 </select>
 <label for="floatingInput">Choose Status</label>
  <?php $__errorArgs = ['status'];
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

 <div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content"><?php if(isset($edit)): ?><?php echo e($edit->content); ?><?php endif; ?></textarea>
 <label for="floatingInput">Content</label>
  <?php $__errorArgs = ['content'];
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

</div>

<div class="row">

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</div>

</form>
</div>
</div>

</div>

</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/addedit-testimonial.blade.php ENDPATH**/ ?>