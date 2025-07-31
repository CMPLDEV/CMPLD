
<?php $__env->startSection('title','Attributes List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Attributes List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Attributes List</li>
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
<h5 class="card-title"><?php echo e($category->name); ?>'s Attribute List
<a href="<?php echo e(route('admin.category')); ?>" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" action="<?php echo e(route('category.attribute.create')); ?>">
 <?php echo csrf_field(); ?>

<input type="hidden" name="category_id" value="<?php echo e($category->id); ?>" />

<div class="col-sm-12 mt-3">
<div class="alert alert-secondary rounded-0">
 <strong>Additional Attributes <a href="javascript:void(0);" title="Add New Attribute" onClick="addAttribute();" class="float-end"><i class="fas fa-plus-circle fa-2x text-primary"></i></a> </strong> 
</div>  
</div>

 <?php if($data->isNotEmpty()): ?>
  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="row element">

<input type="hidden" name="id[]" value="<?php echo e($row->id); ?>" />    
    
<div class="col-sm-4">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="<?php echo e($row->key); ?>"><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-7">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="value[]" placeholder="Value" value="<?php echo e($row->value); ?>"><label for="floatingInput">Value</label>
</div>
</div>

<div class="col-sm-1 mt-3"><a href="javascript:void(0)" data-toggle="tooltip" title="Remove this" class="text-danger" onClick="removeElement(this),removeCategoryAttribute('<?php echo e($row->id); ?>');"><i class="fas fa-minus-circle"></i></a></div>
</div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>

<div id="more_attributes"></div>

<div class="row">
 <div class="col-lg-3 offset-lg-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>     
 </div>    
</div>

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/category-attribute.blade.php ENDPATH**/ ?>