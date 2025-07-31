@extends('layouts.app')

@section('title','Addresses | User Panel')
@section('description','Addresses | User Panel')
@section('keywords','Addresses | User Panel')

@section('content')

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<h3 class=""><a href="{{route('userpanel.address.add')}}" class="btn update-btn btn-sm">Add new</a></h3>
@if($data->isNotEmpty())
<div class="row">
@foreach($data as $row)
 <div class="col-lg-6">
 <div class="add-box">
<div class="add-item">
<div class="add-title">
@if(user()->default_address == $row->id)
<h4> <input type="radio" name="address" value="{{$row->id}}" checked> Default</h4>
@else
<h4> <input type="radio" name="address" value="{{$row->id}}" onClick="setDefaultAddress(this.value);"> </h4>
@endif
</div>
<div class="add-main">
  <h3>{{$row->name}}</h3> <br>
  <p>{{$row->address}} {{$row->city}}, {{state($row->state)}} {{$row->pincode}}
  {{country($row->country)}}</p>
  <p><span>Phone Number:</span> <span>{{$row->mobile}}</span></p>
  <p><span>Email Address:</span> <span>{{$row->email}}</span></p>
</div>
<div class="add-button">
  <a href="{{route('userpanel.address.edit',$row->id)}}" class="edit-btn">Edit</a> | 
  <a href="{{route('userpanel.address.remove',$row->id)}}" class="edit-btn" onClick="return confirm('Are you sure?');">Remove</a>
</div>
</div>
</div>
 </div>
@endforeach  
</div>
@else
 <h4 class="text-center" style="font-size: 12px;">
     <img class="no-add-img" style="max-width: 350px;margin: auto;display: block;" src="assets/img/no-add.png" alt="No Address Available">
     No Address Available.</h4>
@endif

</div>
</div>
</div>
</div>
</section>

@endsection