@extends('layouts.app')

@section('title','Order Detail | User Panel')
@section('description','Order Detail | User Panel')
@section('keywords','Order Detail | User Panel')

@section('content')

<section class="user-wrap">
<div class="container">
    
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
    
<div class="dashboard-box">

<h4>Order no: {{$order->id}} 

<a href="{{route('userpanel.order')}}" class="btn btn-info btn-sm text-white float-end">Back</a>    
</h4>

<hr/>

<div class="outer-top row"> 
<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">Delivery Address</h5>
 <div class="mt-3">
 <h6> {{$order->name}} </h6>
 <p>{{$order->address}} {{$order->city}}, {{state($order->state)}} {{$order->pincode}} - {{country($order->country)}}</p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span>{{$order->mobile}}</span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span>{{$order->email}}</span>
 </div>    
</div>


<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">Shipping Address</h5>
 <div class="mt-3">
@if(!empty($order->shipping_address))
 <h6> {{$order->shipping_name}} </h6>
 <p>{{$order->shipping_address}} {{$order->shipping_city}}, {{state($order->shipping_state)}} {{$order->shipping_pincode}} - {{country($order->shipping_country)}}</p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span>{{$order->shipping_mobile}}</span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span>{{$order->shipping_email}}</span>
@else
 <h6> {{$order->name}} </h6>
 <p>{{$order->address}} {{$order->city}}, {{state($order->state)}} {{$order->pincode}} - {{country($order->country)}}</p>
 <h6 style="display:inline;">Phone Number</h6> &nbsp;<span>{{$order->mobile}}</span> <br/>
 <h6 style="display:inline;">Email Address</h6> &nbsp;<span>{{$order->email}}</span>
@endif
 </div>
</div>


<div  class="del-add col-12 col-lg-4">
    
 <h5 style="display:inline;">More Actions</h5>
 @if(!empty($invoice))
 <div class="d-flex justify-content-between align-item-center my-1 mt-3">
 <div class="d-flex">
  <i class="d-inline fad fa-file-pdf" style="--fa-primary-color: #b0b210; --fa-secondary-color: #b0b210;"></i>
  <h6 style="margin-left:5px">Download Invoice</h6>
  </div>
 <div><a href="{{route('userpanel.order.viewinvoice',$order->id)}}" class="btn btn-primary btn-sm" download>Download</a></div>
 </div>
  @else
  <div class="d-flex justify-content-between align-item-center my-1 mt-3">
   <small>No action available</small>
  </div> 
 @endif
</div>

</div>

<div class="row mt-4">
@foreach($order_detail as $row)  
 @php $product = \App\Models\Product::find($row->item_id, ['image','slug']); @endphp
 <div class="col-lg-6 col-12 mb-3">
<div class="row prodcard">
 <div class="col-4">
 <div class="img-container"><a @if(!empty($product)) href="{{productURL($product->slug)}}" @endif target="_blank"><img @if(!empty($product)) src="{{showImage($product->image, 'uploaded_files/product')}}" @else src="admin_assets/images/no-image.png" @endif width="100%"></a></div>
 </div>
 <div class="col-8">
 <div class="card-body">
 <h6 class="card-title"><a @if(!empty($product)) href="{{productURL($product->slug)}}" @endif target="_blank">{{Str::limit($row->item_name, 60, $end='..')}}</a></h6>
 <br/>
 <a @if(!empty($product)) href="{{productURL($product->slug)}}" @endif target="_blank">
@if(!empty($row->item_sku)) <p class="float-start"> <b>SKU :</b> {{$row->item_sku}} </p> @endif
 <p class="float-start"> <b>Price :</b> {{currency().$row->item_unit_price}} x {{$row->item_qty}} = {{currency().$row->item_net_price}} </p>
 <p class="float-start"> <b>Warranty :</b> {{date('d-m-y', strtotime($row->warranty_start))}} to {{date('d-m-y', strtotime($row->warranty_end))}} </p>
 </a>
 </div>
 </div>
</div>
</div>
@endforeach
</div>


</div>

</div>
</div>
</div>
</section>

@endsection