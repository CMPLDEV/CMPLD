@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('custom-css')
<style>
.support-text{
 top: 50%;
 left: 5%;
 transform: translate(-5%, -50%);
 max-width: 500px;
}
.support-text h2{
 font-size: 36px;
 line-height: 36px;
 color:#ffffff;
 margin-bottom:20px;
}
.support-text p{
 color:#ffffff;
}
.video-section {
 box-shadow: 0px 0px 2px #0000003b;
 padding: 22px;
}
.warnt-card{    
 cursor: pointer;
 background: linear-gradient(65deg, #fe3138fa, #a94045);
 outline: 1px dashed #fff;
 outline-offset: -5px;}
.wt-sec .col-lg-3{padding: 0px 5px;}
.pds{font-size: 12px;}
.buttn{padding: 5px 10px;border: 1px solid rgb(6 114 203);font-size: 14px;
 border-radius: 4px;color: rgb(6 114 203);position: absolute;bottom: 25px;}
.support{position: relative;padding: 10px;
 box-shadow: 0px 0px 2px #0000003b;}
.new{background-color: #f5f5f5; padding: 20px;}
.cmp-new {padding: 10px;font-size: 13px;color: darkgray;}
</style>
@endsection

@section('content')

<main>

@if(!empty($page->banner))   
<div class="position-relative mb-5">
<img src="{{showImage($page->banner,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="w-100 sp-bann" > 
<div class="position-absolute support-text">
<h2>Welcome To CMPL Support</h2>
<p>Support for all your needs, in one place. Sign in to get personalized help and access your registered devices, software and existing service requests.</p>
</div>
</div>
@endif

<!-- signin buttons -->
<div class="buttons">
<div class="container-fluid">
<a class="custm_button cstm_one" href="{{route('login')}}">Sign In</a>
<a class="custm_button cstm_two" href="{{route('register')}}">Create An Account</a>
<a class="custm_button cstm_two" href="{{route('userpanel.ticket')}}"> <i class="fal fa-user-headset"></i> Raise Ticket</a>
</div>
</div>
<!-- signin buttons -->

<section class="wt-sec pt-5 pb-3">
<div class="container-fluid">
<h3 class="text-center fs-2 fw-normal text-capitalize mb-3">Topics that might interest you
</h3>
<div class="row mb-3">
<div class="col-lg-3 col-12 pb-3">
<a href="https://www.youtube.com/channel/UChfB7ZjYzu9jKeo3nqBPqIA" target="_blank">
<div class="video-section h-100">
<span class="mb-2 d-block"><img src="assets/img/clapperboard.png" alt="Clapperboard" style="max-width: 22px;"> Support Videos</span>
<p>A library of videos to help your discover features,
troubleshoot issues and more.
</p>
<b>CMPL Support Youtube Channel</b>
</div>
</a>
</div>
<div class="col-lg-9 col-12">
<div class="row">
<div class="col-lg-3 pb-3" style="padding: 0px 5px;">
<div class="support h-100">
<span class="mb-2 d-block"><img src="assets/img/shopping-cart-new.png" alt="Cart" style="max-width: 20px;"> Order Support</span>
<p>Check your order status, view invoices or request a return.</p>
<a href="#" class="buttn">Find Order Status</a>
</div>
</div>
<div class="col-lg-3 pb-3">
<a href="{{route('all-products')}}">
<div class="h-100">
<div class="support text-center">
<span class="mb-2 d-block text-center"><b>Browse All Products</b></span>
<img class="d-block mx-auto" src="assets/img/lapy.webp" alt="Browse Products" style="max-width: 80px;">    
<p class="mb-2"><b>Computers</b></p>
<span class="pds">Laptops,Desktops,All-in-ones,Thin Clinets and Tablets</span>
</div>
</div>
</a>
</div>
<div class="col-lg-3 pb-3">
<div class="support text-center h-100">
<b>Contact Us</b> 
<p class="m-0">Contact with CMPL Support</p> 
<hr> 
<div class="support-icon d-flex justify-content-center">
<a href="mailto:info.cmpl6@gmail.com" class="mx-2 d-block" data-toggle="tooltip" title="Email Support">
    <img src="assets/img/email-us.png" alt="Email Support" style="max-width: 40px;">
</a> 
<a href="tel:+1800 203 0596" class="mx-2 d-block" data-toggle="tooltip" title="Call Us"><img src="assets/img/call-us.png" alt="Call Us" style="max-width: 40px;"></a>
<a href="https://api.whatsapp.com/send?phone={{setting()->mobile}}&amp;text=EnquiryNow" target="_blank" class="mx-2 d-block" data-toggle="tooltip" title="Whatsapp Us"><img src="assets/img/whatsapp-us.png" alt="Whatsapp Us" style="max-width: 40px;"></a>
</div>
</div>
</div>
<div class="col-lg-3 pb-3" style="padding: 0px 5px;">
<div class="h-100 warnt-card support p-0 text-center d-flex align-items-center justify-content-center" id="main-data" style="cursor: pointer">
<div class="time"> 
<a href="{{route('warranty')}}">
<img src="assets/img/time.png" alt="Warranty Enquiry" style="max-width: 30px;"> 
<br>
<b class="text-white">Warranty Enquiry</b> 
</a>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- new and announcement -->
<div class="row">
@if($news->isNotEmpty())    
<div class="col-lg-8 pb-3">
<div class="new h-100">
<p class="fs-2 fw-bold">News & Announcement</p>
<div class="">
@foreach($news as $row)    
<div class="cmp-new">
<a href="{{route('blog.detail', $row->slug)}}">
<span>{{date('d-m-Y',strtotime($row->created_at))}}</span>
<p>{{$row->name}}</p>
</a>
</div>
@endforeach
</div>
</div>
</div>
@endif
<div class="col-lg-4 pb-3">
<div class="widget f-widget white-bg pb-30 p-3">
<h5 class="f-widget-title text-black">Subscribe For Latest Update</h5>
<div class="subscribe-content">
<div class="subscribe-form-2 mb-30 d-flex">
<input type="email" class="subscription_email" placeholder="Enter your email...">
<button class="p-btn border-0" onClick="subscription();">Subscribe</button>
</div>
<div class="popup-social">
@if(!empty(setting()->facebook))
<a href="{{setting()->facebook}}"><i class="fab fa-facebook-f"></i></a>
@endif
@if(!empty(setting()->twitter))
<a href="{{setting()->twitter}}"><i class="fab fa-twitter"></i></a>
@endif
@if(!empty(setting()->instagram))
<a href="{{setting()->instagram}}"><i class="fab fa-instagram"></i></a>
@endif
@if(!empty(setting()->linkedin))
<a href="{{setting()->linkedin}}"><i class="fab fa-linkedin"></i></a>
@endif
@if(!empty(setting()->youtube))
<a href="{{setting()->youtube}}"><i class="fab fa-youtube"></i></a>
@endif
</div>
</div>
</div>
</div>
</div>
</div>
</section>

</main>

@endsection