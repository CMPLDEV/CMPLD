@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-3" style="background-image:url('assets/img/cart-banner.jpg');">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-center"> 
<h3>Cart</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center">
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">Cart</li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<section class="cart-wrap">
<style>
.breadcrumb-area-3{
padding:80px 0;
}

.breadcrumb-wrapper-2 h3 {
color: #ffffff;
font-size: 40px;
letter-spacing: 1px;
}

.breadcrumb-wrapper-2 .breadcrumb-item.active{
color:#ffffff;
}

.cart-area{padding:50px 0;}
.cart-product{
position: relative;
background-color: #fff;
padding: 20px;margin-bottom:20px;
display: flex;
border-radius: 10px;
box-shadow: 0px 0px 5px 0px lightgrey;}  
.cart-img {
width: 25%;
height: 110px;
display: flex;
overflow: hidden;
margin-right: 10px;
}
.cart-img img{overflow: hidden;
max-height: 110px;margin: auto;
max-width: 100px;}
.cart-detail {width: 75%;margin-left: 6px;}
.cart-prd-name{color: black;
margin-right: 10px;
font-size: 12px;
overflow: hidden;
display: block;
height: 40px;
line-height: 18px;}
.cart-price{font-size: 12px;}
.ttl{font-weight: 700;
color: #00a0e3;
margin: auto;
font-size: 18px;}
.action{position: absolute;
right: 0px;
top: 0;
/*background-color: red;*/
width: 35px;
height: 30px;
border-radius: 0 10px 0 0;
text-align: center;
display: flex;}
.action a{margin: auto;} 
.cart-amount{background-color:#fff;padding:20px;}
.hd{font-weight: 700;
text-transform: uppercase;
padding: 12px;
font-size: 16px;
border-radius: 0;
margin-bottom: 20px;
background-color: #e2e2e2;
color: #00a0e3;}
.cart-txt{font-style: italic;
font-size: 13px;
padding: 0 15px;}
.cart-input{display:flex;margin-bottom:30px;}
.btcart{height: 100%;
background-color: #00a0e3;
color: #fff;
border-radius: 0;
font-size: 14px;
text-transform: uppercase;
white-space: nowrap;
}
.card{border: none !important;}
.btcart i{font-size:20px;}
.btcart:hover{color:#fff;}
.cart-list{padding-left: 0;
list-style: none;}
.cart-list li{
padding-bottom: 1rem;
padding-top: 1rem;
justify-content: space-between;
display: flex;
border-bottom: 1px solid #dee2e6;    }
.proceed {
background: linear-gradient(2deg, #04648d, #00a0e3);
margin: 20px 0;
width: 100%;
padding: 12px;
color: #fff;
text-transform: uppercase;
border: 0;
}
.proceed:hover{color:#fff;}
</style> 

@if($carts->isNotEmpty()) 
<div class="cart-area" style="background-color: #f8f8f8;">
<div class="container">
<div class="row">
<div class="col-lg-8">
<div class="row">
<!-- start product card -->
@foreach($carts as $row)
<div class="col-lg-6">
<div class="cart-product">
<div class="cart-img">
<img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->name}}" title="{{$row->name}}">   
</div>
<div class="cart-detail">
<a href="{{productURL($row->slug)}}" class="cart-prd-name">
{{$row->name}} </a>
<div class="cart-price">{{currency()}} {{$row->price}}/- </div>
<div class=" product-quantity">
<!--<div class="tg-quantityholder cart-quantity" style="padding: 5px;-->
<!--    width: 162px;">-->
<!--<em class="minus cart-minus" onClick="decrementQty('{{$row->id}}',this.value);">-</em>-->
<!--<input type="text" class="result cart-result" id="quantity{{$row->id}}" name="quantity" value="{{$row->quantity}}" min="1" readonly>-->
<!--<em class="plus cart-plus" onClick="incrementQty('{{$row->id}}',this.value);">+</em>-->
<!--</div>-->
<div class="cart-plus-minus position-relative my-2">
<div class="dec qtybutton" onClick="decrementQty('{{$row->id}}',this.value);">-</div>    
<input class="cart-plus-minus-box" type="text" name="qtybutton" value="{{$row->quantity}}" id="qty{{$row->id}}" readonly="">
<div class="inc qtybutton" onClick="incrementQty('{{$row->id}}',this.value);">+</div>
</div>
<span class="ttl">{{currency()}} {{$row->price*$row->quantity}}/-</span>
</div>
</div>
<div class="action">
<a href="{{route('cart.remove',$row->id)}}" class="cart-remove"><img src="assets/img/svgviewer-output.svg" alt=""></a>
</div>
</div>
</div>
@endforeach 
<!-- end product card -->
<!-- start apply coupon code -->
<div class="col-lg-8">
<div class="hd">Coupon code</div>    
<p class="cart-txt">If you have a coupon code, please enter it in the box below</p>
@auth    
@if($coupon = couponCondition())
@php $coupon_code = \App\Models\Coupon::find($coupon->coupon_id); @endphp

<div class="input-group">
<input type="text" disabled value="{{$coupon_code->code}}" class="form-control">
<div class="input-group-btn">
<a class="btn" onClick="return confirm('Are you sure?');" href="{{route('coupon.remove',$coupon->id)}}"> <i class="fa fa-times-circle"></i> </a>
</div>
</div>
<br>
@else
<form method="POST" action="{{route('coupon.apply')}}">
<div class="cart-input">
@csrf  
<input type="text" placeholder="Coupon Code" name="code" class="form-control border-0 @error('code') is-invalid @enderror">
<div class="input-group-append border-0">
<button type="submit" class="btn btcart"><i class="fa fa-gift mr-2"></i> &nbsp; Apply coupon</button>
</div>
</div>
@error('code')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</form>
@endif 

@else

<form method="POST" action="{{route('coupon.apply')}}">
<div class="cart-input">
@csrf  
<input type="text" placeholder="At first please login." name="code" class="form-control border-0 @error('code') is-invalid @enderror" disabled>
<div class="input-group-append border-0">
<button type="submit" class="btn btcart" disabled><i class="fa fa-gift mr-2"></i> &nbsp; Apply coupon</button>
</div>
</div>
@error('code')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</form>

@endauth 
</div>
<!-- end apply coupon code -->
</div>
</div>
<div class="col-lg-4">
<div class="cart-amount">


<div class="hd">Order summary </div>
<p class="cart-txt">Shipping and additional costs are calculated based on values you have entered.</p>
<ul class="cart-list">
<li><strong class="text-muted">Order Subtotal </strong><strong> {{currency()}} {{cartTotal()}}</strong></li>
@auth
@if($coupon = couponCondition())
<li><strong class="text-muted">Discount (%)</strong><strong> {{currency()}} {{couponAmount($coupon->coupon_id)}}</strong>
</li>
@endif
@endauth
<li><strong class="text-muted">Total</strong>
<h5 class="font-weight-bold">{{currency()}} {{checkoutTotal()}}</h5>
</li>
</ul>  

<a @auth href="{{route('checkout')}}" @else href="{{route('login')}}" @endauth class="btn bt-cart proceed">Proceed to checkout</a>
</div>    


</div>
</div>
<!-- start coupon code -->
<div class="mt-3">
@if(coupons()->isNotEmpty())
<div class="row">
@foreach(coupons() as $row)
<div class="col-lg-4">
<div class="coupon">
<div class="first">
<span> {{$row->code}} </span>    
</div> 
<div class="second">
<div class="card">
<div class="card-header">Valid For Both Prepaid/COD ORDER</div>
<div class="card-body">
<span>SAVE {{$row->amount}}%</span> {{$row->content}}</div>
</div>  
</div>    

</div> 
</div>
@endforeach       
</div>
@endif
</div>
<!-- start coupon code -->
</div>
</div>
@else
<div class="cart-area">
<div class="container">
<div class="row justify-content-center">
<div class="col-lg-8">
<div class="text-center">
<img src="assets/img/empty-cart-illustration.gif" alt="Empty Cart" style="max-width: 390px;width: 100%;">
<p>Your Shopping Bag is Empty!!</p>
<p>Please add something soon, carts have feelings too.</p>
<a href="" class="update-btn">Coutinue Shopping</a>
</div>
</div>
</div>  
</div>
</div>
@endif 
</section> 

</main>


@endsection