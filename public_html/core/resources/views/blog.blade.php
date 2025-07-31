@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-2 pt-60 pb-60 include-bg" data-background="uploaded_files/page/{{$page->banner}}">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-left">
<h3 class="text-white">{{$page->name}}</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-start">
<li class="breadcrumb-item text-white"><a href="">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{$page->name}}</li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<!-- blog area start -->
<section class="blog__area pt-100 pb-100">
<div class="container">
@if($data->isNotEmpty())  
<div class="row">
@foreach($data as $row)
<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
<div class="single-blog blog-grid mb-30">
<div class="blog-thumb w-img">
<a href="{{route('blog.detail',$row->slug)}}"><img src="{{showImage($row->image,'uploaded_files/blog')}}" alt="{{$row->alt}}" title="{{$row->title}}"></a>
</div>
<div class="blog-content">
<div class="blog-meta">Post date <a href="#"><span>{{date('d M, Y',strtotime($row->created_at))}}</span></a>.
</div>
<h5 class="blog-title blog-title-1">
<a href="{{route('blog.detail',$row->slug)}}">{{$row->name}}</a>
</h5>
<p>{{Str::limit(strip_tags($row->content),100,$end='..')}}</p>
<div class="blog-btn">
<a class="s-btn s-btn-4" href="{{route('blog.detail',$row->slug)}}">Continue Reading</a>
</div>
</div>
</div>
</div>
@endforeach
{{$data->appends($_GET)->links()}}
</div>
@else
<div class="alert alert-danger alert-dismissible fade show w-50 m-auto">
 <strong>No data available to show !</strong>.
</div>
@endif
</div>
</section>
<!-- blog area end -->
</main>

@endsection