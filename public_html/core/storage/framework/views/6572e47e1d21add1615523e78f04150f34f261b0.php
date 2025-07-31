
<?php $__env->startSection('title','Brand List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Brand List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Brand List</li>
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
<div class="mt-3">
<div class="row">
 <div class="col-lg-9">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e(brandCount()); ?></span>
  </div>

  <div class="col-lg-7">

  </div>
 </div> 


 </div>
 <div class="col-lg-3">
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="brandModal();"> <i class="ri-add-circle-line"></i> Add new</a>
 </div> 
</div>
</div>

<?php if($data->isNotEmpty()): ?>
<hr>
<form action="<?php echo e(route('brand.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table id="" class="table table-bordered">
<thead>
  <tr>
  <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Image</th>
    <th scope="col">Name</th>
    <th scope="col">Order</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
 $row_st = ($row->status==1) ? 0 : 1;
?>
  <tr>
  <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e($i++); ?> 
    <?php if($row->for_home == 1): ?>  
     <span class="badge bg-warning" title="Home">Home</span>
    <?php endif; ?>
    <?php if($row->is_best == 1): ?> 
     <span class="badge bg-warning" title="Best">Best</span>
    <?php endif; ?>
    <?php if($row->show_support == 1): ?> 
     <span class="badge bg-warning" title="Support">Support</span>
    <?php endif; ?>
  </td>
    <td class="v-align">
     <img src="<?php echo e(asset(showImage($row->image,'uploaded_files/category'))); ?>" alt="<?php echo e($row->name); ?>" width="40" class="rounded">
     
    </td>
    <td><?php echo e($row->name); ?> </td>
    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="<?php echo e($row->id); ?>"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="<?php echo e($row->order_by); ?>" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>
    <td><a href="<?php echo e(route('brand.update.status',[$row->id,$row_st])); ?>" onClick="return confirm('Are you sure?');"><?php echo statusBadge($row->status); ?></a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="brandModal('<?php echo e($row->id); ?>');"><i class="icon nav-icon" data-feather="edit"></i></a>
      &nbsp;
      <a href="<?php echo e(route('brand.software',$row->id)); ?>" data-bs-toggle="tooltip" title="Software Driver" class="btn btn-outline-secondary btn-sm rounded-0">Software Driver (<?php echo e(softwareCount($row->id)); ?>)</a>
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<div class="card">
 <div class="card-footer">
  
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Show Home" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Home" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Show Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Show Support" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Support" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Update Order" class="btn btn-outline-warning req_for btn-sm">
 <?php if(canDelete()): ?>  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
 <?php endif; ?> 
</div> 
</div>

</form>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/brand.blade.php ENDPATH**/ ?>