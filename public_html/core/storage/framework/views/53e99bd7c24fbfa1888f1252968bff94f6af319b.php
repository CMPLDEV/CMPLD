<div class="product__modal-inner position-relative">
<div class="product__modal-close">
<button data-bs-dismiss="modal" aria-label="Close">
<i class="ti-close"></i>
</button>
</div>
<div class="product__modal-left">
<div class="tab-content mb-10" id="productModalThumb">

<div class="tab-pane fade show active" id="pro-1" role="tabpanel" aria-labelledby="pro-1-tab">
<div class="product__modal-thumb w-img">
<img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">
</div>
</div>

<?php $__currentLoopData = $more_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="tab-pane fade" id="pro-2" role="tabpanel" aria-labelledby="pro-2-tab">
<div class="product__modal-thumb w-img">
<img src="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php if($more_images->isNotEmpty()): ?>
<div class="product__modal-nav">
<ul class="nav nav-tabs" id="productModalNav" role="tablist">

<li class="nav-item" role="presentation">
<button class="nav-link active" id="pro-1-tab" data-bs-toggle="tab" data-bs-target="#pro-1" type="button" role="tab" aria-controls="pro-1" aria-selected="true">
<img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">
</button>
</li>

<?php $__currentLoopData = $more_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="nav-item" role="presentation">
<button class="nav-link" id="pro-2-tab" data-bs-toggle="tab" data-bs-target="#pro-2" type="button" role="tab" aria-controls="pro-2" aria-selected="false">
<img src="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">
</button>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
</div>
<?php endif; ?>
</div>
<div class="product__modal-right">
<h3 class="product__modal-title">
<a href="product-details.html"><?php echo e($data->name); ?></a>
</h3>
<div class="product__modal-rating d-flex align-items-center">
<ul class="mr-10">
<li><a href="#"><i class="ti-star"></i></a></li>
<li><a href="#"><i class="ti-star"></i></a></li>
<li><a href="#"><i class="ti-star"></i></a></li>
<li><a href="#"><i class="ti-star"></i></a></li>
<li><a href="#"><i class="ti-star"></i></a></li>
</ul>
<div class="customer-review">
<a href="#">(1 customer review)</a>
</div>
</div>
<div class="product__modal-price mb-10">
<span class="price new-price"><?php echo e(currency()); ?><?php echo e($data->price); ?></span>

<span class="price old-price"><?php echo e(currency()); ?><?php echo e($data->mrp); ?></span>
</div>
<div class="product__modal-available">
<p> Availability: <span>In Stock</span> </p>
</div>
<?php if(!empty($data->sku)): ?>
<div class="product__modal-sku">
<p> Sku: <span> <?php echo e($data->sku); ?></span> </p>
</div>
<?php endif; ?>
<div class="product__modal-des">
<p><?php echo e($data->short_content); ?></p>
</div>
<div class="product__modal-quantity mb-15">
<h5>Quantity:</h5>
<form action="#">
<div class="pro-quan-area d-sm-flex align-items-center">
<div class="product-quantity mr-20 mb-25">
<div class="cart-plus-minus">
<div class="dec qtybutton" onClick="decrementQty();">-</div>    
<input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" id="qty" readonly="">
<div class="inc qtybutton" onClick="incrementQty();">+</div>
</div>
</div>
<div class="product__modal-cart mb-25">
<button class="product-modal-cart-btn " type="button" onClick="addCart('<?php echo e($data->id); ?>');">Add to cart</button>
</div>
</div>
</form>
</div>
<div class="product__modal-categories d-sm-flex align-items-center">
<span>Categories: </span>
<ul>
<li><?php echo productCategories($data->category_ids); ?></li>
</ul>
</div>

</div>
</div><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/quick-view.blade.php ENDPATH**/ ?>