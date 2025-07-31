@extends('admin.layouts.app')
@section('title','Order Detail')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Order Detail</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Order Detail</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<div class="mt-3">
<div class="row">
 <div class="col-lg-9">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{COUNT($order_detail)}}</span>
  </div>

  <div class="col-lg-10">
 
  </div>
 </div> 


 </div>

</div>
</div>

<div class="card">
      <div class="card-header"><h4 class="text-white">Order No: {{$order->id}}</h4></div>     
      <div class="card-body">
         
      <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-bs-toggle="tab" href="#order">Order</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#address">Billing Address</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="tab" href="#shipping_address">Shipping Address</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="order" class="container tab-pane active"><br>
    <table class="table table-bordered">
    <thead>
      <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Net Price</th>
      </tr>
    </thead>
    <tbody>
    @foreach($order_detail as $row)    
      <tr>
        <td>{{$i++}}</td>
        <td><a href="{{url(Str::slug($row->item_name).'.html')}}" target="_blank">{{$row->item_name}}</a> @if(!empty($row->item_sku)) <p>SKU: {{$row->item_sku}}</p> @endif  </td>
        <td>{{setting()->currency.$row->item_unit_price}}</td>
        <td>{{$row->item_qty}}</td>
        <td>{{setting()->currency.$row->item_net_price}}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
    </div>

    <div id="address" class="container tab-pane fade"><br>
    <div class="card">
        <div class="card-body">
         <p><b> <i class="fas fa-user"></i> </b> &nbsp;&nbsp; {{$order->name}} </p>
         <p><b> <i class="fas fa-envelope"></i> </b> &nbsp;&nbsp; {{$order->email}} </p>
         <p><b> <i class="fas fa-phone"></i> </b> &nbsp;&nbsp; {{$order->mobile}} </p>
         <p><b> <i class="fas fa-map-marker"></i> </b> &nbsp;&nbsp; {{$order->address}} {{$order->city}}, {{state($order->state)}} {{$order->pincode}} - {{country($order->country)}}   </p>
        @if(!empty($order->gst_no)) 
         <p><b> <i class="fas fa-file-alt"></i> </b> &nbsp;&nbsp; {{$order->gst_no}} </p>
        @endif 
        </div>
        </div>
    </div>
    
    <div id="shipping_address" class="container tab-pane fade"><br>
    <div class="card">
        <div class="card-body">
         <p><b> <i class="fas fa-user"></i> </b> &nbsp;&nbsp; {{$order->shipping_name}} </p>
         <p><b> <i class="fas fa-envelope"></i> </b> &nbsp;&nbsp; {{$order->shipping_email}} </p>
         <p><b> <i class="fas fa-phone"></i> </b> &nbsp;&nbsp; {{$order->shipping_mobile}} </p>
         <p><b> <i class="fas fa-map-marker"></i> </b> &nbsp;&nbsp; {{$order->shipping_address}} {{$order->shipping_city}}, {{state($order->shipping_state)}} {{$order->shipping_pincode}} - {{country($order->shipping_country)}}   </p>
        </div>
        </div>
    </div>
    
  </div>
          
      </div>     
     </div>

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

@endsection
