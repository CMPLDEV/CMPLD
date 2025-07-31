<!-- header area start -->
<form action="{{route('logout')}}" method="post" id="logout-form">@csrf</form>
<header>
    
<div class=" header-area">
   
    <!--topbar-->
<div class=" container-fluid header-top pt-2 pb-2 pl-60 pr-60 d-none d-lg-block">
<div class="row align-items-center">

@if(!empty(setting()->notification))

<div class="col-xxl-7 col-xl-7 d-none d-xl-block">
<marquee onmouseover="this.stop();" onmouseout="this.start();"><p class="text-white">{{setting()->notification}} </p></marquee></div>

@endif
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
@auth
<a href="{{route('userpanel.profile')}}" class="">{{strtok(Auth::user()->name, '')}}</a>
@else
<a href="{{route('login')}}" class="auth" >Login</span>
</a>
<a href="{{route('register')}}" class="auth" >Register</span>
</a>
@endauth
</div>

</div>

</div>

</div>

</div>
<!--Topbar end-->

<div class="search-header p-3 d-md-none d-block">
<div class="search__form  d-md-none d-block">
<form action="{{route('search')}}" class="search-form">
@csrf
<div class="search__input">
<input type="text" placeholder="Search Products" class="@error('search_keyword') is-invalid @enderror" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
@error('search_keyword')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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
<a href=""><img src="uploaded_files/logo/{{setting()->logo}}" alt="{{setting()->comp_name}}"  title="{{setting()->comp_name}}" style="max-height: 80px;"></a>
</div>
</div>
</div>
<div class="col-xx-7 col-xl-7 col-lg-7 col-md-5 d-sm-block d-none">

<div class="search__wrapper" style="position: static; transform: inherit;width: 100%;">
<div class="search__form">
<form action="{{route('search')}}">
@csrf
<div class="search__input row">
<div class="col-lg-2 col-md-4 p-0">
<select class="form-control border-0 h-100 rounded-0" name="category_id">
<option value="">All category</option>
@foreach(categories() as $row)
<option value="{{$row->id}}" @isset($category_id) @if($category_id == $row->id) selected @endif @endisset>{{$row->name}}</option>
@endforeach
</select>    </div>
<div class="col-lg-9 col-md-7 p-0">
<input style="border: none; border-right: 1px solid #ddd;border-left: 1px solid #ddd" type="text" placeholder="Search Products" class="@error('search_keyword') is-invalid @enderror" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
@error('search_keyword')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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
<img src="assets/img/whatsapp-channels.webp" alt="{{setting()->comp_name}}" style="max-width: 180px;margin-right: 15px;" title="{{setting()->comp_name}}">
</a>

</div>
<div class="header-right header-right-2 d-flex align-items-center justify-content-end">

<div class="header-icon header-icon-2 d-flex align-items-center ">
<p class="m-0 d-none">
<a href="javascript:void(0)" class="search-toggle"><i class="fal fa-search"></i></a>
</p>
<p class="m-0">
<a href="{{route('wishlist')}}" class="d-none d-xl-inline-block"><i class="fal fa-heart"></i><span id="total-wishlist">{{wishlistCount()}}</span></a>
</p>
<button type="button" data-bs-toggle="modal" data-bs-target="#cartMiniModal" onClick="miniCart();"><i class="fal fa-shopping-cart"></i><span class="cart-item">{{cartCount()}}</span>
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
<form action="{{route('search')}}">
@csrf
<div class="search__input">
<input type="text" placeholder="Search Products" class="@error('search_keyword') is-invalid @enderror" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
@error('search_keyword')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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

@if(headerCategories()->isNotEmpty())  
@foreach(headerCategories() as $row)
<li class="static">
<a href="{{categoryURL($row->slug)}}"> {{$row->name}} <i class="icon-arrow-down"></i></a>
<ul class="sub-menu">
<li class="">
@if($row->show_brand)
<!-- IF SHOW BRAND OPTION IS TRUE -->
@foreach(categoryWiseBrands($row->brand_ids) as $brand)
<li class="col-md-12 has-dropdown"><a href="{{route('category.wise.brand', [$row->slug,$brand->slug])}}">  {{$brand->name}}</a>
</li>
@endforeach 

@else
<!-- OTHERWISE SHOW CATEGORIES -->
@foreach(headerCategories($row->id) as $subcat)
<li class="col-md-12 has-dropdown"><a href="{{categoryURL($subcat->slug)}}">  {{$subcat->name}}</a>
</li>
@endforeach 

@endif
</li>
</ul>
</li>
@endforeach  
@endif
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
<li class="deskLi"> <a href="{{route('support')}}">Check warranty status</a> </li>
<li class="deskLi"> <a href="{{route('software-driver')}}">Software Driver</a> </li>
<li class="deskLi"> <a href="javascript:void(0);">Track your order</a> </li>
<li class="deskLi"> <a href="{{route('contact-us')}}">Contact us</a> </li>
</ul>
</li>
<li class="static"><a href="{{route('gift-offer')}}">  Offer Zone</a>
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

@foreach(categories() as $row)
<li>
@if(categories($row->id)->isEmpty()) <a href="{{categoryURL($row->slug)}}">{{$row->name}}</a> @else <span>{{$row->name}}</span> @endif
<ul>
@foreach(categories($row->id) as $row)  
<li><a href="{{categoryURL($row->slug)}}">{{$row->name}}</a></li>
@endforeach
</ul>
</li> 
@endforeach

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
<form action="{{route('search')}}">
@csrf
<div class="search__input">
<input type="text" placeholder="Search Products" class="@error('search_keyword') is-invalid @enderror" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
@error('search_keyword')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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
<img src="uploaded_files/logo/{{setting()->logo}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
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
@auth
<a href="{{route('userpanel.profile')}}">My Profile</a>
@else
<a href="{{route('login')}}">Login</a>
@endauth

</div>
<div class="offcanvas__action mb-15 ">
<a href="{{route('wishlist')}}" class="has-tag">
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
<span class="tag" id="total-wishlist">{{wishlistCount()}}</span>
</a>
</div>
<div class="offcanvas__action mb-15 d-sm-block">
<a href="{{route('cart')}}" class="has-tag">
<i class="far fa-shopping-bag"></i>
<span class="tag cart-item">{{cartCount()}}</span>
</a>
</div>
<div class="offcanvas__social mt-15">
<ul>
@if(!empty(setting()->facebook))
<li><a href="{{setting()->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
@endif
@if(!empty(setting()->twitter))
<li><a href="{{setting()->twitter}}"><i class="fab fa-twitter"></i></a></li>
@endif
@if(!empty(setting()->instagram))
<li><a href="{{setting()->instagram}}"><i class="fab fa-instagram"></i></a></li>
@endif
@if(!empty(setting()->linkedin))
<li><a href="{{setting()->linkedin}}"><i class="fab fa-linkedin-in"></i></a></li>
@endif
@if(!empty(setting()->youtube))
<li><a href="{{setting()->youtube}}"><i class="fab fa-youtube"></i></a></li>
@endif
</ul>
</div>
</div>
</div>
</div>
</div>
</div>

</section>
<!-- sidebar area end -->