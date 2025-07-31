@extends('layouts.app')

@section('title','Order | User Panel')
@section('description','Order | User Panel')
@section('keywords','Order | User Panel')

@section('content')

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">

@if($data->isNotEmpty())
<div class="order-box">
<div class="row">
@foreach($data as $row)     
 <div class="col-sm-6 col-12 mb-3 mb-sm-0">
<div class="card">
<div class="card-header">
 <div class="row">
<div class="col text-center order_no">
<span class="status" >#{{$row->id}}</span></div>
<div class="col text-center">{!! orderStatus($row->delivery_status) !!}</div>
</div>    
</div>
      
<div class="card-body p-0">

<div class="container p-0" id="order-body">
    
  <div class="column">
   <b>Payment Status : </b> {{$row->payment_status}}   
  </div>

  <div class="column">
   <b>Payment Mode : </b> {{$row->sub_type}}   
  </div>
 
 @if($row->discount > 0) 
  <div class="column">
  <b>Discount :</b> - {{currency().$row->discount}}   
  </div>
 @endif 

 <div class="column">
  <b>Created At :</b> {{date('d-m-Y @ h:i A', strtotime($row->created_at))}}  
 </div>
 
 @if(!empty($row->return_applicable_date) && $row->return_applicable_date >= date('Y-m-d'))
  <div class="column">
   <b>Applicable for return till :</b> {{date('d-m-Y', strtotime($row->return_applicable_date))}}  
  </div>
 @endif
 
</div>    
   
<h6 class="h5 p-2">{{currency().$row->net_amount}} for {{totalOrderItems($row->id)}} item(s)</h6>

</div>

<div class="card-footer p-0 m-0">
 
 <div class="grid-container">
  <div class="grid-item">
   <a href="{{route('userpanel.order.detail',$row->id)}}" class="btn-block s-btn s-btn-2 w-100">View Order</a>
  </div>
 @if($row->delivery_status=="PENDING") 
  <div class="grid-item">
   <a href="javascript:void(0);" onClick="cancelOrder('{{$row->id}}');" class="btn-block s-btn s-btn-2 bg-danger w-100">Cancel Order</a>
  </div>
 @endif 
 @if($row->delivery_status=="CANCELLED")
  <p class="mt-2"><strong><a href="javascript:void(0);" title="{{$row->cancel_note}}" class="text-danger">View Cancel Note</a></strong>  </p>
 @endif
 </div>    

</div>     
   
</div>
</div>
@endforeach
</div>    

</div>
<br>
{{$data->appends($_GET)->links()}}
@else
<h4 class="text-center text-capitalize" style="font-size: 13px">
 <img src="assets/img/order.webp" alt="No Order Available" class="empty">
 <br>
 No Order Available in your account.</h4>
 <br>
 <a href="" class="order-explore-bt">Explore Now</a>
@endif

</div>
</div>
</div>
</div>
</section>

@endsection