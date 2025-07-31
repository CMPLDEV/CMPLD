@extends('layouts.app')

@section('title','Profile | User Panel')
@section('description','Profile | User Panel')
@section('keywords','Profile | User Panel')

@section('content')

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<h3 class="">Basic Info</h3>
<div class="account-dt-box">
<div class="p-4">
<span class="wrapper">
<form method="POST" action="{{route('userpanel.profile.update')}}">
@csrf    
<div class="row form-group mt-3">

<div class="col-12 col-lg-4 pb-3">
<label>Full Name</label> 
<input type="text" name="name" id="name" placeholder="Enter full name" class="profile-control form-control @error('name') is-invalid @enderror" value="{{user()->name}}">
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


<div class="col-12 col-lg-5 pb-3">
<label>Email</label>
<input type="text" name="email" id="email" placeholder="Enter your email" class="profile-control form-control @error('email') is-invalid @enderror" value="{{user()->email}}">
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-2 pb-3">
<label>Mobile</label>
<input type="text" name="mobile" id="mobile" placeholder="Enter your mobile" class="profile-control form-control @error('mobile') is-invalid @enderror " value="{{user()->mobile}}">
@error('mobile')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-8 pb-3">
<label>Address</label>
<input type="text" name="address" id="address" placeholder="Enter your address" class="profile-control form-control @error('address') is-invalid @enderror " value="{{user()->address}}">
@error('address')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>City</label>
<input type="text" name="city" id="city" placeholder="Enter your city" class="profile-control form-control @error('city') is-invalid @enderror" value="{{user()->city}}">
@error('city')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-3 pb-3">
<label>Pincode</label>
<input type="text" name="pincode" id="pincode" placeholder="Enter your pincode" class="profile-control form-control @error('pincode') is-invalid @enderror" value="{{user()->pincode}}">
@error('pincode')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>Choose Country</label>
<select class="profile-control form-control @error('country') is-invalid @enderror" name="country" id="country" onChange="getStates(this.value);">
 <option value="">Choose Country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @if($row->id == user()->country) selected @endif>{{$row->name}}</option>
 @endforeach
</select>
@error('country')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>State</label>
<select class="profile-control form-control @error('state') is-invalid @enderror" name="state" id="state" >
 <option value="">Choose state</option>
 @if(!empty(user()->country))
 @foreach(states(user()->country) as $row)
  <option value="{{$row->id}}" @if(user()->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @endif
</select>
 @error('state')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

</div>

<div class="row form-group mt-3">
    
<div class="col-12 col-lg-3 pb-3">
<label>GST No</label>
<input type="text" name="gst_no" id="gst_no" placeholder="Enter GST no" class="profile-control form-control @error('gst_no') is-invalid @enderror" value="{{user()->gst_no}}">
@error('gst_no')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>    

<div class="col-12 col-lg-3 pb-3">
<label>Aadhar No</label> 
<input type="text" name="aadhar_no" id="aadhar_no" placeholder="Enter Aadhar No" class="profile-control form-control @error('aadhar_no') is-invalid @enderror" value="{{user()->aadhar_no}}">
@error('aadhar_no')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


<div class="col-12 col-lg-3 pb-3">
<label>PAN No</label>
<input type="text" name="pan_no" id="pan_no" placeholder="Enter PAN No" class="profile-control form-control @error('pan_no') is-invalid @enderror" value="{{user()->pan_no}}">
@error('pan_no')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

</div>
</div>

<div class="row">
 <div class="col-lg-12">
  <small class="text-muted"><i><b>Note:</b> Aadhar & PAN no is not mandatory.</i></small>     
 </div>    
</div>

<div class="row form-group mt-3">
<div class="col-12 col-lg-12">
<button type="submit" class="btn update-btn"> Update Info</button>
</div>
</div>     
</form> 
</span>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection