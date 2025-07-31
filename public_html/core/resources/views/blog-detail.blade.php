@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>

@if(!empty($row->banner))
 <img src="uploaded_files/blog/{{$row->banner}}" width="100%" />
@endif

<!-- blog area start -->
<section class="blog__area pt-100 pb-100">
<div class="container">
<div class="row">
<div class="col-xxl-9 col-xl-9 col-lg-8">
<div class="postbox__wrapper pr-45">
<div class="postbox__details">
<div class="postbox__details-thumb w-img mb-50">
<a href="{{route('blog.detail',$row->slug)}}">
<img src="{{showImage($row->image,'uploaded_files/blog')}}" alt="{{$row->name}}" title="{{$row->name}}">
</a>
</div>
<div class="postbox__details-content">

<h3 class="postbox__details-title">
<a href="{{route('blog.detail',$row->slug)}}">{{$row->name}}</a>
</h3>
<div class="postbox__meta postbox__meta-2">
<div class="blog-meta d-inline-block mr-55 postbox__meta-2-line">
Post date 
<a href="#"><span>{{date('d M, Y',strtotime($row->created_at))}}</span></a> 
</div>
</div>
<div class="postbox__text">
{!! $row->content !!}
</div>
<div class="postbox__line mt-50 mb-45"></div> 
</div>
</div>
</div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-4">
<div class="blog__sidebar">
@if($blogs->isNotEmpty())
<div class="sidebar__widget sidebar__widget-padding mb-30">
<h5 class="sidebar__widget-title mb-30">Popular Posts</h5>
<div class="sidebar__post">
<div class="rc-post-wrapper">
<div class="row">
    @foreach($blogs as $blog)
<div class="col-lg-12 col-md-6">
    <div class="rc-post-item">
<div class="rc-post-thumb mr-10">
<a href="{{route('blog.detail',$blog->slug)}}">
<img src="{{showImage($blog->image,'uploaded_files/blog')}}" alt="{{$blog->alt}}" title="{{$blog->title}}">
</a>
</div>
<div class="rc-post-content">
<h5 class="rc-post-title">
<a href="{{route('blog.detail',$blog->slug)}}">{{$blog->name}}</a>
</h5>
<div class="rc-post-meta">
<span>{{date('d M, Y',strtotime($blog->created_at))}}</span>
</div>
</div>
</div>
</div>
@endforeach
</div>
</div>
</div>
</div>
@endif
</div>
</div>
</div>
</div>
</section>
<!-- blog area end -->

</main>

@endsection