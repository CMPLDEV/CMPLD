@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')
<style>
.cc_bx img {
    border: 1px solid #000;
    border-bottom: 0px;
    padding: 15px;
}
.cc_bx {
    margin-bottom: 10px;
}
.cc_text {
    background-color: #e3120b;
    padding: 10px 10px;
    outline: 1px dashed #fff;
    outline-offset: -5px;
}
.cc_bx img{
    aspect-ratio: 3 / 2;
    object-fit: contain;
}
</style>

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

<section class="wt-sec pt-5 pb-3">
<div class="container-fluid">
<h3 class="text-center fs-2 fw-normal text-capitalize mb-3"> Brands </h3>

@if($brands->isNotEmpty())
<div class="category-area fix mt-3-px pb-75">
<div class="row">
@foreach($brands as $row)
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-12">
<a href="{{route('brand.detail',$row->slug)}}">
<div class="single-category p-rel wow fadeInUp" data-wow-delay=".3s" style="margin-bottom:4px">
<div class="cat-thumb cc_bx fix">
<img src="{{showImage($row->image,'uploaded_files/category')}}" alt="{{$row->name}}" title="{{$row->name}}" width="100">
</div>
<div class="cat-content p-abs bottom-left text-center p-0"> 
<span class="cat-subtitle cc_text text-white">{{$row->name}}</span>
</div>
</div>
</a>
</div>
@endforeach
</div>
</div>
@endif
</div>
</section>

</main>

@endsection