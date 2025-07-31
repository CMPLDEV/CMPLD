<div class="product__modal-area modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-centered ajax-modal-dialog" role="document">
<div class="modal-content" id="ajax-content">
<!-- DATA LOADING VIA AJAX -->
</div>
</div>
</div>

<!-- footer area start -->
<footer class="footer-area footer-1 black-bg pt-100 gray-bg-2 pb-80">
<div class="container">
<div class="row">
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-6">
<div class="widget f-widget pb-30 wow fadeInUp" data-wow-delay=".2s">
<h5 class="f-widget-title white-color">Information</h5>
<ul>
<?php if(pages('for_footer')->isNotEmpty()): ?>
<?php $__currentLoopData = pages('for_footer'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
<li><a href="<?php echo e(route($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</ul>
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-6">
<div class="widget f-widget pb-30 wow fadeInUp" data-wow-delay=".3s">
<h5 class="f-widget-title white-color">Our Category</h5>
<ul>
<?php if(categories()->isNotEmpty()): ?>
<?php $__currentLoopData = categories()->take(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li><a href="<?php echo e(categoryURL($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<li><a href="<?php echo e(route('all-categories')); ?>">View All</a></li>
<?php endif; ?>
</ul>
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4">
<div class="widget f-widget pb-30  wow fadeInUp" data-wow-delay=".4s">
<h5 class="f-widget-title white-color">Payment & Shipping</h5>
<ul>
<?php $__currentLoopData = subpages('for_footer'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<li><a href="<?php echo e(route($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
<h5 class="f-widget-title white-color mt-3">My Account</h5>
<ul>
 <li><a href="<?php echo e(route('userpanel.profile')); ?>">My Profile</a></li>   
 <li><a href="<?php echo e(route('userpanel.order')); ?>">My Orders</a></li>  
 <li><a href="<?php echo e(route('userpanel.order.return')); ?>">Return & Refund</a></li>
 <li><a href="<?php echo e(route('userpanel.ticket')); ?>">Raise Ticket</a></li>   
</ul>    
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-12">
<div class="widget f-widget pb-30 wow fadeInUp" data-wow-delay="0.6s">
<h5 class="f-widget-title white-color">Contact Us</h5>
<div class="subscribe-content">
<ul class="contact-info">
 <li> <b><i class="fas fa-map-marker-alt text-white"></i></b> <?php echo e(setting()->address); ?> <?php echo e(setting()->city); ?> - <?php echo e(setting()->pincode); ?> <?php echo e(state(setting()->state)); ?> <?php echo e(country(setting()->country)); ?></li>    
 <li> <b><i class="fas fa-phone-alt text-white"></i></b> <?php echo e(setting()->mobile); ?>

 <?php if(!empty(setting()->phone)): ?>, <?php echo e(setting()->phone); ?> <?php endif; ?></li>
 <li> <b><i class="far fa-envelope text-white"></i></b> <?php echo e(setting()->email); ?></li>
<?php if(!empty(setting()->alt_email)): ?> <li> <b><i class="far fa-envelope text-white"></i></b> <?php echo e(setting()->alt_email); ?></li> <?php endif; ?>
</ul>
<div class="popup-social">
<?php if(!empty(setting()->facebook)): ?>
<a href="<?php echo e(setting()->facebook); ?>"><i class="fab fa-facebook-f"></i></a>
<?php endif; ?>
<?php if(!empty(setting()->twitter)): ?>
<a href="<?php echo e(setting()->twitter); ?>"><i class="fab fa-twitter"></i></a>
<?php endif; ?>
<?php if(!empty(setting()->instagram)): ?>
<a href="<?php echo e(setting()->instagram); ?>"><i class="fab fa-instagram"></i></a>
<?php endif; ?>
<?php if(!empty(setting()->linkedin)): ?>
<a href="<?php echo e(setting()->linkedin); ?>"><i class="fab fa-linkedin"></i></a>
<?php endif; ?>
<?php if(!empty(setting()->youtube)): ?>
<a href="<?php echo e(setting()->youtube); ?>"><i class="fab fa-youtube"></i></a>
<?php endif; ?>
</div>

<div class="subscribe-form-2 mb-30 d-flex mt-4">
<input type="email" class="subscription_email" placeholder="Enter your email...">
<button class="p-btn border-0" onClick="subscription();">Subscribe</button>
</div>

</div>
</div>
</div>
</div>
</div>
<div class="copyright-area">
<div class="copyright-text copyright-text-3 text-center pt-20">
<div class="container d-md-flex justify-content-between align-items-center">
<p>
Copyright © Computronics Multivision Pvt Ltd all rights reserved</p>
<img src="assets/img/icon/icon1.png" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>">
</div>
</div>
</div>
<!-- /.copyright area end -->
</footer>
<!-- footer area end -->
<!--<div style="position: fixed; bottom: 30px; left: 30px; z-index: 999;">-->
<!--<a href="https://whatsapp.com/channel/0029VabEVssKmCPSK9lWLv1v-->
<!--"><img src="assets/img/joinn.png" alt="Whatsapp Channel" style="max-width: 180px;"></a>    -->
<!--</div>-->


<div class="aniketrod-widgets">
<div class="container">
<div class="row text-center">
<div class="col-7" style="padding-right: 0px;">
<div class="row">
<div class="col-4"><a href="<?php echo e(url('/')); ?>" class="expendcourses">
<i class="fa fa-home cm-i" aria-hidden="true"></i>
<div class="widget-text">Home</div>
</a></div>

<div class="col-4">

<a href="https://api.whatsapp.com/send?phone=<?php echo e(setting()->mobile); ?>&amp;text=Enquiry+Now" target="_blank"><i class="fab fa-whatsapp cm-i"></i><div class="widget-text">
Whatsapp
</div></a></div>

<div class="col-4">
<a href="<?php echo e(route('wishlist')); ?>">
<i class="fa fa-heart cm-i"></i>
<div class="widget-text">Wishlist </div>
</a>    
</div>

</div>
</div>
<div class="col-5" style="padding-left: 0px;">
<div class="row">

<div class="col-6 position-relative">
<a href="<?php echo e(route('cart')); ?>">
<i class="fa fa-shopping-cart cm-i" aria-hidden="true"></i>
<span class="position-absolute top-0 start-60 translate-middle badge rounded-pill bg-danger" id="total-cart"><?php echo e(cartCount()); ?></span>
<div class="widget-text">Cart</div>
</a>    
</div>

<div class="col-6"><a href="<?php echo e(route('userpanel.profile')); ?>"><i class="fa fa-user cm-i" aria-hidden="true" ></i>
<div class="widget-text">Account</div>
</a>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- MODAL FOR ADD/EDIT USER START -->
<div class="modal fade addedit-user" data-bs-backdrop="static" data-bs-keyboard="false">
<div class="modal-dialog modal-dialog-scrollable" id="user-modal">
<div class="modal-content rounded-0 addedit-user-content">
</div>
</div>
</div>
<!-- MODAL FOR ADD/EDIT USER END -->

<a class="whatsaap-icons" href="https://api.whatsapp.com/send?phone=<?php echo e(setting()->mobile); ?>&amp;text=Enquiry+Now" target="_blank"><img src="assets/img/whatsapp.png" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>" style="max-width: 150px;"></a>

<a class="back-to-top rounded-2 p-1 text-white"><i class="fas fa-chevron-up fa-2x"></i></a>

<!-- JS here -->
<script>let site_url = '<?php echo e(setting()->website_url); ?>';</script>
<script src="assets/js/waypoints.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/tweenmax.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/slick.min.js"></script>
<script src="assets/js/jquery-ui-slider-range.js"></script>
<script src="assets/js/jquery.meanmenu.min.js"></script>
<script src="assets/glightbox/js/glightbox.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/jquery.scrollUp.min.js"></script>
<script src="assets/js/countdown.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/parallex.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=66ab13f9595beb00197dfc4f&product=sop' async='async'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js" integrity="sha512-TToQDr91fBeG4RE5RjMl/tqNAo35hSRR4cbIFasiV2AAMQ6yKXXYhdSdEpUcRE6bqsTiB+FPLPls4ZAFMoK5WA==" crossorigin="anonymous"></script>
<script src="admin_assets/js/alertify/alertify.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/script.js"></script>
<script src="assets/js/filter.js"></script>
<script src="assets/js/cart.js"></script>
<?php echo $__env->yieldContent('custom-script'); ?>
<script>
$(document).ready(function(){
 let route = "<?php echo e(Route::currentRouteName()); ?>";    
 let message = '<?php echo e(Session::get('message')); ?>';
 let alert_array = message.split("|");
 let type = alert_array[0];
 let msg = alert_array[1];
 if(message!=""){
  notification(type,msg);
 } 

$(".quotes").slick({
 infinite: true,
 slidesToShow: 3,
 slidesToScroll: 1,
 autoplay: true,
 autoplaySpeed: 3500,
});

if(route == "home"){
 let offset = 0;
 let showcase_count = "<?php echo e(showcaseCount()); ?>";      
 let showcase_interval = setInterval(()=>{
 displayShowcase(offset);
 if(showcase_count == 1){
  clearInterval(showcase_interval);   
  $('#loader').hide();
 }
 offset++;
 showcase_count--;
 }, 1500);
}

});
$('#new').hide()
jQuery('#main-data').on('click',function(){
jQuery('#new').toggle();
});
const galleryLightbox = GLightbox({
selector: '.gallery-lightbox'
});

</script>

</body>
</html><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/layouts/footer.blade.php ENDPATH**/ ?>