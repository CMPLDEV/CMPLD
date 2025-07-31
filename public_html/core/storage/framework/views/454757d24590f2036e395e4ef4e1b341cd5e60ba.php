
<?php $__env->startSection('title','Enquiry List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Enquiry List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Enquiry List</li>
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
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-7">

  </div>
 </div> 


 </div>
 <div class="col-lg-3">
 <!-- <a href="<?php echo e(route('page.add')); ?>" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="ri-add-circle-line"></i> Add new</a> -->
</div> 
</div>
</div>

<?php if($data->isNotEmpty()): ?>
<hr>
<form action="<?php echo e(route('enquiry.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">User Info</th>
    <th scope="col">Source</th>
    <th scope="col">Enquiry Info</th>
    <th scope="col">Created At</th>
    <!-- <th scope="col">Action</th> -->
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></th>
    <td>
      <p> 
       <i class="fas fa-user"></i> <?php echo e($row->name); ?> <br>
       <i class="fas fa-envelope"></i> <?php echo e($row->email); ?> <br>
       <i class="fas fa-phone"></i> <?php echo e($row->mobile); ?>

      </p>
    </td>

    <td> <a href="<?php echo e($row->source); ?>"><?php echo e($row->source); ?></a> </td>

    <td>
      <p> 
       <?php if(!empty($row->subject)): ?> <b> Subject :</b> <?php echo e($row->subject); ?> <br> <?php endif; ?>
       <b> Message :</b> <?php echo e($row->message); ?> <br>
      </p>
    </td>
    
    <td> <?php echo e(date('d-m-Y',strtotime($row->created_at))); ?> </td>

    <!-- <td>
      <a href="<?php echo e(route('page.edit',$row->id)); ?>" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a>
    </td> -->
  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/enquiry.blade.php ENDPATH**/ ?>