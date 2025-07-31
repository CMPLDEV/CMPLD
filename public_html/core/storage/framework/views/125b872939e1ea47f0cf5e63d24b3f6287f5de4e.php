

<?php $__env->startSection('title','Order | User Panel'); ?>
<?php $__env->startSection('description','Order | User Panel'); ?>
<?php $__env->startSection('keywords','Order | User Panel'); ?>

<?php $__env->startSection('content'); ?>

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-lg-9">
<div class="dashboard-box">

<?php if($data->isNotEmpty()): ?>
<div class="order-box">
<div class="row">
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>     
 <div class="col-sm-6 col-12 mb-3 mb-sm-0">
<div class="card">
<div class="card-header">
 <div class="row">
<div class="col text-center order_no">
<span class="status" >#<?php echo e($row->id); ?></span></div>
<div class="col text-center"><?php echo orderStatus($row->delivery_status); ?></div>
</div>    
</div>
      
<div class="card-body p-0">

<div class="container p-0" id="order-body">
    
  <div class="column">
   <b>Payment Status : </b> <?php echo e($row->payment_status); ?>   
  </div>

  <div class="column">
   <b>Payment Mode : </b> <?php echo e($row->sub_type); ?>   
  </div>
 
 <?php if($row->discount > 0): ?> 
  <div class="column">
  <b>Discount :</b> - <?php echo e(currency().$row->discount); ?>   
  </div>
 <?php endif; ?> 

 <div class="column">
  <b>Created At :</b> <?php echo e(date('d-m-Y @ h:i A', strtotime($row->created_at))); ?>  
 </div>
 
 <?php if(!empty($row->return_applicable_date) && $row->return_applicable_date >= date('Y-m-d')): ?>
  <div class="column">
   <b>Applicable for return till :</b> <?php echo e(date('d-m-Y', strtotime($row->return_applicable_date))); ?>  
  </div>
 <?php endif; ?>
 
</div>    
   
<h6 class="h5 p-2"><?php echo e(currency().$row->net_amount); ?> for <?php echo e(totalOrderItems($row->id)); ?> item(s)</h6>

</div>

<div class="card-footer p-0 m-0">
 
 <div class="grid-container">
  <div class="grid-item">
   <a href="<?php echo e(route('userpanel.order.detail',$row->id)); ?>" class="btn-block s-btn s-btn-2 w-100">View Order</a>
  </div>
 <?php if($row->delivery_status=="PENDING"): ?> 
  <div class="grid-item">
   <a href="javascript:void(0);" onClick="cancelOrder('<?php echo e($row->id); ?>');" class="btn-block s-btn s-btn-2 bg-danger w-100">Cancel Order</a>
  </div>
 <?php endif; ?> 
 <?php if($row->delivery_status=="CANCELLED"): ?>
  <p class="mt-2"><strong><a href="javascript:void(0);" title="<?php echo e($row->cancel_note); ?>" class="text-danger">View Cancel Note</a></strong>  </p>
 <?php endif; ?>
 </div>    

</div>     
   
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>    

</div>
<br>
<?php echo e($data->appends($_GET)->links()); ?>

<?php else: ?>
<h4 class="text-center text-capitalize" style="font-size: 13px">
 <img src="assets/img/order.webp" alt="No Order Available" class="empty">
 <br>
 No Order Available in your account.</h4>
 <br>
 <a href="" class="order-explore-bt">Explore Now</a>
<?php endif; ?>

</div>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/user/order.blade.php ENDPATH**/ ?>