

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<style>
    .breadcrumb-wrapper-2 h3 {
    color: #ffffff;
    font-size: 40px;
    letter-spacing: 1px;
}
.breadcrumb-area-3 {
    padding: 80px 0;
}
</style>

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-3" style="background-image:url('assets/img/cart-banner.jpg');background-size: cover;">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-center">
<h3>Wishlist</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center">
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active text-white" aria-current="page">Wishlist</li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<!-- Cart Area Strat-->
<section class="cart-area pt-100 pb-100">
<div class="container">
<div class="row">
<?php if($products->isNotEmpty()): ?>    
<div class="col-12">
<form action="#">
<div class="table-content table-responsive">
<table class="table">
<thead>
<tr>
<th class="product-thumbnail">Images</th>
<th class="cart-product-name">Product</th>
<th class="product-price">Unit Price</th>
<th class="product-quantity">Stock</th>
<th class="product-remove">Action</th>
</tr>
</thead>
<tbody>
<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
<td class="product-thumbnail"><a href="<?php echo e(productURL($row->slug)); ?>"><img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->image_alt); ?>" title="<?php echo e($row->image_title); ?>"></a></td>
<td class="product-name"><a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a></td>
<td class="product-price"><span class="amount"><?php echo e(currency()); ?><?php echo e($row->price); ?></span></td>
<td class="product-name"><?php echo stockBadge($row->stock); ?></td>
<td class="product-remove">
 <a href="javascript:void(0);" onClick="addCart('<?php echo e($row->pro_id); ?>');" class="btn btn-primary">Add to cart</a>   
 <a href="<?php echo e(route('wishlist.remove',$row->id)); ?>"><i class="fa fa-times"></i></a>
</td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<?php echo e($products->appends($_GET)->links()); ?>

</div>
</form>
</div>
<?php else: ?>
 <center><h4 style="margin-top:50px;color:indianred">No Data Available To Show.</h4></center>
<?php endif; ?>
</div>
</div>
</section>
<!-- Cart Area End-->

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/wishlist.blade.php ENDPATH**/ ?>