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
@if($data->isNotEmpty())
<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">
<div id="accordion">
@foreach($data as $row)
 <div class="card">
<div class="card-header">
  <a class="btn" data-bs-toggle="collapse" href="#collapse{{$row->id}}">
    Q{{$i++}}. {{$row->question}}
  </a>
</div>
<div id="collapse{{$row->id}}" class="collapse show" data-bs-parent="#accordion">
  <div class="card-body">
    {!!$row->answer!!}
  </div>
</div>
</div>
@endforeach
</div>
</div>
@endif

</div>
</div>

</section>

</main>
@endsection