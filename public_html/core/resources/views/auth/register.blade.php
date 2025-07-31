@extends('layouts.app')

@section('title', setting()->comp_name.' | Register')

@section('custom-css')
 <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection

@section('content')

<main>
 

<!-- login area start -->
<section class="login-area pt-100 pb-100">
<div class="container">
<div class="row">
<div class="col-lg-8 offset-lg-2">
<div class="basic-login">
<h3 class="text-center mb-60">Signup From Here</h3>
<form method="POST" action="{{route('register')}}">
@csrf 
<label for="name">Username <span>*</span></label>
<input type="text" placeholder="Your Name" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
@error('name')
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
<label for="name">Mobile no <span>*</span></label>
<input type="text" placeholder="Mobile No" class="@error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}">
@error('mobile')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="email-id">Email Address <span>*</span></label>
<input type="text" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
<label for="pass">Password <span>*</span></label>
<input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror">
@error('password')
<span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
</span>
@enderror

<label for="pass">Confirm Password <span>*</span></label>
<input type="password" name="password_confirmation" placeholder="Confirm Your Password">

<div class="mb-3">
<div class="g-recaptcha" data-sitekey="{{setting()->g_recaptcha_site_key}}"></div>
@if ($errors->has('g-recaptcha-response'))
 <span class="invalid-feedback d-block fw-bold" role="alert">{{ $errors->first('g-recaptcha-response') }}</span>
@endif
</div>

<div class="mt-10"></div>
<button class="s-btn s-btn-4 w-100">Register Now</button>
<div class="or-divide"><span>or</span></div>
<a href="{{route('login')}}" class="s-btn s-btn-2 w-100">login Now</a>
</form>
</div>
</div>
</div>
</div>
</section>
<!-- login area end -->
</main>


@endsection
