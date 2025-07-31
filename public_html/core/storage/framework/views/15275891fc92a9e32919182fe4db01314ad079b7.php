

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('og_title',$data->name); ?>
<?php $__env->startSection('og_description',$meta_description); ?>
<?php $__env->startSection('og_image',asset('uploaded_files/product/'.$data->image)); ?>

<?php $__env->startSection('custom-css'); ?>
 <style>
 .exchnage-sec p {font-size: 12px;line-height: 18px;margin-top: 6px;color: #007185;}
 .short-disc h1,.short-disc ul,.short-disc li,.short-disc h2,.short-disc h3,.short-disc h4,.short-disc h5,.short-disc h6,.short-disc p,.short-disc span{font-size: 13px !important;}
.prdName{padding-top:50px;font-weight: 500;font-size: 15px;}
.review-btn {
    background-color: transparent;
    display: block;
    font-size: 16px;
    line-height: 29px;
    border-color: #d5d9d9;
    border-style: solid;
    border-width: 1px;
    margin: 0;
    outline: 0;
    padding: 8px 12px 6px 13px;
    text-align: center;
    white-space: nowrap;
    border-radius: 8px;
    box-shadow: 0 2px 5px 0 rgba(213, 217, 217, .5);
    margin-bottom: 22px;
    text-transform: capitalize;
    color: #000;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<main>
<?php if(!empty($data->banner)): ?>
<img src="uploaded_files/product/<?php echo e($data->banner); ?>" style="max-height: 500px;width: 100%;object-fit: cover;">
<?php endif; ?>
<!-- breadcrumb area start -->
<div class="breadcrumb-area-2 box-plr-45 gray-bg-4 d-none">
<div class="container-fluid">
<div class="row">
<div class="col-xxl-12">
<nav aria-label="breadcrumb" class="breadcrumb-list-2">
<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item"><a href="<?php echo e(route('all-products')); ?>">Store</a></li>
<li class="breadcrumb-item active" aria-current="page"><?php echo e($data->name); ?></li>
</ol>
</nav>
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<!-- product details area start -->
<section class="product__details-area pb-45 box-plr-45 gray-bg-4">
<div class="container-fluid">
<div class="row">
<div class="col-lg-4 pt-40">
<div class="product__details-nav-wrapper">
<?php if($more_images->isNotEmpty()): ?>
<div class="product__details-thumb">
<div class="tab-content" id="productDetailsTabContent">

<div class="tab-pane fade show active" id="pro-nav-1" role="tabpanel" aria-labelledby="pro-nav-1-tab">
<div class="product-nav-thumb-wrapper">
<!--<a href="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" class="product-img-zoom popup-image">-->
<!--<i class="fal fa-compress"></i>-->
<!--</a>-->
<a class="gallery-lightbox" href="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>">
  <img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>" class="img-fluid">
</a>

<!--<img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">-->
</div>
</div>

<?php $__currentLoopData = $more_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="tab-pane fade" id="pro-nav-<?php echo e($row->id); ?>" role="tabpanel" aria-labelledby="pro-nav-2-tab">
<div class="product-nav-thumb-wrapper">
<!--<a href="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" class="product-img-zoom popup-image">-->
<!--<i class="fal fa-compress"></i>-->
<!--</a>-->
<a class="gallery-lightbox" href="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>">
  <img src="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>" class="img-fluid">
</a>

<!--<img src="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>">-->
</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
</div>

<div class="product__details-nav">
<ul class="nav nav-tabs" id="productDetailsNav" role="tablist">

<li class="nav-item" role="presentation" style="width:80px;">
<button class="nav-link active" id="pro-nav-1-tab" data-bs-toggle="tab" data-bs-target="#pro-nav-1" type="button" role="tab" aria-controls="pro-nav-1" aria-selected="true">
<img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>" style="height: 80px;
    width: fit-content;object-fit: cover;">
</button>
</li>

<?php $__currentLoopData = $more_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="nav-item" role="presentation" style="width:80px;">
<button class="nav-link" id="pro-nav-4-tab" data-bs-toggle="tab" data-bs-target="#pro-nav-<?php echo e($row->id); ?>" type="button" role="tab" aria-controls="pro-nav-4" aria-selected="false">
<img src="<?php echo e(showImage($row->image,'uploaded_files/more_image')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>" style="height: 80px;
    width: fit-content;object-fit: cover;">
</button>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
</div>
<?php else: ?>
<img src="<?php echo e(showImage($data->image,'uploaded_files/product')); ?>" alt="<?php echo e($data->image_alt); ?>" title="<?php echo e($data->image_title); ?>" width="100%">
<?php endif; ?>

</div>
</div>
<div class="col-lg-8"> 
<div class="prdName"><?php echo e($data->name); ?></div>
<div class="row">
 <div class=" col-lg-6 pt-40">
<div class="product__details-content p-0">

<ul>
<li>
<div class="product-availibility pb-2">
<span>Availability</span>
<?php if($data->is_eol): ?> <span class="badge bg-danger">End of life</span> <?php else: ?> <?php echo stockBadge($data->stock); ?> <?php endif; ?>
</div>
</li>
<?php if(!empty($data->sku)): ?>
<li>
<div class="product-sku d-flex gap-2">
<span><b>Sku:</b></span>
<p>
<span><?php echo e($data->sku); ?></span>
</p>
</div>
</li>
<?php endif; ?>
</ul>
<div class="product__details-price d-flex">
<span class="price">
<span class="price"><?php echo e(currency()); ?><?php echo e($data->price); ?></span>
    <small><strike class="text-danger"><?php echo e(currency()); ?><?php echo e($data->mrp); ?></strike></small>
</span>    
<div class="product__details-rating d-flex align-items-center mb-15">
<?php echo starRating($data->id); ?>

<span class="product__details-customer">
<span><a href="#">(<?php echo e(rating($data->id)); ?>)</a></span></span>
</div>

</div>

<div class="row ckeditor-product mb-3">
 <?php if($data->variant1_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant1_url); ?>">
    <center><img src="<?php echo e($data->variant1_image); ?>" alt="<?php echo e($data->variant1_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant1_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant2_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant2_url); ?>">
    <center><img src="<?php echo e($data->variant2_image); ?>" alt="<?php echo e($data->variant2_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant2_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant3_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant3_url); ?>">
    <center><img src="<?php echo e($data->variant3_image); ?>" alt="<?php echo e($data->variant3_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant3_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant4_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant4_url); ?>">
    <center><img src="<?php echo e($data->variant4_image); ?>" alt="<?php echo e($data->variant4_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant4_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant5_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant5_url); ?>">
    <center><img src="<?php echo e($data->variant5_image); ?>" alt="<?php echo e($data->variant5_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant5_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
</div>

<div class="row ckeditor-product mb-3">
 <?php if($data->variant6_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant6_url); ?>">
    <center><img src="<?php echo e($data->variant6_image); ?>" alt="<?php echo e($data->variant6_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant6_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant7_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant7_url); ?>">
    <center><img src="<?php echo e($data->variant7_image); ?>" alt="<?php echo e($data->variant7_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant7_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant8_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant8_url); ?>">
    <center><img src="<?php echo e($data->variant8_image); ?>" alt="<?php echo e($data->variant8_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant8_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant9_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant9_url); ?>">
    <center><img src="<?php echo e($data->variant9_image); ?>" alt="<?php echo e($data->variant9_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant9_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
 <?php if($data->variant10_title): ?>
  <div class="col-lg-2 col">
   <a href="<?php echo e($data->variant10_url); ?>">
    <center><img src="<?php echo e($data->variant10_image); ?>" alt="<?php echo e($data->variant10_title); ?>" width="60" /></center>
    <p><?php echo e($data->variant10_title); ?></p>
   </a>      
  </div>
 <?php endif; ?>
</div>

<div class="short-disc mb-2">
 <?php echo $data->short_content; ?> 
</div>

<hr>

</div>

</div>
<div class=" col-lg-6 pt-40">

<div class="product__details-meta mb-10">

</div>
<div id="razorpay-affordability-widget"> </div>


<div class="product__details-action">
<form action="#">
<div class="product__details-quantity">
<div class="product-quantity d-flex align-items-center gap-2 mb-20 mr-15">
<div class="cart-plus-minus">
<div class="dec qtybutton" onClick="decrementQty();">-</div>    
<input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" id="qty" readonly="">
<div class="inc qtybutton" onClick="incrementQty();">+</div>
</div>
<button type="button" class="s-btn s-btn-2 heart-list s-btn-big btn-right" onClick="addWishlist('<?php echo e($data->id); ?>');"><i class="fal fa-heart"></i></button>
</div>
<?php if(!$data->is_eol): ?>
<div class="product-add-cart d-md-flex mb-20">
<button type="button" class="s-btn s-btn-2 mb-2 heart-list s-btn-big btn-right d-block w-100" onClick="addCart('<?php echo e($data->id); ?>','BUYNOW');">buy now</button>
<button type="button" class="s-btn s-btn-2 s-btn-big ad-ct btn-right w-100" onClick="addCart('<?php echo e($data->id); ?>');">add to cart</button>
</div>
<?php endif; ?>
</div>
<div class="product-add-cart">
<button type="button" class="mb-2 bg-transparent" onClick="productNegotiation('<?php echo e($data->id); ?>');" style="text-decoration: underline;padding-top: 10px;
    color: #00a0e3;text-transform: capitalize;">Found this product at lower price?</button>    
</div>


</form>
</div>
<form method="POST" id="ajax-form" onSubmit="event.preventDefault();">
 <?php echo csrf_field(); ?>    
<div class="input-group mb-3">
 <input type="number" class="form-control" placeholder="Enter pincode to check availability" name="delivery_pincode" id="delivery_pincode">
 <button type="submit" class="s-btn s-btn-2 ajax-btn" onClick="checkPincodeAvailability();">Check Pincode</button>
</div>
</form>

<div id="pincode_response" class="text-danger mb-3"></div>

<div class="exchnage-sec">
<div class="row">
<?php if(!empty($data->replacement)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/replacement.png" alt="Replacement" style="max-width: 40px;">
<p><?php echo e($data->replacement); ?></p>
</div>
<?php endif; ?>
<?php if(!empty($data->delivery)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/delivery.png" alt="Delivery" style="max-width: 40px;">
<p><?php echo e($data->delivery); ?></p>
</div>
<?php endif; ?>
<?php if(!empty($data->warranty)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/shield.png" alt="Warranty" style="max-width: 40px;">
<p><?php echo e($data->warranty); ?></p>   
</div>
<?php endif; ?>
<?php if(!empty($data->brand)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/badge.png" alt="Brand" style="max-width: 40px;">
<p><?php echo e($data->brand); ?></p>            
</div>
<?php endif; ?>
<?php if(!empty($data->bluedart)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/bluedart.png" alt="Blue Dart" style="max-width: 40px;">
<p><?php echo e($data->bluedart); ?></p>            
</div>
<?php endif; ?>
<?php if(!empty($data->secure)): ?>
<div class="col-lg-4 col-6 text-center">
<img src="assets/img/secure-transaction.png" alt="Secure Transaction" style="max-width: 40px;">
<p><?php echo e($data->secure); ?></p>            
</div>
<?php endif; ?>
</div>

<h4>Review This Product</h4>
<p>Share your thoughts with other customers</p>
<button type="button" class="btn review-btn w-100" onClick="window.location.href='<?php echo e(route('product.review',$data->id)); ?>';">
 <i class="fas fa-edit"></i>&nbsp;  Write Your Review
</button>

<div class="pro-avg-ratting mb-3">
<div class="review-heading">
<h4>Total reviews: (<?php echo e(totalReviews($data->id)); ?>) </h4>
<a href="<?php echo e(route('product.review',$data->id)); ?>">View All</a>    
</div>    
</div>
<?php if($ratings->isNotEmpty()): ?>
<div class="rattings-wrapper">
<div class="row">
<div class="col-lg-12">
  <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="sin-rattings">
<?php if(!empty($row->image)): ?>
<p class="m-0"><img src="uploaded_files/review/<?php echo e($row->image); ?>" style="width: 33%; float: left;margin-right: 12px;" /></p> 
<?php endif; ?>
<div class="">
<div class="ratting-author d-flex justify-content-between">
<h5><?php echo e(user($row->user_id)->name); ?></h5>
<div class="ratting-star">
<?php echo singleUserRating($data->id,$row->user_id); ?>

<span>(<?php echo e($row->rating); ?>)</span>
</div>
</div>
<p class="rv"><?php echo e($row->review); ?></p>
</div>

</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
    </div>
</div>
</div>
<?php endif; ?>

</div>

<!-- offer sec -->
<?php if($product_offers->isNotEmpty()): ?>
<span class="offer-title"><i class="fal fa-badge-percent"></i> Offers</span>
<div class="row offer-row offer-slider">
<?php $__currentLoopData = $product_offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <div class="col-lg-6">
<a href="<?php echo e($row->link); ?>">
<div class="offer-text">
 <h6> <?php echo e($row->name); ?> </h6>
 <p><?php echo e($row->content); ?></p>
</div>
</a>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>
<!-- end off -->

<div class="product__details-social d-sm-flex align-items-center">
 <p class="mb-0 me-2"><strong>Share:</strong></p>
 <div class="sharethis-inline-share-buttons"></div> 
</div>

<div class="mt-4">
 <a href="about-us.html#certificates_section" class="s-btn s-btn-2 buy-confidence"> <i class="fa fa-shield-alt" id="blink-icon"></i> Buy with confidence</a>    
</div>

 </div>
 </div> 
</div>

</div>
</div>
</section>
<!-- product details area end -->

<!-- product details video start -->
<?php if(!empty($data->video)): ?>
<section class="product__details-video">
<div class="container-fluid p-0">
<div class="row gx-0">
<div class="col-xxl-12">
<div class="product__details-video-wrapper">
<iframe src="https://www.youtube.com/embed/<?php echo e($data->video); ?>" title="YouTube video player"></iframe>
</div>
</div>
</div>
</div>
</section>
<?php endif; ?>
<!-- product details video end -->



<!-- value section -->

<!--<div class="value-sec pt-5">-->
<!--<div class="container">-->

<!--</div>-->

<!-- end value section -->

<!-- product info area start -->
<section class="product__info-area pt-95 pb-50" id="more-disc">
<div class="container">

<div class="row">
<div class="col-xxl-12">
<p class="product-additional-des"><?php echo $data->content; ?></p>
</div>
</div>


<div class="row">
    <div class="col-xxl-12">
    <?php echo $data->additional_information; ?>

</div>
</div>
</div>
</section>
<!-- product info area end -->

<!-- MORE BANNERS -->
<?php if($more_banners->isNotEmpty()): ?>
 <?php $__currentLoopData = $more_banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <img src="uploaded_files/more_image/<?php echo e($row->image); ?>" alt="<?php echo e($data->name); ?>" title="<?php echo e($data->name); ?>" class="w-100">
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<div class="product-line"></div>

<?php if($related->isNotEmpty()): ?>
<!-- top selling product area start -->
<div class="top-selling-product pt-95 pb-65">
<div class="container">
<div class="row">
<div class="col-xxl-12">
<div class="product-details-section-title text-center">
<h3 style="font-size: 25px;">YOU MAY ALSO LIKE</h3>
</div>
</div>
</div>
<div class="row">
<div class="col-xxl-12">
<div class="top-selling-active-2 owl-carousel">
<?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
<div class="single-product bpx mb-15 wow fadeInUp bxp" data-wow-delay=".1s">
<div class="product-thumb">
<a href="<?php echo e(productURL($row->slug)); ?>">
<img src="<?php echo e(showImage($row->image,'uploaded_files/product')); ?>" alt="<?php echo e($row->name); ?>" title="<?php echo e($row->name); ?>">
</a>
<div class="cart-btn cart-btn-2 p-abs">
<a href="javascript:void(0);" onClick="addCart('<?php echo e($row->id); ?>');">Add to cart</a>
</div>
<span class="discount discount-3 p-abs"><?php echo e(discount($row->id)); ?>%</span>
<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('<?php echo e($row->id); ?>');" data-bs-toggle="modal" data-bs-target="#productModal">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('<?php echo e($row->id); ?>');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
</div>
</div>
<div class="product-content">
<h4 class="pro-title pro-title-2"><a href="<?php echo e(productURL($row->slug)); ?>"><?php echo e($row->name); ?></a></h4>
<div class="pro-price">
<span><?php echo e(currency()); ?><?php echo e($row->price); ?></span>
</div>
<?php echo starRating($row->id); ?>

</div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</div>
</div>
</div>
</div>
<!-- top selling product area end -->
<?php endif; ?>

</main>

<script>
 const key = "<?php echo e(config('app.razorpay')['key_id']); ?>";
 const amount = parseInt("<?php echo e($data->price); ?>") * 100; 
 window.onload = function() {
  const widgetConfig = {
	"key": key,
	"amount": amount,
 };
 const rzpAffordabilitySuite = new RazorpayAffordabilitySuite(widgetConfig);
 rzpAffordabilitySuite.render();
 }
 
 $(document).ready(function(){
  $(".top-selling-active-2").owlCarousel({
      loop: true,
      margin: 10,
      autoplay: true,
      autoPlayTimeout:1000,
      autoplaySpeed:3000, 
      items: 5,
      navText: [
       '<i class="fa fa-angle-left"></i>',
       '<i class="fa fa-angle-right"></i>',
      ],
      nav: false,
      dots: false,
      responsive: {
       0: {
        items:2,
       },
       550: {
        items: 2,
        margin: 10,
       },
       767: {
        items: 3,
        margin: 10, 
       },
       900: {
        items: 3,
       },
       1200: {
        items: 4,
        margin: 30,
       },
       1600: {
        items: 5,
        margin: 30,
       },
      },
     });      
 });
 
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/product-detail.blade.php ENDPATH**/ ?>