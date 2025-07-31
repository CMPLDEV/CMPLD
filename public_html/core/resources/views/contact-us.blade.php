@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('custom-css')
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')

<main>

<!-- ======slider-area-start=========================================== --> 
<div class="slider-area over-hidden">
<div class="single-page page-height d-flex align-items-center" @if(!empty($page->banner)) data-background="uploaded_files/page/{{$page->banner}}" @else data-background="{{noBanner()}}" @endif>
<div class="container">
<div class="row">
<div class="col-xl-12  col-lg-12  col-md-12  col-sm-12 col-12">
<div class="page-title text-start">
<h2 class="text-capitalize text-white  mb-25 pt-35" style="font-size:30px !important; letter-spacing:1px">{{$page->name}}</h2>
</div><!-- /page title -->
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
<!-- </div> -->
</div><!-- /single-slider -->
</div>
<!-- slider-area-end=  -->

<!-- contact-wrap-start --> 
<section class="contact-wrap">
    
<div class="contact-form-area over-hidden">
<div class="container-wrapper pl-15 pr-15 pl-80 pr-80 pt-50 pb-50 bg-white">
<div class="row">
<div class="col-xl-6  col-lg-6  col-md-12  col-sm-12 col-12">
<!--<div class="contact-form-left mb-30 pr-100">
<div class="section-title text-left pb-30">
<span class="secondary-color pb-2 d-block">Contact us</span>
<h2>Please contact us quickly if
    you need help.</h2>
</div>
<div class="contact-address pb-3">
<span class="blue-color">Location Details</span>
<p>{{setting()->address}} {{setting()->city}} - {{setting()->pincode}} {{state(setting()->state)}} {{country(setting()->country)}}</p>
</div>
<div class="contact-address pb-3">
<span class="blue-color">Contacts</span>
<p class="m-0"><a href="tel:{{setting()->mobile}}" style="color: #000;">{{setting()->mobile}}</a></p>
@if(!empty(setting()->phone))
<p class="m-0"><a href="tel:{{setting()->phone}}" style="color: #000;">{{setting()->phone}}</a></p>
@endif
</div>
<div class="contact-address">
<span class="blue-color">Email Address</span>
<p><a href="mailto:{{setting()->email}}" style="color: #000;">{{setting()->email}}</a></p>
@if(!empty(setting()->alt_email))
<p><a href="mailto:{{setting()->alt_email}}" style="color: #000;">{{setting()->alt_email}}</a></p>
@endif
</div>
</div>-->
<div class="ckeditor-content">
{!! $page->content !!}
</div>
</div><!-- /col -->
<div class="col-xl-6  col-lg-6  col-md-12  col-sm-12 col-12">
<div class="contact-form-right mb-30">

<form action="{{route('enquiry.submit')}}" method="post">
@csrf 
<input type="hidden" name="source" value="{{Request::fullUrl()}}">  
<span class="secondary-color pb-10 d-block">Write to us</span>
<div class="name mb-30">
 <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" id="name" placeholder="Name*" >
 @error('name')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
<div class="email mb-30">
 <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="c-email" placeholder="Email*" >
 @error('email')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="row">

<div class="col-lg-6">
 <div class="email mb-30">
 <select name="country" class="form-control">
 @foreach(countries() as $row)
   <option value="{{$row->id}}" @if($row->id==101) selected @endif>[+{{$row->phonecode}}] {{$row->name}}</option> 
 @endforeach
</select>
</div>
 </div> 

 <div class="col-lg-6">
 <div class="email mb-30">
 <input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{old('mobile')}}" id="c-email" placeholder="Mobile No*" >
 @error('mobile')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
 </div> 
</div>

<div class="comment mb-30">
 <textarea name="message" class="form-control @error('message') is-invalid @enderror" id="message" placeholder="Comments">{{old('message')}}</textarea>
 @error('message')
  <span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="mb-3">
<div class="g-recaptcha" data-sitekey="{{setting()->g_recaptcha_site_key}}"></div>
@if ($errors->has('g-recaptcha-response'))
 <span class="invalid-feedback d-block fw-bold" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
@endif
</div>

<div class="text-center">
<button type="submit" class="btn form-control text-white transition">Send</button>
</div>
</form>
</div>
</div><!-- /col -->
</div><!-- /row -->
</div><!-- /container -->
</div>
</section>
<!-- contact-wrap-end -->

<!-- conatct-map-start --> 
<section class="map-wrap">
<div class="contact-map position-relative">
<div class="container-fluid px-0">
{!! setting()->map !!}
</div>
</div>
</section>
<!-- conatct-map-end -->

</main>

@endsection