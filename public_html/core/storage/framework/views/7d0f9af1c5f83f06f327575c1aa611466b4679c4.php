
<?php $__env->startSection('title','Order List'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Order List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Order List</li>
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

  <div class="col-lg-9">
 <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('order.search')); ?>">
  <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">

 <select name="type" id="type" class="form-control">
   <option value="">Payment Type</option> 
   <option value="COD" <?php if(isset($type)): ?> <?php if($type=="COD"): ?> selected <?php endif; ?> <?php endif; ?>>COD</option> 
   <option value="PREPAID" <?php if(isset($type)): ?> <?php if($type=="PREPAID"): ?> selected <?php endif; ?> <?php endif; ?>>PREPAID</option> 
 </select>

 <select name="status" class="form-control">
   <option value="">Choose Status</option> 
   <option value="PENDING" <?php if(isset($status)): ?> <?php if($status=="PENDING"): ?> selected <?php endif; ?> <?php endif; ?>>PENDING</option> 
   <option value="DELIVERED" <?php if(isset($status)): ?> <?php if($status=="DELIVERED"): ?> selected <?php endif; ?> <?php endif; ?>>DELIVERED</option>
   <option value="SHIPPED" <?php if(isset($status)): ?> <?php if($status=="SHIPPED"): ?> selected <?php endif; ?> <?php endif; ?>>SHIPPED</option>
   <option value="CANCELLED" <?php if(isset($status)): ?> <?php if($status=="CANCELLED"): ?> selected <?php endif; ?> <?php endif; ?>>CANCELLED</option>
   <option value="PAID" <?php if(isset($status)): ?> <?php if($status=="PAID"): ?> selected <?php endif; ?> <?php endif; ?>>PAID</option>
   <option value="UNPAID" <?php if(isset($status)): ?> <?php if($status=="UNPAID"): ?> selected <?php endif; ?> <?php endif; ?>>UNPAID</option> 
 </select>

 <input type="text" class="form-control <?php $__errorArgs = ['from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Date From" name="from" <?php if(isset($from)): ?> value="<?php echo e($from); ?>" <?php endif; ?> onClick="$(this).attr('type','date');">

 <input type="text" class="form-control <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Date To" name="to" <?php if(isset($to)): ?> value="<?php echo e($to); ?>" <?php endif; ?> onClick="$(this).attr('type','date');">

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
  <?php if(isset($search_keyword) || isset($from) || isset($to) || isset($type) || isset($status)): ?>
     <a href="<?php echo e(route('admin.order')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
  
  <div class="col-lg-1">
   <button type="button" class="btn btn-dark" onClick="exportOrder();">Export</button>      
  </div>
  
 </div> 


 </div>

</div>
</div>

<?php if($data->isNotEmpty()): ?>
<hr>
<form action="<?php echo e(route('order.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Order Info</th>
    <th scope="col">Amount</th>
    <th scope="col">User Info</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></th>
    
    <td>
      <p> 
       ID: <a href="<?php echo e(route('order.detail',$row->id)); ?>">#<?php echo e($row->id); ?></a> <br>
       Type: <?php echo e($row->type); ?> - <?php echo e($row->sub_type); ?> <br>
     <?php if(!empty($row->gateway_order_id)): ?>
      Gateway Order ID: <?php echo e($row->gateway_order_id); ?> <br>
     <?php endif; ?>
     <?php if(!empty($row->gateway_payment_id)): ?>
      Transaction ID: <?php echo e($row->gateway_payment_id); ?> <br>
     <?php endif; ?>
     <?php if($row->coupon != ''): ?>
      Coupon: <?php echo e($row->coupon); ?> <br>
     <?php endif; ?>  
      Tracking No: <?php echo e($row->tracking_no); ?> 
      <a class="text-secondary" href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="updateTrackingNo('<?php echo e($row->id); ?>');"><i class="icon nav-icon" data-feather="edit"></i></a>
     <?php if($row->user_id==0): ?>
      <br/>
      <span class="badge bg-danger">GUEST</span> 
     <?php endif; ?>
    </p>
    </td>

    <td>
      <p> 
       Amount: <?php echo e(setting()->currency.$row->amount); ?> <br>
      <?php if($row->discount): ?> Discount: -<?php echo e(setting()->currency.$row->discount); ?> <br>
      <?php endif; ?>
       Net Amount: <?php echo e(setting()->currency.$row->net_amount); ?>

      </p>
    </td>
    
    <td>
      <p> 
       <i class="fas fa-user"></i>: <?php echo e($row->name); ?> <br>
       <i class="fas fa-envelope"></i>: <?php echo e($row->email); ?> <br>
       <i class="fas fa-phone"></i>: <?php echo e($row->mobile); ?>

      </p>
    </td>

    <td>
      <p> 
       Delivery Status: <span class="badge bg-primary"><?php echo e($row->delivery_status); ?></span> <br>
       Payment Status: <span class="badge bg-dark text-white"><?php echo e($row->payment_status); ?></span> <br>
      <?php if(!empty($row->cancel_note)): ?>  
       <b>Cancel Note: </b><?php echo e($row->cancel_note); ?> <br>
       <b>Cancelled by: </b><?php echo e($row->cancelled_by); ?>

      <?php endif; ?>
      </p>
    </td>

    <td> 
    <?php if(isInvoice($row->id)): ?> 
    <a target="_blank" href="<?php echo e(route('order.viewinvoice',$row->id)); ?>" data-bs-toggle="tooltip" title="View Invoice"><i class="icon nav-icon" data-feather="file-text"></i></a>
     &nbsp;&nbsp;  
    <a class="text-danger" href="<?php echo e(route('order.removeinvoice',$row->id)); ?>" data-bs-toggle="tooltip" title="Remove Invoice" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="file-text"></i></a>
    <?php else: ?>
     <a href="<?php echo e(route('order.generateinvoice',$row->id)); ?>" data-bs-toggle="tooltip" title="Generate Invoice" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="file"></i></a>
    <?php endif; ?>
    &nbsp;
  
  <?php if($row->delivery_status!="CANCELLED"): ?>  
    <a class="text-warning" data-bs-toggle="collapse" data-bs-target="#cancel<?php echo e($row->id); ?>" title="Cancel Order"><i class="icon nav-icon" data-feather="slash"></i></a>
    <div id="cancel<?php echo e($row->id); ?>" class="collapse">
     <h5>Cancel Note:</h5>   
     <input type="text" class="form-control mb-1" name="cancel_note" id="cancel_note<?php echo e($row->id); ?>" placeholder="Write cancel note" value="<?php echo e($row->cancel_note); ?>" maxlength="200">
     <button type="button" class="btn btn-danger btn-sm" onClick="cancelNoteSubmit('<?php echo e($row->id); ?>');">Cancel</button>
  </div>
  <?php endif; ?>
  &nbsp;
  <?php if(empty($row->tracking_no)): ?>
  <a class="text-info" href="javascript:void(0);" data-bs-toggle="tooltip" title="Shipping" onClick="shipping('<?php echo e($row->id); ?>');"><i class="icon nav-icon" data-feather="truck"></i></a>
  <?php endif; ?>
  
    <br>
    <?php echo e(date('d-m-Y @ h:i A',strtotime($row->created_at))); ?>


    </td> 
  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">

 <input type="submit" name="req_for" value="PENDING" class="btn btn-outline-warning req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="DELIVERED" class="btn btn-outline-primary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="SHIPPED" class="btn btn-outline-success req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="PAID" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="UNPAID" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;

 <?php if(canDelete()): ?>  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm">
 <?php endif; ?> 

 <span class="badge bg-danger p-2 float-end" style="font-size:15px;">Order Total: <?php echo e(setting()->currency.' '.$order_sum); ?></span>

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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/order.blade.php ENDPATH**/ ?>