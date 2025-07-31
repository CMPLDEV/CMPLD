<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{setting()->comp_name}} | Payment</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
 .razorpay-payment-button{display: none !important;}  
 .proceed{background: linear-gradient(2deg, #2c6800, #69d619);
    margin-top: 30vh;
    width: 250px;
    padding: 12px;
    color: #fff;
    text-transform: uppercase;
    border: 0;}
 .proceed:hover{color: #fff;}
</style>

</head>
<body>
<div id="app">
<main class="py-4">
<div class="container">
<div class="row">
<div class="col-md-6 offset-3 col-md-offset-6">
<div style="display:flex;justify-content:center">    
<a class="btn bt-cart proceed" href="{{url('/')}}">Back to home</a>
</div>
    <form action="{{route('checkout.razorpay.proceed')}}" method="POST" id="payment-form">
    @csrf
    <script src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('app.razorpay')['key_id'] }}"
            data-amount="{{$amount}}"
            data-name="{{setting()->comp_name}}"
            data-description="Items Purchased"
            data-image="{{asset('uploaded_files/logo/'.setting()->logo)}}"
            data-order_id="{{$razorpay_order_id}}"
            data-prefill.name="{{$order->name}}"
            data-prefill.email="{{$order->email}}"
            data-prefill.contact="{{$order->mobile}}"
            data-theme.color="#ff7529">
    </script>
    </form>

</div>
</div>
</div>
</main>
</div>

<script>
 $(document).ready(function(){
   $('#payment-form').submit(); 
 });
</script>

</body>
</html>