@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Advance Settings</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Advance Settings</li>
</ol>
</div>

</div>
</div>
</div>
<style>
textarea{min-height:200px !important;}
</style>

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">

<form method="post" enctype="multipart/form-data" action="{{route('advancesetting.update')}}">
 @csrf

<div class="row mb-3">

<div class="col-sm-6">
 <div class="card">
  <div class="card-header"> <strong> Site SEO </strong> </div>
  <div class="card-body">
      
    <input type="checkbox" name="meta_robots" id="meta_robots" @if($data->meta_robots) checked @endif >
    <label for="meta_robots">Meta Robots</label>
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control @error('site_verification') is-invalid @enderror" id="floatingInput" name="site_verification" placeholder="Enter Site Verification Code">@if(!empty($data->site_verification)){{$data->site_verification}}@else{{old('site_verification')}}@endif</textarea>
    <label for="floatingInput">Site Verification Code</label>
    @error('site_verification')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control @error('analytics') is-invalid @enderror" id="floatingInput" name="analytics" placeholder="Enter Analytics Code" >@if(!empty($data->analytics)){{$data->analytics}}@else{{old('analytics')}}@endif</textarea>
    <label for="floatingInput">Analytics Code</label>
    @error('analytics')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
    <div class="form-floating mb-3">
    <textarea type="text" class="form-control @error('site_schema') is-invalid @enderror" id="floatingInput" name="site_schema" placeholder="Enter Schema Code" >@if(!empty($data->site_schema)){{$data->site_schema}}@else{{old('site_schema')}}@endif</textarea>
    <label for="floatingInput">Schema Code</label>
    @error('site_schema')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
     <div class="form-floating mb-3">
    <textarea type="text" class="form-control @error('robotstxt') is-invalid @enderror" id="floatingInput" name="robotstxt" placeholder="Enter Robots.txt" >@if(file_exists(("robots.txt"))){{file_get_contents("robots.txt")}}@endif</textarea>
    <label for="floatingInput">Robots.txt</label>
    @error('robotstxt')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
  </div>
 </div>
</div>

<div class="col-sm-6">
 <div class="card">
  <div class="card-header"> <strong> Google re-Captcha </strong> </div>
  <div class="card-body">
      
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('g_recaptcha_site_key') is-invalid @enderror" id="floatingInput" name="g_recaptcha_site_key" placeholder="Enter Site Key" @if(!empty($data->g_recaptcha_site_key)) value="{{$data->g_recaptcha_site_key}}" @else value="{{old('g_recaptcha_site_key')}}" @endif >
    <label for="floatingInput">Site Key</label>
    @error('g_recaptcha_site_key')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('g_recaptcha_secret_key') is-invalid @enderror" id="floatingInput" name="g_recaptcha_secret_key" placeholder="Enter Secret Key" @if(!empty($data->g_recaptcha_secret_key)) value="{{$data->g_recaptcha_secret_key}}" @else value="{{old('g_recaptcha_secret_key')}}" @endif >
    <label for="floatingInput">Secret Key</label>
    @error('g_recaptcha_secret_key')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    
  </div>
 </div>
</div>

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</div>
</div>


</form><!-- End General Form Elements -->

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
