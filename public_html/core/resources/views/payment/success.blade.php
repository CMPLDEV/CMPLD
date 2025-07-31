@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<section class="od-cfm-sec">
<div class="container">
<div class="od-cfm-box">
<h2> Thank you for your order </h2>
<div class="row">
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
 <h3 class="success-green">#{{$order->id}} Your order is confirm</h3>
 <p>You'll receive a confirmation email with your number shortly</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<h3>Order Updates</h3>
<p>You'll get shipping and delivery updates by email.</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<p>Thankyou! Tracking details will be sent on your mail once the parcel shipped within 24-28 hours</p>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="od-bx">
<h3>Customer Information</h3>
<div class="customer-info">
<div class="ct-bx-1 common-box">
<h4>Contact Information</h4>
<span>{{$order->email}}</span>
<span>{{$order->mobile}}</span>
<h4>Shipping Address</h4>
<span>{{$order->address}} {{$order->city}} - {{state($order->state)}} {{country($order->country)}} - {{$order->pincode}}</span>
</div>
<div class="ct-bx-1 common-box">
<h4>Payment Method & Status</h4>
<span>{{$order->type}} - {{$order->payment_status}}</span>
<h4>Amount</h4>
<span>{{setting()->currency}} {{$order->net_amount}}</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="col-lg-6 col-md-6 col-sm-12">
<div class="main-od-box">
@foreach($order_detail as $row)    
<div class="od-mainbx">
<div class="od-img">
    
<img @if(!empty(products($row->item_id))) src="{{showImage(products($row->item_id)->image,'uploaded_files/product')}}" @else src="{{noImage()}}" @endif alt="{{$row->item_name}}" title="{{$row->item_name}}">

</div>
<div class="od-info">
<p>{{$row->item_name}}</p>
<div class="od-qty">
<span>Qty:{{$row->item_qty}}</span>
</div>
</div>
<div class="od-price">
<span>{{setting()->currency}}{{$row->item_net_price}}</span>
</div>
</div>
@endforeach

<div class="sub-box">
<div class="sub-tt">
<div class="sub-head">
    <p>Subtotal</p>
</div>
<div class="sub-price">
<span>{{setting()->currency}}</span>
<span>{{$order->amount}}</span>
</div>
</div>
<div class="sub-tt">
<div class="sub-head">
 <p>Discount</p>
</div>
<div class="sub-price">
<span>-{{setting()->currency}}</span>
<span>{{$order->discount}}</span>
</div>
</div>
</div>
<div class="od-tt">
<div class="tt-bx">
<div class="tt-bx-head">
 <p>Total</p>
</div>
<div class="tt-bx-pc">
 <span>{{setting()->currency}} {{$order->net_amount}}</span>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="conti-button text-center">
<a href="" class="btn conti-btn">Continue Shopping</a>
</div>
</div>
</div>
</section>

@endsection