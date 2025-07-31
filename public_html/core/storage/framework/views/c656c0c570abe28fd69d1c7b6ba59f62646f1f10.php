

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-3" style="background-image:url('assets/img/cart-banner.jpg');">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-center"> 
<h3>Cart</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center">
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Cart</li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<section class="cart-wrap">
<style>
.breadcrumb-area-3{
padding:80px 0;
}

.breadcrumb-wrapper-2 h3 {
color: #ffffff;
font-size: 40px;
letter-spacing: 1px;
}

.breadcrumb-wrapper-2 .breadcrumb-item.active{
color:#ffffff;
}

.cart-area{padding:50px 0;}
.cart-product{
position: relative;
background-color: #fff;
padding: 20px;margin-bottom:20px;
display: flex;
border-radius: 10px;
box-shadow: 0px 0px 5px 0px lightgrey;}  
.cart-img {
width: 25%;
height: 110px;
display: flex;
overflow: hidden;
margin-right: 10px;
}
.cart-img img{overflow: hidden;
max-height: 110px;margin: auto;
max-width: 100px;}
.cart-detail {width: 75%;margin-left: 6px;}
.cart-prd-name{color: black;
margin-right: 10px;
font-size: 12px;
overflow: hidden;
display: block;
height: 40px;
line-height: 18px;}
.cart-price{font-size: 12px;}
.ttl{font-weight: 700;
color: #00a0e3;
margin: auto;
font-size: 18px;}
.action{position: absolute;
right: 0px;
top: 0;
/*background-color: red;*/
width: 35px;
height: 30px;
border-radius: 0 10px 0 0;
text-align: center;
display: flex;}
.action a{margin: auto;} 
.cart-amount{background-color:#fff;padding:20px;}
.hd{font-weight: 700;
text-transform: uppercase;
padding: 12px;
font-size: 16px;
border-radius: 0;
margin-bottom: 20px;
background-color: #e2e2e2;
color: #00a0e3;}
.cart-txt{font-style: italic;
font-size: 13px;
padding: 0 15px;}
.cart-input{display:flex;margin-bottom:30px;}
.btcart{height: 100%;
background-color: #00a0e3;
color: #fff;
border-radius: 0;
font-size: 14px;
text-transform: uppercase;
white-space: nowrap;
}
.card{border: none !important;}
.btcart i{font-size:20px;}
.btcart:hover{color:#fff;}
.cart-list{padding-left: 0;
list-style: none;}
.cart-list li{
padding-bottom: 1rem;
padding-top: 1rem;
justify-content: space-between;
display: flex;
border-bottom: 1px solid #dee2e6;    }
.proceed {
background: linear-gradient(2deg, #04648d, #00a0e3);
margin: 20px 0;
width: 100%;
padding: 12px;
color: #fff;
text-transform: uppercase;
border: 0;
}
.proceed:hover{color:#fff;}
</style> 

<?php if($carts->isNotEmpty()): ?> 
<div class="cart-area" style="background-color: #f8f8f8;">
<div class="container">
<div class="row">
<div class="col-lg-8">
<div class="row">
<!-- start product card -->
<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-6">
<div class="cart-product">
<div class="cart-img">
<img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>">   
</div>
<div class="cart-detail">
<a href="<?php echo e(productURL($row->slug)); ?>" class="cart-prd-name">
<?php echo e($row->name); ?> </a>
<div class="cart-price"><?php echo e(currency()); ?> <?php echo e($row->price); ?>/- </div>
<div class=" product-quantity">
<!--<div class="tg-quantityholder cart-quantity" style="padding: 5px;-->
<!--    width: 162px;">-->
<!--<em class="minus cart-minus" onClick="decrementQty('<?php echo e($row->id); ?>',this.value);">-</em>-->
<!--<input type="text" class="result cart-result" id="quantity<?php echo e($row->id); ?>" name="quantity" value="<?php echo e($row->quantity); ?>" min="1" readonly>-->
<!--<em class="plus cart-plus" onClick="incrementQty('<?php echo e($row->id); ?>',this.value);">+</em>-->
<!--</div>-->
<div class="cart-plus-minus position-relative my-2">
<div class="dec qtybutton" onClick="decrementQty('<?php echo e($row->id); ?>',this.value);">-</div>    
<input class="cart-plus-minus-box" type="text" name="qtybutton" value="<?php echo e($row->quantity); ?>" id="qty<?php echo e($row->id); ?>" readonly="">
<div class="inc qtybutton" onClick="incrementQty('<?php echo e($row->id); ?>',this.value);">+</div>
</div>
<span class="ttl"><?php echo e(currency()); ?> <?php echo e($row->price*$row->quantity); ?>/-</span>
</div>
</div>
<div class="action">
<a href="<?php echo e(route('cart.remove',$row->id)); ?>" class="cart-remove"><img src="assets/img/svgviewer-output.svg" alt=""></a>
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
<!-- end product card -->
<!-- start apply coupon code -->
<div class="col-lg-8">
<div class="hd">Coupon code</div>    
<p class="cart-txt">If you have a coupon code, please enter it in the box below</p>
<?php if(auth()->guard()->check()): ?>    
<?php if($coupon = couponCondition()): ?>
<?php $coupon_code = \App\Models\Coupon::find($coupon->coupon_id); ?>

<div class="input-group">
<input type="text" disabled value="<?php echo e($coupon_code->code); ?>" class="form-control">
<div class="input-group-btn">
<a class="btn" onClick="return confirm('Are you sure?');" href="<?php echo e(route('coupon.remove',$coupon->id)); ?>"> <i class="fa fa-times-circle"></i> </a>
</div>
</div>
<br>
<?php else: ?>
<form method="POST" action="<?php echo e(route('coupon.apply')); ?>">
<div class="cart-input">
<?php echo csrf_field(); ?>  
<input type="text" placeholder="Coupon Code" name="code" class="form-control border-0 <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
<div class="input-group-append border-0">
<button type="submit" class="btn btcart"><i class="fa fa-gift mr-2"></i> &nbsp; Apply coupon</button>
</div>
</div>
<?php $__errorArgs = ['code'];
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
<?php endif; ?> 

<?php else: ?>

<form method="POST" action="<?php echo e(route('coupon.apply')); ?>">
<div class="cart-input">
<?php echo csrf_field(); ?>  
<input type="text" placeholder="At first please login." name="code" class="form-control border-0 <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" disabled>
<div class="input-group-append border-0">
<button type="submit" class="btn btcart" disabled><i class="fa fa-gift mr-2"></i> &nbsp; Apply coupon</button>
</div>
</div>
<?php $__errorArgs = ['code'];
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

<?php endif; ?> 
</div>
<!-- end apply coupon code -->
</div>
</div>
<div class="col-lg-4">
<div class="cart-amount">


<div class="hd">Order summary </div>
<p class="cart-txt">Shipping and additional costs are calculated based on values you have entered.</p>
<ul class="cart-list">
<li><strong class="text-muted">Order Subtotal </strong><strong> <?php echo e(currency()); ?> <?php echo e(cartTotal()); ?></strong></li>
<?php if(auth()->guard()->check()): ?>
<?php if($coupon = couponCondition()): ?>
<li><strong class="text-muted">Discount (%)</strong><strong> <?php echo e(currency()); ?> <?php echo e(couponAmount($coupon->coupon_id)); ?></strong>
</li>
<?php endif; ?>
<?php endif; ?>
<li><strong class="text-muted">Total</strong>
<h5 class="font-weight-bold"><?php echo e(currency()); ?> <?php echo e(checkoutTotal()); ?></h5>
</li>
</ul>  

<a <?php if(auth()->guard()->check()): ?> href="<?php echo e(route('checkout')); ?>" <?php else: ?> href="<?php echo e(route('login')); ?>" <?php endif; ?> class="btn bt-cart proceed">Proceed to checkout</a>
</div>    


</div>
</div>
<!-- start coupon code -->
<div class="mt-3">
<?php if(coupons()->isNotEmpty()): ?>
<div class="row">
<?php $__currentLoopData = coupons(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-4">
<div class="coupon">
<div class="first">
<span> <?php echo e($row->code); ?> </span>    
</div> 
<div class="second">
<div class="card">
<div class="card-header">Valid For Both Prepaid/COD ORDER</div>
<div class="card-body">
<span>SAVE <?php echo e($row->amount); ?>%</span> <?php echo e($row->content); ?></div>
</div>  
</div>    

</div> 
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>       
</div>
<?php endif; ?>
</div>
<!-- start coupon code -->
</div>
</div>
<?php else: ?>
<div class="cart-area">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="text-center">
<img src="assets/img/empty-cart-illustration.gif" alt="Empty Cart" style="max-width: 390px;width: 100%;">
<p>Your Shopping Bag is Empty!!</p>
<p>Please add something soon, carts have feelings too.</p>
<a href="" class="update-btn">Coutinue Shopping</a>
</div>
</div>
</div>  
</div>
</div>
<?php endif; ?> 
</section> 

</main>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/cart.blade.php ENDPATH**/ ?>