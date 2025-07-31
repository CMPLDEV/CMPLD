<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e(setting()->comp_name); ?> | Payment</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
 .razorpay-payment-button{display: none !important;}  
 .proceed{background: linear-gradient(2deg, #2c6800, #69d619);
    margin-top: 30vh;
    width: 250px;
    padding: 12px;
    color: #fff;
    text-transform: uppercase;
    border: 0;}
 .proceed:hover{color: #fff;}
</style>

</head>
<body>
<div id="app">
<main class="py-4">
<div class="container">
<div class="row">
<div class="col-md-6 offset-3 col-md-offset-6">
<div style="display:flex;justify-content:center">    
<a class="btn bt-cart proceed" href="<?php echo e(url('/')); ?>">Back to home</a>
</div>
    <form action="<?php echo e(route('checkout.razorpay.proceed')); ?>" method="POST" id="payment-form">
    <?php echo csrf_field(); ?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="<?php echo e(config('app.razorpay')['key_id']); ?>"
            data-amount="<?php echo e($amount); ?>"
            data-name="<?php echo e(setting()->comp_name); ?>"
            data-description="Items Purchased"
            data-image="<?php echo e(asset('uploaded_files/logo/'.setting()->logo)); ?>"
            data-order_id="<?php echo e($razorpay_order_id); ?>"
            data-prefill.name="<?php echo e($order->name); ?>"
            data-prefill.email="<?php echo e($order->email); ?>"
            data-prefill.contact="<?php echo e($order->mobile); ?>"
            data-theme.color="#ff7529">
    </script>
    </form>

</div>
</div>
</div>
</main>
</div>

<script>
 $(document).ready(function(){
   $('#payment-form').submit(); 
 });
</script>

</body>
</html><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/payment/razorpay.blade.php ENDPATH**/ ?>