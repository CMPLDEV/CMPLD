@extends('layouts.app')

@section('title', setting()->comp_name.' | Forget Password')

@section('content')

<main>

<!-- account-wrap-start --> 
<section class="account-wrap pt-50 pb-50">
<div class="login-register-area mb-60">
<div class="container">
<div class="row">
<div class="col-xl-6 col-lg-6 offset-xl-3 offset-lg-3 col-md-12  col-sm-12 col-12 d-flex justify-content-center justify-content-md-end">
<div class="login-area mb-60">
<h4>Forgot your password?</h4>
<div class="login-form mt-40 pl-55 pr-55 pt-60 pb-60">
@if (session('status'))
<div class="alert alert-success" role="alert">
{{ session('status') }}
</div>
@endif    
<form method="POST" action="{{ route('password.email') }}">
@csrf  
<div class="log-email">
<label class="d-block pb-2">Email address<span class="text-danger">*</span></label>
<input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<button type="submit" class="btn text-white bg-dark transition-3 form-control mt-20">Send Request</button>
<div class="f-get-pass text-right">
<a href="{{route('login')}}" class="black-color d-inline-block mt-10">Login</a>
</div>
</form>
</div>
</div>
</div><!-- /col -->

</div><!-- /row -->
</div><!-- /container -->
</div>
</section>
<!-- account-wrap-end -->

</main>

@endsection