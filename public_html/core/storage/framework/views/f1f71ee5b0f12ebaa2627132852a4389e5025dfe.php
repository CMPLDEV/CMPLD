
<?php $__env->startSection('title','Product SEO'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product SEO</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product SEO</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-lg-12">

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible fade show mb-3 w-50 m-auto">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<strong>Errors Occured!</strong>
<ul style="margin-left:25px;">
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li><?php echo e($error); ?></li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?>

<div class="card">
<div class="card-body">

<form method="post" enctype="multipart/form-data" action="<?php echo e(route('productseo.update')); ?>">
 <?php echo csrf_field(); ?>

<input type="hidden" name="id" <?php if(!empty($data)): ?> value="<?php echo e($data->id); ?>" <?php else: ?> value="0" <?php endif; ?>> 

<div class="row mb-3">

<div class="col-sm-12 mt-3">
<label for="">Content</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content" ><?php if(!empty($data)): ?><?php echo e($data->content); ?><?php endif; ?></textarea>
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
<script>CKEDITOR.replace('content');</script>

<div class="col-sm-12 mt-3">
<div class="alert alert-secondary rounded-0">
  <strong>SEO Related Section</strong>
</div>   
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_title" placeholder="Enter Meta Title"><?php if(!empty($data)): ?><?php echo e($data->meta_title); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Title</label>
  <?php $__errorArgs = ['meta_title'];
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
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_description" placeholder="Enter Meta Description" ><?php if(!empty($data)): ?><?php echo e($data->meta_description); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Description</label>
  <?php $__errorArgs = ['meta_description'];
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
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_keywords" placeholder="Enter Meta Keywords"><?php if(!empty($data)): ?><?php echo e($data->meta_keywords); ?><?php endif; ?></textarea>
 <label for="floatingInput">Meta Keywords</label>
  <?php $__errorArgs = ['meta_keywords'];
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/product-seo.blade.php ENDPATH**/ ?>