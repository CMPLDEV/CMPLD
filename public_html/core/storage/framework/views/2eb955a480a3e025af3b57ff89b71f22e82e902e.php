

<?php $__env->startSection('title','Ticket System | User Panel'); ?>
<?php $__env->startSection('description','Ticket System | User Panel'); ?>
<?php $__env->startSection('keywords','Ticket System | User Panel'); ?>

<?php $__env->startSection('content'); ?>

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<div class="card">
<div class="card-body">
<div class="mt-3">
<div class="row">
 <div class="col-lg-8">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-10">
 <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('userpanel.ticket.search')); ?>">
    <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">

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
  <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
  </div>
  <?php if(isset($search_keyword) || isset($status)): ?>
     <a href="<?php echo e(route('userpanel.ticket')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="fa fa-filter"></i></a>
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
 <div class="col-lg-4">
  
 <div class="input-group mb-3">
  <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="Serial No." />
  <button class="btn btn-success" type="button" onClick="raiseTicket();">Raise a ticket</button>
 </div>
   
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
    <th scope="col">S.No</th>
    <th scope="col">Ticket no</th>
    <th scope="col">Contract No</th>
    <th scope="col">Subject</th>
    <th scope="col">Status</th>
    <!-- <th scope="col">Action</th> -->
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <th scope="row"><?php echo e(++$i); ?></th>
    <td>#<?php echo e($row->id); ?></td>
    <td> <?php echo e($row->serial_no); ?> </td>
    <td> <a href="javascript:void(0);" onClick="viewTicket('<?php echo e($row->id); ?>');"> <?php echo e($row->subject); ?> <i class="fa fa-arrow-right"></i> </a> </td>
    <td> <span class="<?php echo e(ticketStatusColor($row->status)); ?> fw-bold"><?php echo e($row->status); ?></span> </td>

    <!-- <td>
      <a href="<?php echo e(route('page.edit',$row->id)); ?>" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a>
    </td> -->
  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 
</div> 
</div>
</form>
<?php echo e($data->appends($_GET)->links()); ?>

<?php else: ?>

<div class="alert alert-danger alert-dismissible fade show w-100 m-auto" role="alert">
<i class="bi bi-exclamation-octagon me-1"></i>No Record Found!
</div>

<?php endif; ?>

</div>
</div>    
</div>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/ticket.blade.php ENDPATH**/ ?>