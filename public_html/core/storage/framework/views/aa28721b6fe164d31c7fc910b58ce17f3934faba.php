

<?php $__env->startSection('title','Order Detail | User Panel'); ?>
<?php $__env->startSection('description','Order Detail | User Panel'); ?>
<?php $__env->startSection('keywords','Order Detail | User Panel'); ?>

<?php $__env->startSection('content'); ?>

<section class="user-wrap">
<div class="container">
    
<div class="row">
<div class="col-lg-3 p-0">
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-lg-9">
    
<div class="dashboard-box">

<h4>Order no: <?php echo e($order->id); ?> 

<a href="<?php echo e(route('userpanel.order')); ?>" class="btn btn-info btn-sm text-white float-end">Back</a>    
</h4>

<hr/>

<div class="outer-top row"> 
<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">Delivery Address</h5>
 <div class="mt-3">
 <h6> <?php echo e($order->name); ?> </h6>
 <p><?php echo e($order->address); ?> <?php echo e($order->city); ?>, <?php echo e(state($order->state)); ?> <?php echo e($order->pincode); ?> - <?php echo e(country($order->country)); ?></p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span><?php echo e($order->mobile); ?></span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span><?php echo e($order->email); ?></span>
 </div>    
</div>


<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">Shipping Address</h5>
 <div class="mt-3">
<?php if(!empty($order->shipping_address)): ?>
 <h6> <?php echo e($order->shipping_name); ?> </h6>
 <p><?php echo e($order->shipping_address); ?> <?php echo e($order->shipping_city); ?>, <?php echo e(state($order->shipping_state)); ?> <?php echo e($order->shipping_pincode); ?> - <?php echo e(country($order->shipping_country)); ?></p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span><?php echo e($order->shipping_mobile); ?></span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span><?php echo e($order->shipping_email); ?></span>
<?php else: ?>
 <h6> <?php echo e($order->name); ?> </h6>
 <p><?php echo e($order->address); ?> <?php echo e($order->city); ?>, <?php echo e(state($order->state)); ?> <?php echo e($order->pincode); ?> - <?php echo e(country($order->country)); ?></p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span><?php echo e($order->mobile); ?></span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span><?php echo e($order->email); ?></span>
<?php endif; ?>
 </div>
</div>


<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">More Actions</h5>
 <?php if(!empty($invoice)): ?>
 <div class="d-flex justify-content-between align-item-center my-1 mt-3">
 <div class="d-flex">
  <i class="d-inline fad fa-file-pdf" style="--fa-primary-color: #b0b210; --fa-secondary-color: #b0b210;"></i>
  <h6 style="margin-left:5px">Download Invoice</h6>
  </div>
 <div><a href="<?php echo e(route('userpanel.order.viewinvoice',$order->id)); ?>" class="btn btn-primary btn-sm" download>Download</a></div>
 </div>
  <?php else: ?>
  <div class="d-flex justify-content-between align-item-center my-1 mt-3">
   <small>No action available</small>
  </div> 
 <?php endif; ?>
</div>

</div>

<div class="row mt-4">
<?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
 <?php $product = \App\Models\Product::find($row->item_id, ['image','slug']); ?>
 <div class="col-lg-6 col-12 mb-3">
<div class="row prodcard">
 <div class="col-4">
 <div class="img-container"><a <?php if(!empty($product)): ?> href="<?php echo e(productURL($product->slug)); ?>" <?php endif; ?> target="_blank"><img <?php if(!empty($product)): ?> src="<?php echo e(showImage($product->image, 'uploaded_files/product')); ?>" <?php else: ?> src="admin_assets/images/no-image.png" <?php endif; ?> width="100%"></a></div>
 </div>
 <div class="col-8">
 <div class="card-body">
 <h6 class="card-title"><a <?php if(!empty($product)): ?> href="<?php echo e(productURL($product->slug)); ?>" <?php endif; ?> target="_blank"><?php echo e(Str::limit($row->item_name, 60, $end='..')); ?></a></h6>
 <br/>
 <a <?php if(!empty($product)): ?> href="<?php echo e(productURL($product->slug)); ?>" <?php endif; ?> target="_blank">
<?php if(!empty($row->item_sku)): ?> <p class="float-start"> <b>SKU :</b> <?php echo e($row->item_sku); ?> </p> <?php endif; ?>
 <p class="float-start"> <b>Price :</b> <?php echo e(currency().$row->item_unit_price); ?> x <?php echo e($row->item_qty); ?> = <?php echo e(currency().$row->item_net_price); ?> </p>
 <p class="float-start"> <b>Warranty :</b> <?php echo e(date('d-m-y', strtotime($row->warranty_start))); ?> to <?php echo e(date('d-m-y', strtotime($row->warranty_end))); ?> </p>
 </a>
 </div>
 </div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>


</div>

</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/order-detail.blade.php ENDPATH**/ ?>