@extends('layouts.app')

@section('title','Add/Edit Address | User Panel')
@section('description','Add/Edit Address | User Panel')
@section('keywords','Add/Edit Address | User Panel')

@section('content')

<section class="user-wrap">
<div class="container">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<h3 class=""><a href="{{route('userpanel.address')}}" class="btn update-btn">Back</a></h3>
<div class="account-dt-box">
<div class="p-4">
<span class="wrapper">
<form method="POST" @isset($edit) action="{{route('userpanel.address.update')}}" @else action="{{route('userpanel.address.create')}}" @endif>
@csrf    
<input type="hidden" name="id" @isset($edit) value="{{$edit->id}}" @endisset>
<div class="row form-group mt-3">

<div class="col-12 col-lg-4 pb-3">
<label>Full Name</label> 
<input type="text" name="name" id="name" placeholder="Enter full name" class="profile-control form-control @error('name') is-invalid @enderror" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
@error('name')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>


<div class="col-12 col-lg-4 pb-3">
<label>Email</label>
<input type="text" name="email" id="email" placeholder="Enter your email" class="profile-control form-control @error('email') is-invalid @enderror" @isset($edit) value="{{$edit->email}}" @else value="{{old('email')}}" @endisset>
@error('email')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>Mobile</label>
<input type="text" name="mobile" id="mobile" placeholder="Enter your mobile" class="profile-control form-control @error('mobile') is-invalid @enderror " @isset($edit) value="{{$edit->mobile}}" @else value="{{old('mobile')}}" @endisset>
@error('mobile')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

</div>

<div class="row form-group mt-3">

<div class="col-12 col-lg-8 pb-3">
<label>Street Address</label>
<input type="text" name="address" id="address" placeholder="Enter your address" class="profile-control form-control @error('address') is-invalid @enderror " @isset($edit) value="{{$edit->address}}" @else value="{{old('address')}}" @endisset>
@error('address')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>City</label>
<input type="text" name="city" id="city" placeholder="Enter your city" class="profile-control form-control @error('city') is-invalid @enderror " @isset($edit) value="{{$edit->city}}" @else value="{{old('city')}}" @endisset>
@error('city')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

</div>

<div class="row form-group mt-3">

<div class="col-12 col-lg-3 pb-3">
<label>Pincode</label>
<input type="text" name="pincode" id="pincode" placeholder="Enter your pincode" class="profile-control form-control @error('pincode') is-invalid @enderror " @isset($edit) value="{{$edit->pincode}}" @else value="{{old('pincode')}}" @endisset>
@error('pincode')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

<div class="col-12 col-lg-4 pb-3">
<label>Choose Country</label>
<select class="profile-control form-control" name="country" id="country" onChange="getStates(this.value);" class="@error('country') is-invalid @enderror">
 <option value="">Choose Country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @isset($edit) @if($row->id == $edit->country) selected @endif @endisset>{{$row->name}}</option>
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
<select class="profile-control form-control" name="state" id="state" >
 <option value="">Choose state</option>
@isset($edit)
 @if(!empty($edit->country))
 @foreach(states($edit->country) as $row)
  <option value="{{$row->id}}" @if($edit->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
 @endif
@endisset
</select>
 @error('state')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

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