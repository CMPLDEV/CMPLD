@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>

<!-- coupon-area start -->
<section class="coupon-area pt-100 pb-30">
<div class="container">
<div class="row">
<div class="col-md-6">
@guest
<div class="coupon-accordion">
<h3>Returning customer? <span id="showlogin"><a href="{{route('login')}}">Click here to login</a></span></h3>
</div>
@endguest
</div>
<div class="col-md-6">
@auth    
@if($coupon = couponCondition())
@php $coupon_code = \App\Models\Coupon::find($coupon->coupon_id); @endphp
 <div class="input-group">
 <input type="text" class="form-control" disabled value="{{$coupon_code->code}}">
 <a onClick="return confirm('Are you sure?');" href="{{route('coupon.remove',$coupon->id)}}" class="s-btn s-btn-2"><i class="fa fa-times-circle"></i></a>
</div>
<p>{{$coupon_code->content}}</p>
@else
 <form method="POST" action="{{route('coupon.apply')}}">
  @csrf     
<div class="input-group">
 <input type="text" class="form-control @error('code')is-invalid @enderror" name="code" placeholder="Enter coupon code.">
 <button class="s-btn s-btn-2" type="submit">Apply</button>
</div>
@error('code')
 <span class="invalid-feedback d-block" role="alert">{{ $message }}</span>
@enderror
</form>
@endif
 
 @else
  <form method="POST" action="#">
  @csrf     
 <div class="input-group">
 <input type="text" class="form-control" name="code" placeholder="At first please login." disabled>
 <button class="s-btn s-btn-2" type="submit" disabled>Apply</button>
</div>
</form>
@endauth

</div>
</div>
</div>
</section>
<!-- coupon-area end -->

<!-- checkout-area start -->
<section class="checkout-area">
<div class="container">
<form method="POST" action="{{route('checkout.generate.order')}}" id="checkout-form">
 @csrf
<div class="row">
<div class="col-lg-7 col-12">

<!-- billing details -->
<div class="">
<div class="checkbox-form">
<h3>Billing Details</h3>
<div class="row">
<div class="col-md-4">
@auth
 <script> 
 $(document).ready(function(){
  checkPincode('{{user()->pincode}}');     
 });
 </script>
@endauth
<div class="checkout-form-list">
<label> GST No </label>
<input type="text" placeholder="Enter GST No" name="gst_no" class="@error('gst_no') is-invalid @enderror" @auth value="{{user()->gst_no}}" @else value="{{old('gst_no')}}" @endauth>
 @error('gst_no')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Company Name </label>
<input type="text" placeholder="Enter Company Name" name="company_name" class="@error('company_name') is-invalid @enderror" @auth value="{{user()->company_name}}" @else value="{{old('company_name')}}" @endauth>
 @error('company_name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

</div>
<div class="row">
<div class="col-md-8">
<div class="checkout-form-list">
<label> Name <span class="required">*</span></label>
<input type="text" placeholder="Full Name" name="name" class="@error('name') is-invalid @enderror" @auth value="{{user()->name}}" @else value="{{old('name')}}" @endauth>
 @error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>Mobile No <span class="required">*</span></label>
<input type="text" placeholder="Mobile No" name="mobile" class="@error('mobile') is-invalid @enderror" @auth value="{{user()->mobile}}" @else value="{{old('mobile')}}" @endauth>
 @error('mobile')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-12">
<div class="checkout-form-list">
<label>Email Address</label>
<input type="text" placeholder="Email Address" name="email" class="@error('email') is-invalid @enderror" @auth value="{{user()->email}}" @else value="{{old('email')}}" @endauth>
  @error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-8">
<div class="checkout-form-list">
<label>Street Address <span class="required">*</span></label>
<input type="text" placeholder="Street Address" name="address" class="@error('address') is-invalid @enderror" @auth value="{{user()->address}}" @else value="{{old('address')}}" @endauth>
@error('address')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Pincode <span class="required">*</span></label>
<input type="text" placeholder="Pincode" name="pincode" class="@error('pincode') is-invalid @enderror" @auth value="{{user()->pincode}}" @else value="{{old('pincode')}}" @endauth onKeyup="checkPincode(this.value);">
 @error('pincode')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Town / City <span class="required">*</span></label>
<input type="text" placeholder="Town/City" name="city" class="@error('city') is-invalid @enderror" @auth value="{{user()->city}}" @else value="{{old('city')}}" @endauth>
@error('city')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Country<span class="required">*</span></label>
<select name="country" id="country" onChange="getStates(this.value);" class="form-control @error('country') is-invalid @enderror">
 <option value="">Choose country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @auth @if(user()->country == $row->id) selected @endif @else @if($row->id == 101) selected @endif @endauth>{{$row->name}}</option>
 @endforeach
</select>
@error('country')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>State <span class="required">*</span></label>
<select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
 <option value="">Choose state</option>
 @auth
  @if(!empty(user()->country))
  @foreach(states(user()->country) as $row)
  <option value="{{$row->id}}" @if(user()->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @endif
 @else
 @foreach(states(101) as $row)
  <option value="{{$row->id}}" @if(101 == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @endauth
</select>
@error('state')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>



</div>

</div>
</div>

<!-- shipping details -->
<div class="">

<input type="checkbox" name="is_shipping" id="is_shipping" /> 
<label for="is_shipping">Is Shipping address is different from billing address</label>
    
<div class="checkbox-form mt-2 d-none" id="shipping-address">
<h3>Shipping Details</h3>
<div class="row">
<div class="col-md-8">
<div class="checkout-form-list">
<label> Name <span class="required">*</span></label>
<input type="text" placeholder="Full Name" name="shipping_name" class="@error('shipping_name') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->name}}" @else value="{{old('shipping_name')}}" @endif>
 @error('shipping_name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>Mobile No <span class="required">*</span></label>
<input type="text" placeholder="Mobile No" name="shipping_mobile" class="@error('shipping_mobile') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->mobile}}" @else value="{{old('shipping_mobile')}}" @endif>
 @error('shipping_mobile')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-12">
<div class="checkout-form-list">
<label>Email Address</label>
<input type="text" placeholder="Email Address" name="shipping_email" class="@error('shipping_email') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->email}}" @else value="{{old('shipping_email')}}" @endif>
  @error('shipping_email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-8">
<div class="checkout-form-list">
<label>Street Address <span class="required">*</span></label>
<input type="text" placeholder="Street Address" name="shipping_address" class="@error('shipping_address') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->address}}" @else value="{{old('shipping_address')}}" @endif>
@error('shipping_address')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label> Pincode <span class="required">*</span></label>
<input type="text" placeholder="Pincode" name="shipping_pincode" class="@error('shipping_pincode') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->pincode}}" @else value="{{old('shipping_pincode')}}" @endif onKeyup="checkPincode(this.value);">
 @error('shipping_pincode')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Town / City <span class="required">*</span></label>
<input type="text" placeholder="Town/City" name="shipping_city" class="@error('shipping_city') is-invalid @enderror" @if(!empty($shipping_address)) value="{{$shipping_address->city}}" @else value="{{old('shipping_city')}}" @endif>
@error('shipping_city')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="col-md-4">
<div class="checkout-form-list">
<label>Country<span class="required">*</span></label>
<select name="shipping_country" id="shipping_country" onChange="getStates(this.value, 'shipping_state');" class="form-control @error('shipping_country') is-invalid @enderror">
 <option value="">Choose country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @if(!empty($shipping_address)) @if($shipping_address->country == $row->id) selected @endif @else @if($row->id == 101) selected @endif @endif>{{$row->name}}</option>
 @endforeach
</select>
@error('country')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
<div class="col-md-4">
<div class="checkout-form-list">
<label>State <span class="required">*</span></label>
<select name="shipping_state" id="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror">
 <option value="">Choose state</option>
 @if(!empty($shipping_address))
  @foreach(states($shipping_address->country) as $row)
  <option value="{{$row->id}}" @if($shipping_address->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @else
 @foreach(states(101) as $row)
  <option value="{{$row->id}}" @if(101 == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @endif
</select>
@error('shipping_state')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>



</div>

</div>
</div>

</div>
<div class="col-lg-5 col-12">
    <!-- your order detail -->
    <div class="">
<div class="your-order mb-30 ">
<h3 class="hd">Your order</h3>
<div class="your-order-table table table-responsive">
<table>
<thead>
<tr>
<th class="product-name">Product</th>
<th class="product-total">Total</th>
</tr>
</thead>
<tbody>
@foreach($carts as $row)
<tr class="cart_item">
<td class="product-name"> {{$row->name}} <strong class="product-quantity"> × {{$row->quantity}}</strong></td>
<td class="product-total"> <span class="amount">{{currency()}}{{$row->price}}</span> </td>
</tr>
@endforeach
</tbody>
<tfoot>
<tr class="cart-subtotal">
<th>Subtotal</th>
<td><span class="amount">{{currency()}}{{cartTotal()}}</span></td>
</tr>
@auth
 @if($coupon = couponCondition())
<tr class="cart-subtotal">
<th>Discount</th>
<td><span class="amount">- {{currency()}} {{couponAmount($coupon->coupon_id)}}</span></td>
</tr>
 @endif
@endauth
<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">{{currency()}}{{checkoutTotal()}}</span></strong>
</td>
</tr>
</tfoot>
</table>
</div>

<div class="payment-method">
<h4 class="pb-10 border-b-light-gray3 hd" style="font-weight: 700;">Payment Method</h4>
<input type="hidden" name="type" value="PREPAID" />    
<input type="radio" name="sub_type" class="sub_type" id="gateway" value="GATEWAY" checked /> <label for="gateway">Gateway </label> &nbsp;&nbsp;
<input type="radio" name="sub_type" class="sub_type" id="upi" value="UPI" /> <label for="upi">UPI</label>
&nbsp;&nbsp;
<input type="radio" name="sub_type" class="sub_type" id="dbt" value="DIRECT_BANK_TRANSFER" /> <label for="dbt">Direct Bank Transfer</label>

<div id="sub-type"></div>
<br/>

<small class="text-muted">2% save available payment made on "UPI" & "Direct Bank Transfer" methods.</small>

<div id="pincode_response" class="text-danger mb-3"></div>

<div class="order-button-payment mt-5"> <!--BUTTON CREATING DYNAMICALLY--></div>

<div class="css d-flex justify-content-between align-items-center">
<p class="m-0" style="font-size: 12px;" color="rgba(0,19,37,0.92)" class="css-udedi eka6zu20">100% Original Products, Pay Securely, Easy Returns and Exchange</p>
<span class="css-d85ps1 ehes2bo0"><img src="assets/img/secure-payment.png" alt="Image" class="css-0 ek8d9s80" style="max-width: 40px;"></span>
</div>
</div>
</div>
</div>
</div>


</div>
</form>
</div>
</section>
<!-- checkout-area end -->

</main>

@endsection

@section('custom-script')
 <script>
  $(document).ready(function(){
   @auth
    @if(user()->is_shipping)       
     $('#is_shipping').click();
    @endif 
   @endauth 
   $('#gateway').click();
  }); 
 </script> 
@endsection