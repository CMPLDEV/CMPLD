<?php if($carts->isNotEmpty()): ?>
<div class="cartmini__list">
<ul>
<?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="cartmini__item p-rel d-flex align-items-start">
<div class="cartmini__thumb mr-15">
<a href="<?php echo e(productURL($row->slug)); ?>">
<img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->image_alt); ?>" title="<?php echo e($row->image_title); ?>">
</a>
</div>
<div class="cartmini__content">
<h3 class="cartmini__title">
<a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a>
</h3>
<span class="cartmini__price">
<span class="price"><?php echo e($row->quantity); ?> × <?php echo e(currency()); ?><?php echo e($row->price); ?></span>
</span>
</div>
<a href="<?php echo e(route('cart.remove',$row->id)); ?>" class="cartmini__remove">
<i class="fal fa-times"></i>
</a>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<div class="price-total">
    <div class="cartmini__total d-flex align-items-center justify-content-between">
<h5>Subtotal</h5>
<span><?php echo e(currency()); ?> <?php echo e(cartTotal()); ?></span>
</div>
<div class="cartmini__bottom">
<a href="<?php echo e(route('cart')); ?>" class="s-btn w-100 mb-20">view cart</a>
<a href="<?php echo e(route('checkout')); ?>" class="s-btn s-btn-2 w-100">checkout</a>
</div>
</div>
<?php else: ?>

<div class="empty-cart text-center">
    <div class="">
        <img src="assets/img/empty-cart-illustration.gif" alt="" title="">
    </div>
    <div class="empty-cart-text">
        <h4>There is nothing in your bag.</h4>
        <div class="css-1i27f3a ei037z21 text-center"><button class="css-1h4559r e8tshxd0"><a href="">Start Shopping</a></button></div>
    </div>
</div>

<?php endif; ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/mini-cart.blade.php ENDPATH**/ ?>