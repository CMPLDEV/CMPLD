@extends('admin.layouts.app')
@section('title','Change Password')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Change Password</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Change Password</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">

<form method="post" action="{{route('change.my.password')}}">
 @csrf
<div class="row mb-3">

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="floatingInput" name="old_password" placeholder="Enter Old Password" @if(!empty($data->old_password)) value="{{$data->old_password}}" @else value="{{old('old_password')}}" @endif >
 <label for="floatingInput">Old Password</label>
  @error('old_password')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="floatingInput" name="new_password" placeholder="Enter New Password" @if(!empty($data->new_password)) value="{{$data->new_password}}" @else value="{{old('new_password')}}" @endif >
 <label for="floatingInput">New Password</label>
  @error('new_password')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="floatingInput" name="confirm_password" placeholder="Enter Confirm Password" @if(!empty($data->confirm_password)) value="{{$data->confirm_password}}" @else value="{{old('confirm_password')}}" @endif >
 <label for="floatingInput">Confirm Password</label>
  @error('confirm_password')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
  <button type="submit" class="btn btn-primary">Change</button>  
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
