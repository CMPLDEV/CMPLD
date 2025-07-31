
<?php $__env->startSection('title','Return & Refund'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Return & Refund</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Return & Refund</li>
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
<form action="<?php echo e(route('return.refund.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Order ID</th>
    <th scope="col">Product</th>
    <th scope="col">Reason</th>
    <th scope="col">Status</th>
    <th scope="col">Refund Status</th>
    <th scope="col">User</th>
    <th scope="col">Extra</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></th>
    <td>#<?php echo e($row->order_id); ?></td>
    <td width="200"><a href="<?php echo e(url(Str::slug($row->item_name).'.html')); ?>" target="_blank"><?php echo e($row->item_name); ?></a></td>
    <td><?php echo e($row->reason); ?></td>
   <td><?php echo returnStatus($row->status); ?></td>
   <td>
    <?php echo refundStatus($row->refund_status); ?></span> 
    <?php if($row->status == 3 && $row->refund_status != 'REFUNDED'): ?>
    </br></br>
    <select class="form-control" name="refund_status" onChange="updateRefundStatus('<?php echo e($row->id); ?>',this.value);">
     <option value="">Update status</option>    
     <option value="IN_PROCESS">IN_PROCESS</option>
     <option value="REFUNDED">REFUNDED</option>
    </select>
    <?php endif; ?>
   </td>
   <td>
    <?php echo e(user($row->user_id)->name); ?> </br>
    <?php echo e(user($row->user_id)->email); ?>

   </td>
   <td>
     <a href="javascript:void(0);" class="text-secondary" data-bs-toggle="tooltip" title="<?php echo e($row->description); ?>"><i class="icon nav-icon" data-feather="eye"></i></a>
     <?php if(!empty($row->image)): ?>
      &nbsp;
      <a href="uploaded_files/return_refund/<?php echo e($row->image); ?>" target="_blank" class="text-secondary"><i class="icon nav-icon" data-feather="paperclip"></i></a>
     <?php endif; ?>
     </br>
     <?php echo e(date('d-m-Y',strtotime($row->created_at))); ?>

   </td>

  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <input type="submit" name="req_for" value="IN_PROCESS" class="btn btn-primary req_for btn-sm">
 <input type="submit" name="req_for" value="APPROVED" class="btn btn-success req_for btn-sm">
 <input type="submit" name="req_for" value="REJECTED" class="btn btn-danger req_for btn-sm">
 <?php if(canDelete()): ?>  
 <input type="submit" name="req_for" value="Delete" class="btn btn-outline-danger req_for btn-sm float-end">
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
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/return-refund.blade.php ENDPATH**/ ?>