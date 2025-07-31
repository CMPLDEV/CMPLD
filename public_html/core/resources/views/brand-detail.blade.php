@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')
<style>
.drivers-text p{
font-size: 25px;
font-weight: 500;
}
.driver-list{transition: 0.5s ease;}
.driver-list:hover {
transform: translate(0px, -10px);
}
.driver-list a{
padding: 12px 28px;
box-shadow: 0px 0px 2px #0000004a;
background: url('assets/img/driver-li.jpg');
background-size: cover;
background-repeat: no-repeat;
background-position: bottom;
color: #fff;
font-size: 20px;
border-radius: 6px;
}
</style>

<main>

@if(!empty($data->banner))  
<div class="drivers position-relative">
<img src="assets/img/driver.jpg" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="w-100" style="max-height: 300px;object-fit: cover;
">
<div class="drivers-text position-absolute top-50 start-50 translate-middle">
<p class="text-white m-0">Driver's & Download</p>
</div>
</div>
@endif
<section class="blog__area pt-100 pb-100">
<div class="container"> 
<!--<div class="row">-->
<!--<div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1"></div>-->
<!--<div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10">-->
<!--@if(!empty($data->image))    -->
<!--<img src="{{showImage($data->image,'uploaded_files/category')}}" alt="{{setting()->comp_name}}" class="support-img" title="{{setting()->comp_name}}">-->
<!--@endif-->
<!--<p>{!! $data->content !!}</p>-->
<!--</div>-->
<!--</div>-->

@if($softwares->isNotEmpty())
<br>
<div class="row">
<div class="col-lg-12">
<ul>
@foreach($softwares as $row)     
<li class="brand-list driver-list"><a @auth href="{{$row->link}}" target="_blank" @else href="javascript:void(0);" onClick="notification('error','At first please login to download this driver.');" @endauth>{{$row->name}} <i class="fad fa-cloud-download"></i> </a></li> 
@endforeach    
</ul>     
</div>   
</div>
@endif

</div>
</section>

</main>

@endsection