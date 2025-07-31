<!-- header area start -->
<form action="<?php echo e(route('logout')); ?>" method="post" id="logout-form"><?php echo csrf_field(); ?></form>
<header>
    
<div class=" header-area">
   
    <!--topbar-->
<div class=" container-fluid header-top pt-2 pb-2 pl-60 pr-60 d-none d-lg-block">
<div class="row align-items-center">

<?php if(!empty(setting()->notification)): ?>

<div class="col-xxl-7 col-xl-7 d-none d-xl-block">
<marquee onmouseover="this.stop();" onmouseout="this.start();"><p class="text-white"><?php echo e(setting()->notification); ?> </p></marquee></div>

<?php endif; ?>
<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-8">
    
<div class="topbar-menu text-end d-flex justify-content-between">
<!--menu-->
<div class="topright-menu">
<a class="text-white contact" href="our-client.html"><span> Toll Free:</span> 1800 203 0596 </a>
<a class="text-white" href="about-us.html"> About Us</a>
<a class="text-white" href="faq.html" >FAQ</a>
</div>

<!--auth-->
<div class="text-white text-capitalize topright-auth">
<?php if(auth()->guard()->check()): ?>
<a href="<?php echo e(route('userpanel.profile')); ?>" class=""><?php echo e(strtok(Auth::user()->name, '')); ?></a>
<?php else: ?>
<a href="<?php echo e(route('login')); ?>" class="auth" >Login</span>
</a>
<a href="<?php echo e(route('register')); ?>" class="auth" >Register</span>
</a>
<?php endif; ?>
</div>

</div>

</div>

</div>

</div>
<!--Topbar end-->

<div class="search-header p-3 d-md-none d-block">
<div class="search__form  d-md-none d-block">
<form action="<?php echo e(route('search')); ?>" class="search-form">
<?php echo csrf_field(); ?>
<div class="search__input">
<input type="text" placeholder="Search Products" class="<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<button type="submit">
<i class="far fa-search"></i>
</button>
</div>
</form>
</div>
</div>
<div class="container-fluid header-main-2"> 

<div class="row align-items-center pt-3 pb-3 p-rel">
<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-6 col-4">
<div class="header-left text-center">
<div class="logo d-inline-block">
<a href=""><img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>"  title="<?php echo e(setting()->comp_name); ?>" style="max-height: 80px;"></a>
</div>
</div>
</div>
<div class="col-xx-7 col-xl-7 col-lg-7 col-md-5 d-sm-block d-none">

<div class="search__wrapper" style="position: static; transform: inherit;width: 100%;">
<div class="search__form">
<form action="<?php echo e(route('search')); ?>">
<?php echo csrf_field(); ?>
<div class="search__input row">
<div class="col-lg-2 col-md-4 p-0">
<select class="form-control border-0 h-100 rounded-0" name="category_id">
<option value="">All category</option>
<?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<option value="<?php echo e($row->id); ?>" <?php if(isset($category_id)): ?> <?php if($category_id == $row->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    </div>
<div class="col-lg-9 col-md-7 p-0">
<input style="border: none; border-right: 1px solid #ddd;border-left: 1px solid #ddd" type="text" placeholder="Search Products" class="<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<div class="col-lg-1 col-md-1 p-0 d-flex align-items-center justify-content-center">
<button type="submit">
<i class="far fa-search"></i>
</button>
</div>


</div>
</form>
</div>
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-5 col-sm-6 col-8">
<div class="header-right-wrapper d-flex align-items-center justify-content-end">
<div class="whatsapp-channel">
<a class="" href="https://whatsapp.com/channel/0029VabEVssKmCPSK9lWLv1v">
<img src="assets/img/whatsapp-channels.webp" alt="<?php echo e(setting()->comp_name); ?>" style="max-width: 180px;margin-right: 15px;" title="<?php echo e(setting()->comp_name); ?>">
</a>

</div>
<div class="header-right header-right-2 d-flex align-items-center justify-content-end">

<div class="header-icon header-icon-2 d-flex align-items-center ">
<p class="m-0 d-none">
<a href="javascript:void(0)" class="search-toggle"><i class="fal fa-search"></i></a>
</p>
<p class="m-0">
<a href="<?php echo e(route('wishlist')); ?>" class="d-none d-xl-inline-block"><i class="fal fa-heart"></i><span id="total-wishlist"><?php echo e(wishlistCount()); ?></span></a>
</p>
<button type="button" data-bs-toggle="modal" data-bs-target="#cartMiniModal" onClick="miniCart();"><i class="fal fa-shopping-cart"></i><span class="cart-item"><?php echo e(cartCount()); ?></span>
</button>
</div>
</div>
<div class="header-bar ml-20 d-lg-none">
<button type="button" class="header-bar-btn header-bar-btn-black" data-bs-toggle="modal" data-bs-target="#offCanvasModal">
<span></span>
<span></span>
<span></span>
</button>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="position-relative"> 
<div id="header-sticky" class="header-main header-main-2 header-padding-2 pl-60 header-sticky header-sticky-white" style="border-top: 1px solid #ececec;">
<div class="container">
<div class="search__form  d-md-none d-block">
<form action="<?php echo e(route('search')); ?>">
<?php echo csrf_field(); ?>
<div class="search__input">
<input type="text" placeholder="Search Products" class="<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<button type="submit">
<i class="far fa-search"></i>
</button>
</div>
</form>
</div>
</div>
<div class="col-xxl-12 col-xl-12 col-lg-12 d-none d-lg-block">
<div class="main-menu  d-flex align-items-center justify-content-center">
<nav id="mobile-menu">
<ul>
<li class="static">
<a href="#menu"> <span> <i class="fad fa-bars"></i> &nbsp; All Category 
</span> </a> </li>

<?php if(headerCategories()->isNotEmpty()): ?>  
<?php $__currentLoopData = headerCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="static">
<a href="<?php echo e(categoryURL($row->slug)); ?>"> <?php echo e($row->name); ?> <i class="icon-arrow-down"></i></a>
<ul class="sub-menu">
<li class="">
<?php if($row->show_brand): ?>
<!-- IF SHOW BRAND OPTION IS TRUE -->
<?php $__currentLoopData = categoryWiseBrands($row->brand_ids); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="col-md-12 has-dropdown"><a href="<?php echo e(route('category.wise.brand', [$row->slug,$brand->slug])); ?>">  <?php echo e($brand->name); ?></a>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

<?php else: ?>
<!-- OTHERWISE SHOW CATEGORIES -->
<?php $__currentLoopData = headerCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li class="col-md-12 has-dropdown"><a href="<?php echo e(categoryURL($subcat->slug)); ?>">  <?php echo e($subcat->name); ?></a>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

<?php endif; ?>
</li>
</ul>
</li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
<?php endif; ?>
<li class="static">
<style>
@media only screen and (min-width: 992px) {
#mahfil{background-image: url('assets/img/nav-support.jpg');
background-position: center right;background-size: 100%; height: 400px;}
.main-menu ul li .mega-menu.mega-menu-2-col .deskLi{width: 250px !important;
display: block; padding: 0 !important;}
.main-menu ul li .mega-menu.mega-menu-2-col .deskLi a{color: #fff;
border: none;font-size: 16px;}
}
</style>
<a href="javascript:void(0);"> Support <i class="icon-arrow-down"></i></a>
<ul class="mega-menu mega-menu-2-col" id="mahfil">
<li class="deskLi"> <a href="<?php echo e(route('support')); ?>">Check warranty status</a> </li>
<li class="deskLi"> <a href="<?php echo e(route('software-driver')); ?>">Software Driver</a> </li>
<li class="deskLi"> <a href="javascript:void(0);">Track your order</a> </li>
<li class="deskLi"> <a href="<?php echo e(route('contact-us')); ?>">Contact us</a> </li>
</ul>
</li>
<li class="static"><a href="<?php echo e(route('gift-offer')); ?>">  Offer Zone</a>
</li>
</ul>
</nav>
</div>
</div>
</div>
</div>
</header>
<!-- header area end -->

<nav id="menu">
<ul>

<?php $__currentLoopData = categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li>
<?php if(categories($row->id)->isEmpty()): ?> <a href="<?php echo e(categoryURL($row->slug)); ?>"><?php echo e($row->name); ?></a> <?php else: ?> <span><?php echo e($row->name); ?></span> <?php endif; ?>
<ul>
<?php $__currentLoopData = categories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
<li><a href="<?php echo e(categoryURL($row->slug)); ?>"><?php echo e($row->name); ?></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</li> 
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</ul>
</nav>


     
<script>
const menu = new MmenuLight( document.querySelector( '#menu' ), {
title: 'CMPL',
// theme: 'light',
// selected: 'Selected'
});
menu.enable( 'all' ); // '(max-width: 900px)'
menu.offcanvas({
// position: 'left',// [| 'right']
// move: true,// [| false]
// blockPage: true,// [| false | 'modal']
});

//	Open the menu.
document.querySelector( 'a[href="#menu"]' )
.addEventListener( 'click', ( evnt ) => {
menu.open();

//	Don't forget to "preventDefault" and to "stopPropagation".
evnt.preventDefault();
evnt.stopPropagation();
});

</script>     

<!-- cart mini area start -->
<div class="cartmini__area">
<div class="modal fade" id="cartMiniModal" tabindex="-1" aria-labelledby="cartMiniModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="cartmini__wrapper">
<div class="cartmini__top d-flex align-items-center justify-content-between">
<h4>Your Cart</h4>
<div class="cartminit__close">
<button type="button" data-bs-toggle="modal" data-bs-target="#cartMiniModal" class="cartmini__close-btn"> <i class="fal fa-times"></i></button>
</div>
</div>

<div id="mini-cart">

</div>

</div>
</div>
</div>
</div>
</div>
<!-- cart mini area end -->

<!-- search area start -->
<div class="search__area">
<div class="search__close">
<button type="button" class="search__close-btn search-close-btn"><i class="fal fa-times"></i></button>
</div>
<div class="search__wrapper">
<h4>Searching</h4>
<div class="search__form  d-md-block d-none">
<form action="<?php echo e(route('search')); ?>">
<?php echo csrf_field(); ?>
<div class="search__input">
<input type="text" placeholder="Search Products" class="<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
<?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
<span class="invalid-feedback" role="alert">
<strong><?php echo e($message); ?></strong>
</span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<button type="submit">
<i class="far fa-search"></i>
</button>
</div>
</form>
</div>
</div>
</div>
<!-- search area end -->


<!-- sidebar area start -->
<section class="offcanvas__area">
<div class="modal fade" id="offCanvasModal" tabindex="-1" aria-labelledby="offCanvasModal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="offcanvas__wrapper">
<div class="offcanvas__top d-flex align-items-center mb-60 justify-content-between">
<div class="logo side-logo"> 
<a href="">
<img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>" title="<?php echo e(setting()->comp_name); ?>">
</a>
</div>
<div class="offcanvas__close">
<button class="offcanvas__close-btn" data-bs-toggle="modal" data-bs-target="#offCanvasModal">
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
<div class="mobile-menu"></div>
</div>
<div class="offcanvas__action mb-15">
<?php if(auth()->guard()->check()): ?>
<a href="<?php echo e(route('userpanel.profile')); ?>">My Profile</a>
<?php else: ?>
<a href="<?php echo e(route('login')); ?>">Login</a>
<?php endif; ?>

</div>
<div class="offcanvas__action mb-15 ">
<a href="<?php echo e(route('wishlist')); ?>" class="has-tag">
<svg viewBox="0 0 22 22">
<path d="M20.26,11.3c2.31-2.36,2.31-6.18-0.02-8.53C19.11,1.63,17.6,1,16,1c0,0,0,0,0,0c-1.57,0-3.05,0.61-4.18,1.71c0,0,0,0,0,0
L11,3.41l-0.81-0.69c0,0,0,0,0,0C9.06,1.61,7.58,1,6,1C4.4,1,2.89,1.63,1.75,2.77c-2.33,2.35-2.33,6.17-0.02,8.53
c0,0,0,0.01,0.01,0.01l0.01,0.01c0,0,0,0,0,0c0,0,0,0,0,0L11,20.94l9.25-9.62c0,0,0,0,0,0c0,0,0,0,0,0L20.26,11.3
C20.26,11.31,20.26,11.3,20.26,11.3z M3.19,9.92C3.18,9.92,3.18,9.92,3.19,9.92C3.18,9.92,3.18,9.91,3.18,9.91
c-1.57-1.58-1.57-4.15,0-5.73C3.93,3.42,4.93,3,6,3c1.07,0,2.07,0.42,2.83,1.18C8.84,4.19,8.85,4.2,8.86,4.21
c0.01,0.01,0.01,0.02,0.03,0.03l1.46,1.25c0.07,0.06,0.14,0.09,0.22,0.13c0.01,0,0.01,0.01,0.02,0.01c0.13,0.06,0.27,0.1,0.41,0.1
c0.08,0,0.16-0.03,0.25-0.05c0.03-0.01,0.07-0.01,0.1-0.02c0.07-0.03,0.13-0.07,0.2-0.11c0.03-0.02,0.07-0.03,0.1-0.06l1.46-1.24
c0.01-0.01,0.02-0.02,0.03-0.03c0.01-0.01,0.03-0.01,0.04-0.02C13.93,3.42,14.93,3,16,3c0,0,0,0,0,0c1.07,0,2.07,0.42,2.83,1.18
c1.56,1.58,1.56,4.15,0,5.73c0,0,0,0.01-0.01,0.01c0,0,0,0,0,0L11,18.06L3.19,9.92z"/>
</svg>
<span class="tag" id="total-wishlist"><?php echo e(wishlistCount()); ?></span>
</a>
</div>
<div class="offcanvas__action mb-15 d-sm-block">
<a href="<?php echo e(route('cart')); ?>" class="has-tag">
<i class="far fa-shopping-bag"></i>
<span class="tag cart-item"><?php echo e(cartCount()); ?></span>
</a>
</div>
<div class="offcanvas__social mt-15">
<ul>
<?php if(!empty(setting()->facebook)): ?>
<li><a href="<?php echo e(setting()->facebook); ?>"><i class="fab fa-facebook-f"></i></a></li>
<?php endif; ?>
<?php if(!empty(setting()->twitter)): ?>
<li><a href="<?php echo e(setting()->twitter); ?>"><i class="fab fa-twitter"></i></a></li>
<?php endif; ?>
<?php if(!empty(setting()->instagram)): ?>
<li><a href="<?php echo e(setting()->instagram); ?>"><i class="fab fa-instagram"></i></a></li>
<?php endif; ?>
<?php if(!empty(setting()->linkedin)): ?>
<li><a href="<?php echo e(setting()->linkedin); ?>"><i class="fab fa-linkedin-in"></i></a></li>
<?php endif; ?>
<?php if(!empty(setting()->youtube)): ?>
<li><a href="<?php echo e(setting()->youtube); ?>"><i class="fab fa-youtube"></i></a></li>
<?php endif; ?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

</section>
<!-- sidebar area end --><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>