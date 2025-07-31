

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('custom-css'); ?>
<style>
 body{
  background-color: #fff !important;
 }
 .review-title{font-size: 22px;line-height: 35px;}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<main>
<!-- breadcrumb-start -->
<div class="slider-area over-hidden">
<div class="single-page page-height d-flex align-items-center" style="background-image: url('assets/img/review-banner.jpg')">
<div class="container">
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-items-center justify-content-start position-static">
<div class="page-title text-center">
<h2 class="text-capitalize text-white mb-25 pt-35"></h2>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center bg-transparent">
<li class="breadcrumb-item"><a class="" style="color: #000;" href="">Home</a></li>
<li class="breadcrumb-item active text-capitalize text-white" aria-current="page"><?php echo e($product->name); ?> Review</li>
</ol>
</nav> 
</div>
</div>
</div>
</div>

</div>
</div>
<!-- breadcrumb-end -->

<!--start gallery sec -->
<section class="gallery-pg pt-50 pb-50">
<div class="container">
 <div class="row">
  <div class="col-lg-6">
  <h1 class="review-title"> " <a href="<?php echo e(productURL($product->slug)); ?>"><?php echo e($product->name); ?></a> "</h1> 
   <form method="post" id="rating-form" onSubmit="event.preventDefault();" enctype="multipart/form-data">
   <?php echo csrf_field(); ?>
  <h3 class="product-review-title product-review-tt">Write Your Review</h3>
  <!--<span>“<?php echo e($product->name); ?>”</span>-->
  <p class="product-review-form-des">Your email address will not be published. Required fields are marked *</p>
  <div class="product-review-form-rating mb-40">
      <p>WE APPRECIATE YOUR REVIEW!</p>
  <fieldset class="rating">
  <input type="radio" id="star5" name="rating" value="5" onclick="getRating(5)" />
  <label class = "full" for="star5" title="Awesome - 5 stars"></label>
  <input type="radio" id="star4half" name="rating" value="4 and a half" onclick="getRating(4.5)"/><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
  <input type="radio" id="star4" name="rating" value="4" onclick="getRating(4)"/><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
  <input type="radio" id="star3half" name="rating" value="3 and a half" onclick="getRating(3.5)"/><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
  <input type="radio" id="star3" name="rating" value="3" onclick="getRating(3)"/><label class = "full" for="star3" title="Meh - 3 stars"></label>
  <input type="radio" id="star2half" name="rating" value="2 and a half" onclick="getRating(2.5)"/><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
  <input type="radio" id="star2" name="rating" value="2" onclick="getRating(2)"/><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
  <input type="radio" id="star1half" name="rating" value="1 and a half" onclick="getRating(1.5)"/><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
  <input type="radio" id="star1" name="rating" value="1" onclick="getRating(1)"/><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
  <input type="radio" id="starhalf" name="rating" value="half" onclick="getRating(0.5)"/><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
  </fieldset>
  </div>
  <input type="hidden" name="product_id" id="product_id" value="<?php echo e($product->id); ?>"/>
  <input type="hidden" name="rating" id="rating"/>
      <div class="product-review-form-wrapper pt-20">
      <div class="">
      <div class="">
            
      <div class="product-review-input pt-3">
        <textarea name="review" id="review" class="form-control review-control"  placeholder="Write a review" style="width: 100%;background: #f5f5f5;padding: 1rem;border-radius: .5rem;outline: none;resize: none;margin-bottom: .5rem;"><?php if(!empty($user_rating)): ?><?php echo e($user_rating->review); ?><?php endif; ?></textarea>
      </div>
      </div>
      <div class="">
      <div class="product-review-btn">
        <button type="submit" class="update-btn submit-rating" onClick="submitRating();"> 
        <i class="fad fa-comment-alt-dots"></i> &nbsp; Submit Review</button>
      </div>
      </div>
      </div>
    </div>
   </form>      
  </div>
  <div class="col-lg-6">
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
    <?php echo singleUserRating($product->id,$row->user_id); ?>

    <span>(<?php echo e($row->rating); ?>)</span>
    </div>
    </div>
    <p class="rv"><small><?php echo e($row->review); ?></small></p>
    </div>
    
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
        </div>
    </div>
    </div>
    <?php echo e($ratings->appends($_GET)->links()); ?>

    <?php endif; ?>   
  </div>
 </div>
</div>
</div>
</section>

</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/product-review.blade.php ENDPATH**/ ?>