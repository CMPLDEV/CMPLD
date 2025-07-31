@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')
<style>
    .ban-img img{
        max-height: 350px;
    }
    .overlay {
    height: 100%;
    left: 0px;
    top: 0px;
    position: absolute;
    width: 100%;
    background: #0d111385;
    opacity: 1.9;
}
.img-text{z-index: 1;}
.cc_bx img{border: 1px solid #000; border-bottom: 0px;}
.cc_bx{box-shadow: 0px 0px 5px #00000036}
.cc_text {
    background-color: #e3120b;
    padding: 10px 10px;
    outline: 1px dashed #fff;
    outline-offset: -5px;
}
</style>

<main>


@if(!empty($page->banner))   
<div class="ban-img position-relative">
     <img src="{{showImage($page->banner,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="w-100"> 
     <div class="img-text position-absolute top-50 start-50 translate-middle">
         <span class="fs-2 fw-bold text-white">Our Clients</span>
     </div>
     <div class="overlay"></div>
</div>
@endif
<section class="blog__area partner-area pt-100 pb-50">
<div class="container"> 
@if($data->isNotEmpty())
<div class="row justify-content-center">
@foreach($data as $row)
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-6 mb-4">
<div class="cc_bx">
     <img src="uploaded_files/our_client/{{$row->image}}" alt="{{setting()->comp_name}}" />
     <div class="cc_text text-center">
         <p class="m-0 text-white">{{$row->title}}</p>
     </div>
</div>
</div>
@endforeach
</div>
@else
 <div class="row">
  <div class="col-lg-6 offset-lg-3">
    <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    <strong>No data available to show</strong>.
  </div>  
  </div>     
 </div>
@endif
</div>
</section>
<!-- blog area end -->
</main>

@endsection