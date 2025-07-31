<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"> 
<meta name="robots"<?php if(setting()->meta_robots): ?> content="index,follow" <?php else: ?> content="noindex,nofollow" <?php endif; ?>>
<base href="<?php echo e(url('/')); ?>">
<title><?php echo $__env->yieldContent('title'); ?></title>
<meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
<meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
<?php if(Route::is('product.detail')): ?>
<meta property="og:title" content="<?php echo $__env->yieldContent('og_title'); ?>" />
<meta property="og:description" content="<?php echo $__env->yieldContent('og_description'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="<?php echo $__env->yieldContent('og_image'); ?>" />
<meta property="og:image:type" content="image/*" />
<meta property="og:image:height" content="300" />
<meta property="og:image:width" content="300" />
<meta property="og:site_name" content="<?php echo e(setting()->comp_name); ?>" />
<meta property="og:url" content="<?php echo e(Request::fullUrl()); ?>" />

<script type="application/ld+json">
{
"@context": "https://schema.org/", 
"@type": "Product", 
"name": "<?php echo e($data->name); ?>",
"image": "<?php echo e(setting()->website_url); ?>/uploaded_files/product/<?php echo e($data->image); ?>",
"description": "<?php echo $__env->yieldContent('og_description'); ?>",
"brand": {
"@type": "Brand",
"name": "<?php echo e($data->brand); ?>"
},
"sku": "<?php echo e($data->sku); ?>",
"mpn": "<?php echo e($data->asin); ?>",
"offers": {
"@type": "Offer",
"url": "<?php echo e(Request::fullUrl()); ?>",
"priceCurrency": "INR",
"price": "<?php echo e($data->price); ?>",
"availability": "https://schema.org/InStock",
"itemCondition": "https://schema.org/NewCondition"
},
"aggregateRating": {
"@type": "AggregateRating",
"ratingValue": "4.5",
"ratingCount": "1"
}
}
</script>
<?php else: ?> 
<?php echo setting()->site_schema; ?>

<?php endif; ?>

<?php if(!empty(setting()->favicon)): ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('uploaded_files/favicon/'.setting()->favicon)); ?>">
<?php endif; ?>

<meta name="author" content="<?php echo e(setting()->company_name); ?>">
<link rel="canonical" href="<?php echo e(Request::fullUrl()); ?>" />
<link rel="stylesheet" href="assets/css/preloader.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/meanmenu.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/slick.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link href="assets/glightbox/css/glightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/nice-select.css">
<link rel="stylesheet" href="assets/css/ui-range-slider.css">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="admin_assets/css/alertify/alertify.min.css"/>
<link rel="stylesheet" href="admin_assets/css/alertify/default.min.css"/>
<link rel="stylesheet" href="assets/css/rating.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css" integrity="sha512-uq8QcHBpT8VQcWfwrVcH/n/B6ELDwKAdX4S/I3rYSwYldLVTs7iII2p6ieGCM13QTPEKZvItaNKBin9/3cjPAg==" crossorigin=anonymous >
<?php echo $__env->yieldContent('custom-css'); ?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/menu.js"></script>
<script src="https://cdn.razorpay.com/widgets/affordability/affordability.js">
</script>
<?php echo setting()->site_verification; ?>

<?php echo setting()->analytics; ?>

</head>
<body>
<?php echo e(generateSession()); ?>


<!-- preloader start -->
<!--<div id="loading ">-->
<!--<div id="loading-center">-->
<!--<div id="loading-center-absolute">-->
<!--    <img src="assets/img/computer.gif">-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!-- preloader end --><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/layouts/header.blade.php ENDPATH**/ ?>