

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<section class="od-cfm-sec">
<div class="container">
<div class="od-cfm-box">
<h2> Thank you for your order </h2>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
 <h3 class="success-green">#<?php echo e($order->id); ?> Your order is confirm</h3>
 <p>You'll receive a confirmation email with your number shortly</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<h3>Order Updates</h3>
<p>You'll get shipping and delivery updates by email.</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<p>Thankyou! Tracking details will be sent on your mail once the parcel shipped within 24-28 hours</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<h3>Customer Information</h3>
<div class="customer-info">
<div class="ct-bx-1 common-box">
<h4>Contact Information</h4>
<span><?php echo e($order->email); ?></span>
<span><?php echo e($order->mobile); ?></span>
<h4>Shipping Address</h4>
<span><?php echo e($order->address); ?> <?php echo e($order->city); ?> - <?php echo e(state($order->state)); ?> <?php echo e(country($order->country)); ?> - <?php echo e($order->pincode); ?></span>
</div>
<div class="ct-bx-1 common-box">
<h4>Payment Method & Status</h4>
<span><?php echo e($order->type); ?> - <?php echo e($order->payment_status); ?></span>
<h4>Amount</h4>
<span><?php echo e(setting()->currency); ?> <?php echo e($order->net_amount); ?></span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="main-od-box">
<?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
<div class="od-mainbx">
<div class="od-img">
    
<img <?php if(!empty(products($row->item_id))): ?> src="<?php echo e(showImage(products($row->item_id)->image,'uploaded_files/product')); ?>" <?php else: ?> src="<?php echo e(noImage()); ?>" <?php endif; ?> alt="<?php echo e($row->item_name); ?>" title="<?php echo e($row->item_name); ?>">

</div>
<div class="od-info">
<p><?php echo e($row->item_name); ?></p>
<div class="od-qty">
<span>Qty:<?php echo e($row->item_qty); ?></span>
</div>
</div>
<div class="od-price">
<span><?php echo e(setting()->currency); ?><?php echo e($row->item_net_price); ?></span>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<div class="sub-box">
<div class="sub-tt">
<div class="sub-head">
    <p>Subtotal</p>
</div>
<div class="sub-price">
<span><?php echo e(setting()->currency); ?></span>
<span><?php echo e($order->amount); ?></span>
</div>
</div>
<div class="sub-tt">
<div class="sub-head">
 <p>Discount</p>
</div>
<div class="sub-price">
<span>-<?php echo e(setting()->currency); ?></span>
<span><?php echo e($order->discount); ?></span>
</div>
</div>
</div>
<div class="od-tt">
<div class="tt-bx">
<div class="tt-bx-head">
 <p>Total</p>
</div>
<div class="tt-bx-pc">
 <span><?php echo e(setting()->currency); ?> <?php echo e($order->net_amount); ?></span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="conti-button text-center">
<a href="" class="btn conti-btn">Continue Shopping</a>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/payment/success.blade.php ENDPATH**/ ?>