@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<img class="w-100" src="{{$banner}}" />

<!-- section pd-detail -->
<section class="pd-detail">
<div class="container-fluid">
@if(categories()->isNotEmpty())
<div class="">
<div class="pd-box-rl">
<div class="category-box">
<div class="category-feature-list">
<div id="" class="box-category row ">
@foreach(categories() as $row)
<div class="category-layout col-lg-4 col-md-4 col-6 my-2">
<div class="category-thumb clearfix">
<div class="images-hover image inner-image">
<a href="{{categoryURL($row->slug)}}">
<img src="{{showImage($row->image,'uploaded_files/category')}}" alt="{{$row->name}}" title="{{$row->name}}" class="img-responsive" />
</a>
</div>
<!--<div class="caption">-->
<!--<div class="cat-title">-->
<!--<a href="{{categoryURL($row->slug)}}" class="category-view"><h4> <span>{{$row->name}}</span> </h4></a>-->
<!--</div>-->
<!--</div>-->
</div>
</div>
@endforeach

</div>
</div>
</div>
</div>
</div>
@else
 <div class="alert alert-danger alert-dismissible fade in" style="width:50%;margin:auto;">
  <strong>No Record Found</strong>.
 </div>
@endif
</div>
</section>

@endsection