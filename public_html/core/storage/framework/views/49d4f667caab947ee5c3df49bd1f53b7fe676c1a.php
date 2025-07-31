
<?php $__env->startSection('title','Add/Edit Showcase Product'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Showcase Product</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Showcase Product</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<h5 class="card-title"><?php if(isset($edit)): ?> Edit <?php else: ?> Add <?php endif; ?> Showcase Product
<a href="<?php echo e(route('showcase.product', $showcase->id)); ?>" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" <?php if(isset($edit)): ?> action="<?php echo e(route('showcase.product.update')); ?>" <?php else: ?> action="<?php echo e(route('showcase.product.create')); ?>" <?php endif; ?>>
 <?php echo csrf_field(); ?>
 
 <input type="hidden" name="showcase_id" value="<?php echo e($showcase->id); ?>">
 <?php if(isset($edit)): ?>
  <?php echo method_field('PUT'); ?>
  <input type="hidden" name="id" value="<?php echo e($edit->id); ?>">
 <?php endif; ?>

<div class="row mb-3">

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <select name="product_id" id="product_id" class="selectpicker <?php $__errorArgs = ['product_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" data-live-search="true">
 <option value="">Choose any</option>
 <?php $__currentLoopData = $all_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
 <?php $__errorArgs = ['product_id'];
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

</div>


<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
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

<?php $__env->startSection('custom-script'); ?>
 <script>
  let company_name = $('#company_name').val();
  let data_array = company_name.split("-");
  let id = data_array[data_array.length - 1].trim();  
  showCompanyProducts(id);  
 </script>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/showcase/addedit-showcase-product.blade.php ENDPATH**/ ?>