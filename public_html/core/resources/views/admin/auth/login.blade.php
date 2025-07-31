@include('admin.layouts.header')

<div class="authentication-bg min-vh-100">
<div class="bg-overlay bg-white"></div>
<div class="container">
<div class="d-flex flex-column min-vh-100 px-3 pt-4">
<div class="row justify-content-center my-auto">
<div class="col-lg-10">
<div class="py-5">
<div class="card auth-cover-card overflow-hidden">
<div class="row g-0">
<div class="col-lg-6">
<div class="auth-img">
</div>                                            
</div> 
<div class="col-lg-6">
<div class="p-4 p-lg-5 bg-purple h-100 d-flex align-items-center justify-content-center">
<div class="w-100">
<div class="text-white-50 mb-4">
<h5 class="text-white">Welcome Back !</h5>
<p>Sign in to continue.</p>
</div>
<form action="{{ route('admin.login') }}" method="POST">
@csrf    
<div class="form-floating form-floating-custom mb-3">
<input type="text" class="form-control @error('email') is-invalid @enderror" id="input-username" placeholder="Enter email address" name="email" value="{{ old('email') }}">
<label for="input-username">Email Address</label>
<div class="form-floating-icon">
<i class="uil uil-users-alt"></i>
</div>
@error('email')
<span class="invalid-feedback" role="alert">
 <strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="form-floating form-floating-custom mb-3">
<input type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" name="password" placeholder="Enter Password">
<label for="input-password">Password</label>
<div class="form-floating-icon">
<i class="uil uil-padlock"></i>
</div>
@error('password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="form-check form-check-light text-white-50 font-size-16">
<input class="form-check-input bg-soft-light" type="checkbox" name="remember" value="true" id="remember">
<label class="form-check-label font-size-14" for="remember-check">
Remember me
</label>
</div>

<div class="mt-3">
 <button class="btn btn-light w-100" type="submit">Log In</button>
 <p class="small mb-0"> <a href="{{route('password.request')}}" style="font-size: 11px;
        color: grey;"> I forgot my password</a></p>
</div>

</form><!-- end form -->
</div>
</div>
</div><!-- end col -->
</div><!-- end row -->
</div><!-- end card -->
</div>
</div><!-- end col -->
</div><!-- end row -->
</div>
</div>
<!-- end container -->
</div>

@include('admin.layouts.footer')