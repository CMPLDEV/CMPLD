

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

<!-- coupon-area start -->
<section class="coupon-area pt-100 pb-30">
<div class="container">
<div class="row">
<div class="col-md-6">
<?php if(auth()->guard()->guest()): ?>
<div class="coupon-accordion">
<h3>Returning customer? <span id="showlogin"><a href="<?php echo e(route('login')); ?>">Click here to login</a></span></h3>
</div>
<?php endif; ?>
</div>
<div class="col-md-6">
<?php if(auth()->guard()->check()): ?>    
<?php if($coupon = couponCondition()): ?>
<?php $coupon_code = \App\Models\Coupon::find($coupon->coupon_id); ?>
 <div class="input-group">
 <input type="text" class="form-control" disabled value="<?php echo e($coupon_code->code); ?>">
 <a onClick="return confirm('Are you sure?');" href="<?php echo e(route('coupon.remove',$coupon->id)); ?>" class="s-btn s-btn-2"><i class="fa fa-times-circle"></i></a>
</div>
<p><?php echo e($coupon_code->content); ?></p>
<?php else: ?>
 <form method="POST" action="<?php echo e(route('coupon.apply')); ?>">
  <?php echo csrf_field(); ?>     
<div class="input-group">
 <input type="text" class="form-control <?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="code" placeholder="Enter coupon code.">
 <button class="s-btn s-btn-2" type="submit">Apply</button>
</div>
<?php $__errorArgs = ['code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
 <span class="invalid-feedback d-block" role="alert"><?php echo e($message); ?></span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</form>
<?php endif; ?>
 
 <?php else: ?>
  <form method="POST" action="#">
  <?php echo csrf_field(); ?>     
 <div class="input-group">
 <input type="text" class="form-control" name="code" placeholder="At first please login." disabled>
 <button class="s-btn s-btn-2" type="submit" disabled>Apply</button>
</div>
</form>
<?php endif; ?>

</div>
</div>
</div>
</section>
<!-- coupon-area end -->

<!-- checkout-area start -->
<section class="checkout-area">
<div class="container">
<form method="POST" action="<?php echo e(route('checkout.generate.order')); ?>" id="checkout-form">
 <?php echo csrf_field(); ?>
<div class="row">
<div class="col-lg-7 col-12">

<!-- billing details -->
<div class="">
<div class="checkbox-form">
<h3>Billing Details</h3>
<div class="row">
<div class="col-md-4">
<?php if(auth()->guard()->check()): ?>
 <script> 
 $(document).ready(function(){
  checkPincode('<?php echo e(user()->pincode); ?>');     
 });
 </script>
<?php endif; ?>
<div class="checkout-form-list">
<label> GST No </label>
<input type="text" placeholder="Enter GST No" name="gst_no" class="<?php $__errorArgs = ['gst_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->gst_no); ?>" <?php else: ?> value="<?php echo e(old('gst_no')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['gst_no'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Company Name </label>
<input type="text" placeholder="Enter Company Name" name="company_name" class="<?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->company_name); ?>" <?php else: ?> value="<?php echo e(old('company_name')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['company_name'];
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
</div>
</div>

</div>
<div class="row">
<div class="col-md-8">
<div class="checkout-form-list">
<label> Name <span class="required">*</span></label>
<input type="text" placeholder="Full Name" name="name" class="<?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['name'];
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
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>Mobile No <span class="required">*</span></label>
<input type="text" placeholder="Mobile No" name="mobile" class="<?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->mobile); ?>" <?php else: ?> value="<?php echo e(old('mobile')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['mobile'];
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
</div>
</div>
<div class="col-md-12">
<div class="checkout-form-list">
<label>Email Address</label>
<input type="text" placeholder="Email Address" name="email" class="<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->email); ?>" <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['email'];
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
</div>
</div>
<div class="col-md-8">
<div class="checkout-form-list">
<label>Street Address <span class="required">*</span></label>
<input type="text" placeholder="Street Address" name="address" class="<?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->address); ?>" <?php else: ?> value="<?php echo e(old('address')); ?>" <?php endif; ?>>
<?php $__errorArgs = ['address'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Pincode <span class="required">*</span></label>
<input type="text" placeholder="Pincode" name="pincode" class="<?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->pincode); ?>" <?php else: ?> value="<?php echo e(old('pincode')); ?>" <?php endif; ?> onKeyup="checkPincode(this.value);">
 <?php $__errorArgs = ['pincode'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Town / City <span class="required">*</span></label>
<input type="text" placeholder="Town/City" name="city" class="<?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(auth()->guard()->check()): ?> value="<?php echo e(user()->city); ?>" <?php else: ?> value="<?php echo e(old('city')); ?>" <?php endif; ?>>
<?php $__errorArgs = ['city'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Country<span class="required">*</span></label>
<select name="country" id="country" onChange="getStates(this.value);" class="form-control <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
 <option value="">Choose country</option>
 <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(auth()->guard()->check()): ?> <?php if(user()->country == $row->id): ?> selected <?php endif; ?> <?php else: ?> <?php if($row->id == 101): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php $__errorArgs = ['country'];
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
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>State <span class="required">*</span></label>
<select name="state" id="state" class="form-control <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
 <option value="">Choose state</option>
 <?php if(auth()->guard()->check()): ?>
  <?php if(!empty(user()->country)): ?>
  <?php $__currentLoopData = states(user()->country); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(user()->state == $row->id): ?> selected <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>
 <?php else: ?>
 <?php $__currentLoopData = states(101); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(101 == $row->id): ?> selected <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>
</select>
<?php $__errorArgs = ['state'];
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
</div>
</div>



</div>

</div>
</div>

<!-- shipping details -->
<div class="">

<input type="checkbox" name="is_shipping" id="is_shipping" /> 
<label for="is_shipping">Is Shipping address is different from billing address</label>
    
<div class="checkbox-form mt-2 d-none" id="shipping-address">
<h3>Shipping Details</h3>
<div class="row">
<div class="col-md-8">
<div class="checkout-form-list">
<label> Name <span class="required">*</span></label>
<input type="text" placeholder="Full Name" name="shipping_name" class="<?php $__errorArgs = ['shipping_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->name); ?>" <?php else: ?> value="<?php echo e(old('shipping_name')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['shipping_name'];
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
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>Mobile No <span class="required">*</span></label>
<input type="text" placeholder="Mobile No" name="shipping_mobile" class="<?php $__errorArgs = ['shipping_mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->mobile); ?>" <?php else: ?> value="<?php echo e(old('shipping_mobile')); ?>" <?php endif; ?>>
 <?php $__errorArgs = ['shipping_mobile'];
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
</div>
</div>
<div class="col-md-12">
<div class="checkout-form-list">
<label>Email Address</label>
<input type="text" placeholder="Email Address" name="shipping_email" class="<?php $__errorArgs = ['shipping_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->email); ?>" <?php else: ?> value="<?php echo e(old('shipping_email')); ?>" <?php endif; ?>>
  <?php $__errorArgs = ['shipping_email'];
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
</div>
</div>
<div class="col-md-8">
<div class="checkout-form-list">
<label>Street Address <span class="required">*</span></label>
<input type="text" placeholder="Street Address" name="shipping_address" class="<?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->address); ?>" <?php else: ?> value="<?php echo e(old('shipping_address')); ?>" <?php endif; ?>>
<?php $__errorArgs = ['shipping_address'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Pincode <span class="required">*</span></label>
<input type="text" placeholder="Pincode" name="shipping_pincode" class="<?php $__errorArgs = ['shipping_pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->pincode); ?>" <?php else: ?> value="<?php echo e(old('shipping_pincode')); ?>" <?php endif; ?> onKeyup="checkPincode(this.value);">
 <?php $__errorArgs = ['shipping_pincode'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Town / City <span class="required">*</span></label>
<input type="text" placeholder="Town/City" name="shipping_city" class="<?php $__errorArgs = ['shipping_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(!empty($shipping_address)): ?> value="<?php echo e($shipping_address->city); ?>" <?php else: ?> value="<?php echo e(old('shipping_city')); ?>" <?php endif; ?>>
<?php $__errorArgs = ['shipping_city'];
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
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Country<span class="required">*</span></label>
<select name="shipping_country" id="shipping_country" onChange="getStates(this.value, 'shipping_state');" class="form-control <?php $__errorArgs = ['shipping_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
 <option value="">Choose country</option>
 <?php $__currentLoopData = countries(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(!empty($shipping_address)): ?> <?php if($shipping_address->country == $row->id): ?> selected <?php endif; ?> <?php else: ?> <?php if($row->id == 101): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php $__errorArgs = ['country'];
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
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>State <span class="required">*</span></label>
<select name="shipping_state" id="shipping_state" class="form-control <?php $__errorArgs = ['shipping_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
 <option value="">Choose state</option>
 <?php if(!empty($shipping_address)): ?>
  <?php $__currentLoopData = states($shipping_address->country); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if($shipping_address->state == $row->id): ?> selected <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php else: ?>
 <?php $__currentLoopData = states(101); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($row->id); ?>" <?php if(101 == $row->id): ?> selected <?php endif; ?>><?php echo e($row->name); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?>
</select>
<?php $__errorArgs = ['shipping_state'];
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
</div>
</div>



</div>

</div>
</div>

</div>
<div class="col-lg-5 col-12">
    <!-- your order detail -->
    <div class="">
<div class="your-order mb-30 ">
<h3 class="hd">Your order</h3>
<div class="your-order-table table table-responsive">
<table>
<thead>
<tr>
<th class="product-name">Product</th>
<th class="product-total">Total</th>
</tr>
</thead>
<tbody>
<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr class="cart_item">
<td class="product-name"> <?php echo e($row->name); ?> <strong class="product-quantity"> × <?php echo e($row->quantity); ?></strong></td>
<td class="product-total"> <span class="amount"><?php echo e(currency()); ?><?php echo e($row->price); ?></span> </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
<tfoot>
<tr class="cart-subtotal">
<th>Subtotal</th>
<td><span class="amount"><?php echo e(currency()); ?><?php echo e(cartTotal()); ?></span></td>
</tr>
<?php if(auth()->guard()->check()): ?>
 <?php if($coupon = couponCondition()): ?>
<tr class="cart-subtotal">
<th>Discount</th>
<td><span class="amount">- <?php echo e(currency()); ?> <?php echo e(couponAmount($coupon->coupon_id)); ?></span></td>
</tr>
 <?php endif; ?>
<?php endif; ?>
<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"><?php echo e(currency()); ?><?php echo e(checkoutTotal()); ?></span></strong>
</td>
</tr>
</tfoot>
</table>
</div>

<div class="payment-method">
<h4 class="pb-10 border-b-light-gray3 hd" style="font-weight: 700;">Payment Method</h4>
<input type="hidden" name="type" value="PREPAID" />    
<input type="radio" name="sub_type" class="sub_type" id="gateway" value="GATEWAY" checked /> <label for="gateway">Gateway </label> &nbsp;&nbsp;
<input type="radio" name="sub_type" class="sub_type" id="upi" value="UPI" /> <label for="upi">UPI</label>
&nbsp;&nbsp;
<input type="radio" name="sub_type" class="sub_type" id="dbt" value="DIRECT_BANK_TRANSFER" /> <label for="dbt">Direct Bank Transfer</label>

<div id="sub-type"></div>
<br/>

<small class="text-muted">2% save available payment made on "UPI" & "Direct Bank Transfer" methods.</small>

<div id="pincode_response" class="text-danger mb-3"></div>

<div class="order-button-payment mt-5"> <!--BUTTON CREATING DYNAMICALLY--></div>

<div class="css d-flex justify-content-between align-items-center">
<p class="m-0" style="font-size: 12px;" color="rgba(0,19,37,0.92)" class="css-udedi eka6zu20">100% Original Products, Pay Securely, Easy Returns and Exchange</p>
<span class="css-d85ps1 ehes2bo0"><img src="assets/img/secure-payment.png" alt="Image" class="css-0 ek8d9s80" style="max-width: 40px;"></span>
</div>
</div>
</div>
</div>
</div>


</div>
</form>
</div>
</section>
<!-- checkout-area end -->

</main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
 <script>
  $(document).ready(function(){
   <?php if(auth()->guard()->check()): ?>
    <?php if(user()->is_shipping): ?>       
     $('#is_shipping').click();
    <?php endif; ?> 
   <?php endif; ?> 
   $('#gateway').click();
  }); 
 </script> 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/checkout.blade.php ENDPATH**/ ?>