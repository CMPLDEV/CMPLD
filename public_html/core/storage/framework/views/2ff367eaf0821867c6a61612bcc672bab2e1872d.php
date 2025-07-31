<?php if($showcases->isNotEmpty()): ?>
 <?php $__currentLoopData = $showcases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $showcase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="top-selling-product pb-50">
<div class="container-fluid">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
<?php if(empty($showcase->banner)): ?>    
 <span class="p-subtitle p-subtitle-2">Explore <?php echo e($showcase->name); ?></span>
 <h3 class="p-title pb-15 mb-0">Best Products</h3>
<?php else: ?>
 <a href="<?php echo e($showcase->url); ?>" class="cat_banner"> <img src="uploaded_files/showcase/<?php echo e($showcase->banner); ?>" title="<?php echo e(setting()->comp_name); ?>" alt="<?php echo e(setting()->comp_name); ?>" width="100%" /> </a>
<?php endif; ?>
</div>
</div>
</div>

<div class="row">
<div class="col-xxl-12">
<div class="top-selling-active-2 owl-carousel pt-4">
<?php $__currentLoopData = $showcase->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="single-product mb-15 wow fadeInUp bxp" data-wow-delay=".1s">
<div class="product-thumb"><a href="<?php echo e(productURL($row->slug)); ?>">
<img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>"></a>
<div class="cart-btn cart-btn-2 p-abs">
<a href="javascript:void(0);" onClick="addCart('<?php echo e($row->product_id); ?>');">Add to cart</a>
</div>
<span class="discount discount-3 p-abs"><?php echo e(discount($row->product_id)); ?>%</span>
<?php if($row->stock == 0): ?>
 <span class="stock">Out Of Stock</span>
<?php endif; ?>

<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('<?php echo e($row->product_id); ?>');">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('<?php echo e($row->product_id); ?>');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
</div>
</div>
<div class="product-content">
<h4 class="pro-title pro-title-2"><a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a></h4>
<div class="pro-price">
<span><?php echo e(currency()); ?><?php echo e($row->price); ?></span>
<del><?php echo e(currency()); ?><?php echo e($row->mrp); ?></del>
</div>
<!--<?php echo starRating($row->product_id); ?>-->
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 text-center">
<div class="p-btn p-btn-1 wow fadeInUp" data-wow-delay="1.2s">
 <a href="<?php echo e($showcase->url); ?>">View All</a>
</div>
</div>
</div>
</div>
</div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/ajax/showcase.blade.php ENDPATH**/ ?>