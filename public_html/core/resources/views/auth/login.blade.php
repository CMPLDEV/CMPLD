@extends('layouts.app')

@section('title', setting()->comp_name.' | Login')

@section('content')

<main>

<!-- login area start -->
<section class="login-area pt-100 pb-100">
<div class="container">
<div class="row">
<div class="col-lg-8 offset-lg-2">
<div class="basic-login">
<h3 class="text-center mb-60">Login From Here</h3>
<form method="POST" action="{{route('login')}}">
@csrf 
<label for="name">Email Address <span>**</span></label>
<input id="name" type="text" placeholder="Email address..." name="email" class="@error('email') is-invalid @enderror" />
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

<label for="pass">Password <span>**</span></label>
<input id="pass" type="password" placeholder="Enter password..." name="password" class="@error('password') is-invalid @enderror" />
@error('password')
<span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
</span>
@enderror

<div class="login-action mb-20 fix">
<span class="log-rem f-left">
<input id="remember" name="remember" type="checkbox" />
<label for="remember">Remember me!</label>
</span>
<span class="forgot-login f-right">
<a href="{{route('password.request')}}">Lost your password?</a>
</span>
</div>

<div class="row">
 <div class="col-lg-8">
  <button class="s-btn s-btn-4 w-100">Login Now</button>   
 </div>
 <div class="col-lg-4">
  <a href="{{route('social.redirect', 'google')}}" class="login-with-google-btn">Sign in with Google</a>     
 </div>
</div>

<div class="or-divide"><span>or</span></div>
<a href="{{route('register')}}" class="s-btn s-btn-2 w-100">Register Now</a>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- login area end -->


</main>

@endsection