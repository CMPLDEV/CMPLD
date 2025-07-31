@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>
@if(!empty($page->banner))   
<img src="{{showImage($page->banner,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="w-100"> 
@endif
<section class="blog__area pt-100 pb-50">
<div class="container"> 
<div class="row">
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
@if(!empty($page->image))    
<img src="{{showImage($page->image,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
@endif
</div>
<div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-12">
{!! $page->content !!}</div>
</div>

</div>
</section>

@if($offers->isNotEmpty())
<div class="container mt-4 mb-4">
<div class="row">
@foreach($offers as $row)     
<div class="col-lg-3">
<div class="card">
<a href="{{$row->link}}" target="_blank">   
<div class="card-body">
<img src="{{showImage($row->image, 'uploaded_files/offer')}}" alt="{{$row->name}}" style="width: 100%;
    height: 250px;"  />    
</div>   
<!--<div class="card-footer">
<!--{{$row->name}}    -->
<!--</div>-->
</a>
</div>       
</div>
@endforeach
{{$offers->appends($_GET)->links()}}
</div>
</div>
@endif

</main>

@endsection