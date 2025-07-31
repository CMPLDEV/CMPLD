<?php if($products->isNotEmpty()): ?>
 <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="col-lg-3 col-md-4 col-6">
<div class="single-product bxp mb-15 wow fadeInUp" data-wow-delay=".1s">
<div class="product-thumb">
<a href="<?php echo e(productURL($row->slug)); ?>">
 <img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>">
</a>
<div class="cart-btn cart-btn-1 p-abs">
<a href="javascript:void(0);" onClick="addCart('<?php echo e($row->id); ?>');">Add to cart</a>
</div>
<span class="discount discount-1 p-abs"><?php echo e(discount($row->id)); ?>%</span>

<?php if($row->stock == 0): ?>
 <span class="stock">Out Of Stock</span>
<?php endif; ?>

<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('<?php echo e($row->id); ?>');">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('<?php echo e($row->id); ?>');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
<!--<a href="javascript:void(0);" class="icon-box icon-box-1" title="Add to compare" onClick="addCompare('<?php echo e($row->id); ?>');">-->
<!--<i class="fal fa-layer-group"></i>-->
<!--<i class="fal fa-layer-group"></i>-->
<!--</a>-->
</div>
</div>
<div class="product-content">
<h4 class="pro-title pro-title-1"><a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a></h4>
<div class="pro-price">
<span><?php echo e(currency()); ?><?php echo e($row->price); ?></span>
<del><?php echo e(currency()); ?><?php echo e($row->mrp); ?></del>
</div>
<!--<div class="rating">-->
<!--<?php echo starRating($row->id); ?>-->
<!--</div>-->
</div>
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div class="alert alert-danger alert-dismissible fade show w-50 m-auto">
 <strong>No data available to show !</strong>.
</div>
<?php endif; ?>

 <script>
  $(document).ready(function(){
   var last_page = '<?php echo e($products->lastPage()); ?>';
   lastPage(last_page);
   var result = "Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?>";
   $('#showing-result').html(result);
  });    
 </script><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/load-product.blade.php ENDPATH**/ ?>