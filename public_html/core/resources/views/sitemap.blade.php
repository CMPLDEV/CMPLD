@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>

<section class="blog__area pt-100 pb-100">
<div class="container"> 
<div class="row">
<div class="col-lg-12">
<div class="market-area-heading">
 <h1>{{$page->name}}</h1>
</div>
<div class="market-area">

<h4><a href="javascript:void(0);">Pages</a></h4>
<ul class="row">
@foreach($pages as $row)
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="{{route($row->slug)}}">{{$row->name}}</a></li>
@endforeach
</ul>

<h4><a href="javascript:void(0);">Blogs</a></h4>
<ul class="row">
@foreach($blogs as $row)
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="{{route('blog.detail',$row->slug)}}">{{$row->name}}</a></li>
@endforeach
</ul>

<h4><a href="javascript:void(0);">Categories</a></h4>
<ul class="row">
@foreach(categories() as $row)
 <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="{{categoryURL($row->slug)}}">{{$row->name}}</a></li>
 @foreach(categories($row->id) as $row)
  <li class="col-md-3 col-sm-6 col-12 my-2 market-aera-name"><a href="{{categoryURL($row->slug)}}">{{$row->name}}</a></li>
 @endforeach
@endforeach
</ul>

<h4><a href="javascript:void(0);">Products List</a></h4>
<ol class="row" type="1" >
@foreach($products as $row)
 <li class="col-md-12 col-sm-12 col-12 my-2 market-aera-name"> <b>{{++$i}}.</b> <a href="{{productURL($row->slug)}}">{{$row->name}}</a></li>
@endforeach
</ol>
{{$products->links()}}
</div>  
</div> 

</div>

</div>
</section>
</main>

@endsection