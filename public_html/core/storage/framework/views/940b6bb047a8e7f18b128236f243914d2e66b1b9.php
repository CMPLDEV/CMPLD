

<?php $__env->startSection('title',$meta_title); ?>
<?php $__env->startSection('description',$meta_description); ?>
<?php $__env->startSection('keywords',$meta_keywords); ?>

<?php $__env->startSection('content'); ?>

<main>

 <img class="w-100" src="<?php echo e($banner); ?>" />

<!-- shop area start -->
<div class="shop-area mb-40 mt-40">
<div class="container">
<div class="row">
<div class="col-xxl-12">
<div class="shop-top-area mb-30">
<div class="row">
<div class="col-xxl-4 col-xl-2 col-md-3 col-sm-6">
<div class="shop-top-left shop-top-left-2">
<?php if($type == 'category'): ?>
<div class="header-bar d-lg-none">
<button type="button" class="header-bar-btn header-bar-btn-black" data-bs-toggle="modal" data-bs-target="#offCanvasModalFilter">
<i class="fas fa-filter fa-2x"></i>
<a href="<?php echo e(categoryURL($data->slug)); ?>" class="rm-filter" style="display:none">Remove filter <i class="fas fa-times text-danger"></i></a>
</button>
</div>
<?php endif; ?>
</div>
</div>
<div class="col-xxl-4 col-xl-6 col-md-6 col-sm-6">
<p class="show-total-result text-md-center" id="showing-result"></p>
</div>
<div class="col-xl-4 col-xl-4 col-md-3">
<div class="text-md-end">
<div class="select-default select-default-2">
<select name="short" id="sort_by" class="shorting-select" onChange="loadProducts('<?php echo e($type); ?>','<?php echo e($type_value); ?>',this.value);">
<option value="">Default sorting</option>
<option value="AZ">Sort - A-Z</option>
<option value="ZA">Sort - Z-A</option>
<option value="LH">Price - Low to High</option>
<option value="HL">Price - High to Low</option>
<option value="ON">Old to New</option>
<option value="NO">New to Old</option>
</select>
</div>
</div>
</div>
</div>
</div>

<div class="row">
<div class="col-lg-3 d-none d-md-block">
<?php if($type == "category"): ?>    
<a href="<?php echo e(categoryURL($data->slug)); ?>" class="rm-filter" style="display:none">Remove filter <i class="fas fa-times text-danger"></i></a>    
<div class="product__filter-wrapper mt-15">
<div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 gx-0">

<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
 <?php $values = explode(',', $row->value); ?>
 <div class="col-lg-12">
<div class="product__filter-item p-relative">
<div class="accordion" id="categoriesAccordion">
<div class="accordion-item">
<h2 class="accordion-header product__filter-title" id="headingOne">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filter<?php echo e($row->id); ?>" aria-expanded="true" aria-controls="filter<?php echo e($row->id); ?>"><?php echo e($row->key); ?></button>
</h2>
<div id="filter<?php echo e($row->id); ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#categoriesAccordion">
<div class="accordion-body">
<div class="product__filter-content">
<div class="product__filter-categories">
<div class="widget-category-list">
<form action="#">
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="single-widget-category">
<input type="checkbox" id="cat-item-<?php echo e($value); ?><?php echo e($row->id); ?>D" name="<?php echo e(str_replace(' ','_',strtolower($row->key))); ?>D[]" class="product_attribute" value="<?php echo e($value); ?>" onClick="filterProduct('<?php echo e(str_replace(' ','_',strtolower($row->key))); ?>', '<?php echo e($value); ?>', '<?php echo e($type); ?>', '<?php echo e($type_value); ?>', '<?php echo e($sort_by); ?>');">
<label for="cat-item-<?php echo e($value); ?><?php echo e($row->id); ?>D"><?php echo e($value); ?></label>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</div>
</div>
<?php endif; ?>
</div>

<div class="<?php if($type == 'category'): ?> col-lg-9 <?php else: ?> col-lg-12 <?php endif; ?>">
<!-- /. shop top area -->
<div class="shop-main-area">
<div class="tab-content" id="nav-tabContent"> 
<div class="tab-pane fade active show" id="tab5">
<div class="row pb-20" id="ajax-product">
<!-- LOAD PRODUCTS VIA AJAX -->
</div>
<div class="col-lg-12 text-center mb-4" id="load-more-btn">
  <button type="button" class="btn update-btn" onClick="moreData();">Load More</button>  
</div>
 
 <div class="row" id="product-loader" style="display:none">
  <div class="col-md-6 offset-md-3 text-center mb-4">
  <div class="spinner-border text-muted"></div>
  </div>
 </div>
</div>
</div>
</div>
</div>
</div>
<!-- /. shop main area -->
</div>
</div>
</div>
</div>
<!-- shop area end -->

<?php echo $__env->make('index-newsletter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</main>

<!-- sidebar area start -->
<section class="offcanvas__area">
<div class="modal fade" id="offCanvasModalFilter" tabindex="-1" aria-labelledby="offCanvasModalFilter" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="offcanvas__wrapper">
<div class="offcanvas__top d-flex align-items-center justify-content-between">
<div class="offcanvas__close">
<button class="offcanvas__close-btn" data-bs-toggle="modal" data-bs-target="#offCanvasModalFilter">
<svg viewBox="0 0 22 22">
<path d="M12.41,11l5.29-5.29c0.39-0.39,0.39-1.02,0-1.41s-1.02-0.39-1.41,0L11,9.59L5.71,4.29c-0.39-0.39-1.02-0.39-1.41,0
s-0.39,1.02,0,1.41L9.59,11l-5.29,5.29c-0.39,0.39-0.39,1.02,0,1.41C4.49,17.9,4.74,18,5,18s0.51-0.1,0.71-0.29L11,12.41l5.29,5.29
C16.49,17.9,16.74,18,17,18s0.51-0.1,0.71-0.29c0.39-0.39,0.39-1.02,0-1.41L12.41,11z"/>
</svg>
</button>
</div>
</div>
<div class="offcanvas__content p-relative z-index-1">
<div class="canvas__menu fix ">
<div class="">
 <div class="col-lg-12">
<?php if($type == "category"): ?>
<div class="product__filter-wrapper mt-15">
<div class="row row-cols-lg-5 row-cols-md-3 row-cols-sm-2 row-cols-1 gx-0">
<?php $__currentLoopData = $filters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
 <?php $values = explode(',', $row->value); ?>
 <div class="col-lg-12">
<div class="product__filter-item p-relative">
<div class="accordion" id="categoriesAccordion">
<div class="accordion-item">
<h2 class="accordion-header product__filter-title" id="headingOne">
<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#filter<?php echo e($row->id); ?>" aria-expanded="true" aria-controls="filter<?php echo e($row->id); ?>"><?php echo e($row->key); ?></button>
</h2>
<div id="filter<?php echo e($row->id); ?>" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#categoriesAccordion">
<div class="accordion-body">
<div class="product__filter-content">
<div class="product__filter-categories">
<div class="widget-category-list">
<form action="#">
<?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="single-widget-category">
<input type="checkbox" id="cat-item-<?php echo e($value); ?><?php echo e($row->id); ?>" name="<?php echo e(str_replace(' ','_',strtolower($row->key))); ?>[]" class="product_attribute" value="<?php echo e($value); ?>" onClick="filterProduct('<?php echo e(str_replace(' ','_',strtolower($row->key))); ?>', '<?php echo e($value); ?>', '<?php echo e($type); ?>', '<?php echo e($type_value); ?>', '<?php echo e($sort_by); ?>');">
<label for="cat-item-<?php echo e($value); ?><?php echo e($row->id); ?>"><?php echo e($value); ?></label>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>  
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

</div>
</div>
<?php endif; ?>
</div> 
</div>
</div>


</div>
</div>
</div>
</div>
</div>

</section>
<!-- sidebar area end -->

<input type="hidden" id="filter_data" />

<script>
$(document).ready(function(){
let page = 1;
let type = "<?php echo e($type); ?>";
let sort_by = "<?php echo e($sort_by); ?>";
let category_id = "<?php echo e($category_id); ?>";
let type_value = decodeHtmlEntities("<?php echo e($type_value); ?>");

loadProducts(type, type_value, sort_by, category_id);
resetPage = ()=>{ page = 1; }
lastPage = (last_page)=>{
if(page == last_page){
 $('#load-more-btn').fadeOut('fast');  
 $('#product-loader').fadeOut('fast');    
}   
}
moreData = ()=>{ 
page++;  
sort_by = $('#sort_by').val();
let filter_data = $('#filter_data').val();
var url = "<?php echo e(url('/')); ?>/"+"load-products?type="+type+"&type_value="+type_value+"&sort_by="+sort_by+"&category_id="+category_id+"&filter_data="+filter_data+"&page="+page;
$.ajax({
url: url,
beforeSend:function(){
$('#load-more-btn').fadeOut('fast');  
$('#product-loader').fadeIn('fast');
},
success:function(data){
$('#load-more-btn').fadeIn('fast');  
$('#product-loader').fadeOut('fast');
$('#ajax-product').append(data);
}
});
}

});   

 decodeHtmlEntities = (str)=> {
  var textarea = document.createElement('textarea');
  textarea.innerHTML = str;
  return textarea.value;
 }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/papayawhip-crane-482714.hostingersite.com/public_html/core/resources/views/product.blade.php ENDPATH**/ ?>