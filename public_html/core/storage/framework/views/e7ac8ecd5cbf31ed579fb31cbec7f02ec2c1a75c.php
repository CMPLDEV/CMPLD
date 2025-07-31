
<?php $__env->startSection('title','Ticket List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Ticket List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Ticket List</li>
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
 <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('ticket.search')); ?>">
    <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">
 <?php if(isAdmin()): ?>
 <select class="form-control" name="admin_id">
   <option value="">Choose user</option> 
   <option value="0" <?php if(isset($admin_id)): ?> <?php if($admin_id == 0): ?> selected <?php endif; ?> <?php endif; ?>>Admin</option>
   <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($row->id); ?>" <?php if(isset($admin_id)): ?> <?php if($admin_id == $row->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <?php else: ?>
  <input type="hidden" name="admin_id" value="<?php echo e(admin()->id); ?>" />
 <?php endif; ?>
 <select name="status" id="filter" class="form-control">
  <option value="">Status</option>
  <option value="OPEN" <?php if(isset($status)): ?> <?php if($status=="OPEN"): ?> selected <?php endif; ?> <?php endif; ?>>OPEN</option>
  <option value="WORK IN PROGRESS" <?php if(isset($status)): ?> <?php if($status=="WORK IN PROGRESS"): ?> selected <?php endif; ?> <?php endif; ?>>WORK IN PROGRESS</option>
  <option value="SUSPENDED" <?php if(isset($status)): ?> <?php if($status=="SUSPENDED"): ?> selected <?php endif; ?> <?php endif; ?>>SUSPENDED</option>
  <option value="WAITING FOR USER" <?php if(isset($status)): ?> <?php if($status=="WAITING FOR USER"): ?> selected <?php endif; ?> <?php endif; ?>>WAITING FOR USER</option>
  <option value="RESOLVED" <?php if(isset($status)): ?> <?php if($status=="RESOLVED"): ?> selected <?php endif; ?> <?php endif; ?>>RESOLVED</option>
  <option value="CLOSED" <?php if(isset($status)): ?> <?php if($status=="CLOSED"): ?> selected <?php endif; ?> <?php endif; ?>>CLOSED</option>
 </select>

 <input type="text" class="form-control <?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Search" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  <?php if(isset($search_keyword) || isset($status) || isset($admin_id)): ?>
     <a href="<?php echo e(route('ticket')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    <?php endif; ?>
  <?php $__errorArgs = ['search_keyword'];
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
 </form>
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
<form action="<?php echo e(route('ticket.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Ticket no</th>
    <th scope="col">Serial no</th>
    <th scope="col">Subject</th>
    <th scope="col">Status</th>
    <th scope="col">Assigned Person</th>
    <th scope="col">Created At</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></th>
    <td>#<?php echo e($row->id); ?></td>
    <td><?php echo e($row->serial_no); ?></td>
    <td> <a href="<?php echo e(route('ticket.detail',$row->id)); ?>" <?php if($row->is_seen == 0): ?> class="fw-bold" <?php endif; ?>> <?php echo e($row->subject); ?> <i class="fa fa-arrow-right"></i> </a> </td>
    <td> <span class="<?php echo e(ticketStatusColor($row->status)); ?> fw-bold"><?php echo e($row->status); ?></span> </td>
    <td> <?php if($row->admin_id !=0 && !empty(admin($row->admin_id))): ?> <?php echo e(admin($row->admin_id)->name); ?> <?php else: ?> - <?php endif; ?> </td>
    <td> <?php echo e(date('d-m-Y',strtotime($row->created_at))); ?> </td>
  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <div class="row">
 <div class="col-lg-4 col-sm-12">
 <?php if(admin()->type != "SUB_ADMIN"): ?>     
  <div class="input-group mb-3">
  <select class="form-control" name="admin_id" id="admin_id">
   <option value="">Choose user</option> 
   <option value="0">Admin</option>
   <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($row->id); ?>"><?php echo e($row->name); ?></option>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
  <button class="btn btn-success" type="button" onClick="assignTicket();">Assign</button>
 </div> 
 <?php endif; ?>
 </div>
 
 <div class="col-lg-8 col-sm-12">
  <?php if(canDelete()): ?>  
   <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
  <?php endif; ?>      
 </div>
</div>     
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/ticket.blade.php ENDPATH**/ ?>