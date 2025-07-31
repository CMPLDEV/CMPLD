@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<div class="banner-header section-padding valign bg-img bg-fixed" data-overlay-dark="4" data-background="assets/img/slider/1.jpg">
<div class="container">
<div class="row">
<div class="col-md-12 caption mt-90">
<h5>{{setting()->comp_name}}</h5>
<h1>{{$page->name}}</h1>
</div>
</div>
</div>
</div>
<!-- About -->

<section class="about section-padding" data-scroll-index="1">
<div class="container">
<div class="row">
<div class="col-md-12 mb-30 animate-box" data-animate-effect="fadeInUp">
<div class="row">
<div class="col-lg-12">
<div class="market-area-heading">
 <h1>{{$page->name}}</h1>
</div>
<div class="market-area">

@if(marketplaces()->isNotEmpty())
 @foreach(marketplaces() as $cat)
<h4><a href="{{$cat->slug}}/">{{$cat->name}}</a></h4>
<ul>
@foreach(marketplaces($cat->id) as $loc)
 <li><a href="{{$loc->slug}}/">{{$loc->name}}</a></li>
@endforeach
</ul>
 @endforeach
@endif

</div>  
</div> 

</div>
</div>

</div>

</div>
</section>

@endsection