@extends('layouts.app')

@section('title','Change Password | User Panel')
@section('description','Change Password | User Panel')
@section('keywords','Change Password | User Panel')

@section('content')

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<h3 class="">Change Password</h3>
<div class="p-4">

<form method="POST" action="{{route('userpanel.changepassword.update')}}">
 @csrf  
 
@if(!empty(user()->password))  
 <div class="row form-group mt-3">
<div class="col-12 col-lg-6">
<label>Old Password</label> 
<input type="password" name="old_password" id="old_password" placeholder="Enter old password" class="form-control @error('old_password') is-invalid @enderror" >
@error('old_password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
@endif

<div class="row form-group mt-3">
<div class="col-12 col-lg-6">
<label>New Password</label>
<input type="password" name="new_password" id="new_password" placeholder="Enter new password" class="form-control @error('new_password') is-invalid @enderror" >
@error('new_password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror

</div>
</div>

<div class="row form-group mt-3">
<div class="col-12 col-lg-6">
<label>Confirm Password</label>
<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" class="form-control @error('confirm_password') is-invalid @enderror" >
@error('confirm_password')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="row form-group mt-3">
<div class="col-12 col-lg-12">
<button type="submit" class="btn update-btn"> Update Password</button>
</div>
</div>     

</form> 
</div>
</div>
</div>
</div>
</div>
</section>

@endsection