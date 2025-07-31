
<?php $__env->startSection('title','Add/Edit Identify Product'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Identify Product</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Identify Product</li>
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
<h5 class="card-title"><?php if(isset($edit)): ?> Edit <?php else: ?> Add <?php endif; ?> Identify Product
<a href="<?php echo e(route('admin.identify.product')); ?>" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" <?php if(isset($edit)): ?> action="<?php echo e(route('identify.product.update')); ?>" <?php else: ?> action="<?php echo e(route('identify.product.create')); ?>" <?php endif; ?>>
 <?php echo csrf_field(); ?>
 <?php if(isset($edit)): ?> <?php echo method_field('PUT'); ?> 
 <input type="hidden" name="id" value="<?php echo e($edit->id); ?>" /> <?php endif; ?>

<div class="row">
 <div class="col-lg-4">
  <div class="input-group mb-3">
   <input type="text" class="form-control" placeholder="Enter SKU No" name="sku" id="sku">
   <button class="btn btn-dark" type="button" id="fetch_btn" onClick="productBySKU();">Fetch</button>
  </div>      
 </div> 

</div>

<hr>

<div class="row">
 
 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['asin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="asin" name="asin" placeholder="ASIN" <?php if(isset($edit)): ?> value="<?php echo e($edit->asin); ?>" <?php else: ?> value="<?php echo e(old('asin')); ?>" <?php endif; ?> readonly>
 <label for="floatingInput">ASIN</label>
  <?php $__errorArgs = ['asin'];
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
 
 <div class="col-sm-9">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="product_name" name="product_name" placeholder="Product Name" <?php if(isset($edit)): ?> value="<?php echo e($edit->product_name); ?>" <?php else: ?> value="<?php echo e(old('product_name')); ?>" <?php endif; ?> readonly>
 <label for="floatingInput">Product Name</label>
  <?php $__errorArgs = ['product_name'];
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
 <input type="text" class="form-control <?php $__errorArgs = ['serial_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="serial_no" placeholder="Serial No" <?php if(isset($edit)): ?> value="<?php echo e($edit->serial_no); ?>" <?php else: ?> value="<?php echo e(old('serial_no')); ?>" <?php endif; ?>>
 <label for="floatingInput">Serial No</label>
  <?php $__errorArgs = ['serial_no'];
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
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="quantity" placeholder="Quantity" <?php if(isset($edit)): ?> value="<?php echo e($edit->quantity); ?>" <?php else: ?> value="<?php echo e(old('quantity')); ?>" <?php endif; ?>>
 <label for="floatingInput">Quantity</label>
  <?php $__errorArgs = ['quantity'];
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
 <input type="date" class="form-control <?php $__errorArgs = ['warranty_start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="warranty_start_date" placeholder="Warranty Start Date" <?php if(isset($edit)): ?> value="<?php echo e($edit->warranty_start_date); ?>" <?php else: ?> value="<?php echo e(old('warranty_start_date')); ?>" <?php endif; ?>>
 <label for="floatingInput">Warranty Start Date</label>
  <?php $__errorArgs = ['warranty_start_date'];
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
 <input type="date" class="form-control <?php $__errorArgs = ['warranty_end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="warranty_end_date" placeholder="Warranty End Date" <?php if(isset($edit)): ?> value="<?php echo e($edit->warranty_end_date); ?>" <?php else: ?> value="<?php echo e(old('warranty_end_date')); ?>" <?php endif; ?>>
 <label for="floatingInput">Warranty End Date</label>
  <?php $__errorArgs = ['warranty_end_date'];
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
 
 <div class="col-sm-12">
 <div class="form-floating mb-3">
 <textarea class="form-control <?php $__errorArgs = ['remark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="floatingInput" name="remark" placeholder="Remark"><?php if(isset($edit)): ?><?php echo e($edit->remark); ?><?php else: ?><?php echo e(old('remark')); ?><?php endif; ?></textarea>
 <label for="floatingInput">Remark</label>
  <?php $__errorArgs = ['remark'];
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

</form>
</div>
</div>

</div>

</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/addedit-identify-product.blade.php ENDPATH**/ ?>