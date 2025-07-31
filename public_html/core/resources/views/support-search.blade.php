@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('custom-css')
<style>
 .support-text{
   top: 50%;
   left: 5%;
   transform: translate(-5%, -50%);
   max-width: 500px;
 }
 .support-text h2{
   font-size: 36px;
   line-height: 36px;
   color:#ffffff;
   margin-bottom:20px;
 }
 .support-text p{
   color:#ffffff;
 }
</style>
@endsection

@section('content')

<main>
@if(!empty($data))

<div class="position-relative">
 <img src="assets/img/componets.jpg" alt="Support Services Details" title="Support Services Details" class="w-100 sp-bann" > 
<div class="position-absolute support-text">
    <h2>Support Services Details</h2>
    <p>Support for all your needs, in one place. Sign in to get personalized help and access your registered devices, software and existing service requests.</p>
</div>
</div>

<section class="blog__area pt-100 pb-100">
<div class="container"> 
<div class="row Support-box p-3">

@if(!empty($product))
<div class="col-md-4 col-12 technical-Support p-0">
<div class="card">
 <a href="{{productURL($product->slug)}}" target="_blank">    
 <div class="card-header">
  <p>{{$data->product_name}}</p>    
 </div>    
 <div class="card-body">
  <img src="{{showImage($product->image,'uploaded_files/product')}}" width="100%" />  
 </div>    
 <div class="card-footer">
  <small class="text-muted"><i>{{$product->category_name}}</i></small>
 <br/>
 @if(!empty($product->sku))
  <small><strong>SKU:</strong> {{$product->sku}}</small>
 @endif    
 </div>
 </a>
</div>    
 
</div>
@endif

<div class="col-md-8 col-12 p-0">

<div class="card">
 <div class="card-body">
  <div class="row">
@if(!empty($data->serial_no))
<div class="col-md-4 col-6 technical-Support mb-4">
 <strong>Serial No </strong> </br> {{$data->serial_no}}     
</div>
@endif

@if(!empty($data->quantity))
<div class="col-md-4 col-6 technical-Support mb-4">
 <strong>Quantity </strong> </br> {{$data->quantity}}     
</div>
@endif

@if(!empty($data->warranty_start_date))
<div class="col-md-4 col-6 technical-Support mb-4">
 <strong>Warranty Start Date </strong> </br> {{date('d/m/Y',strtotime($data->warranty_start_date))}}     
</div>
@endif

@if(!empty($data->warranty_end_date))
<div class="col-md-4 col-6 technical-Support mb-4">
 <strong>Warranty End Date </strong> </br> {{date('d/m/Y',strtotime($data->warranty_end_date))}}     
</div>
@endif

@if(!empty($data->warranty_end_date))
<div class="col-md-4 col-6 technical-Support mb-4">
 <strong>Warranty Left </strong> </br> {{$warranty_left}}     
</div>
@endif
</div>   
  @if(!empty($data->remark))
  <div class="row">
   <div class="col-md-12 col-12 technical-Support mb-4">
   <strong>Remark </strong> </br> {{$data->remark}}     
   </div>      
  </div>
  @endif
 </div>    
</div>    

</div>

</div>

<div class="row mt-5">
 <div class="col-lg-12 col-12">
  <center>      
   <a class="custm_button cstm_two" href="{{route('userpanel.ticket')}}"> <i class="fal fa-user-headset"></i> Raise Ticket</a>
  </center>
 </div>    
</div>

</div>
</section>

@else

<div class="container mt-3">
 <div class="row">
  <div class="col-lg-6 offset-lg-3">
   <div class="alert alert-danger alert-dismissible fade show">
    <strong>No data available to show</strong>
   </div>      
  </div>     
 </div>    
</div>

@endif
</main>

@endsection