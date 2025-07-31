
<?php $__env->startSection('title','Product Offer'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product Offer</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product Offer</li>
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
<div class="mt-3">
<div class="row">
 <div class="col-lg-10">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-7">

  </div>
 </div>
 </div>
 <div class="col-lg-2">

 <a href="<?php echo e(route('product.offer.add',$product->id)); ?>" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="icon nav-icon" data-feather="plus"></i></a>
 
 <a href="<?php echo e(route('product')); ?>" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="Go back"> Back</a>

 </div> 
</div>
<div class="text-muted pt-1"> Showing <?php echo e($data->firstItem()); ?> to <?php echo e($data->lastItem()); ?> of <?php echo e($data->total()); ?> &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>
<hr>
<?php if($data->isNotEmpty()): ?>
<hr>
<form action="<?php echo e(route('product.offer.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Name</th>
    <th scope="col">Order</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></td>
    <td><?php echo e($row->name); ?> </td>
    
    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="<?php echo e($row->id); ?>"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="<?php echo e($row->order_by); ?>" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>

    <td> <?php echo statusBadge($row->status); ?> </td>
    <td>
     
      <a href="<?php echo e(route('product.offer.edit',[$product->id,$row->id])); ?>" data-bs-toggle="tooltip" title="Edit"> <i class="fa fa-edit"></i></a>
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>


<div class="card">
 <div class="card-footer"> 
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Update Order" class="btn btn-outline-warning req_for btn-sm">
 <?php if(canDelete()): ?>  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
 <?php endif; ?> 
</div> 
</div>

</form>
<?php echo e($data->appends($_GET)->links()); ?>

<?php else: ?>

<div class="alert alert-danger alert-dismissible fade show w-50 m-auto" role="alert">
<i class="bi bi-exclamation-octagon me-1"></i>No Record Found!
</div>

<?php endif; ?>

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/product-offer.blade.php ENDPATH**/ ?>