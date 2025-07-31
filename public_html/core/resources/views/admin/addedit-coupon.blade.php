@extends('admin.layouts.app')
@section('title','Add/Edit Coupon')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Coupon</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Coupon</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end Blog title -->


<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Coupon
<a href="{{route('admin.coupon')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('coupon.update',$edit->id)}}" @else action="{{route('coupon.create')}}" @endisset>
 @csrf

<div class="row">

 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('code') is-invalid @enderror" id="floatingInput" name="code" placeholder="Coupon Code" @isset($edit) value="{{$edit->code}}" @else value="{{old('code')}}" @endisset>
 <label for="floatingInput">Coupon Code</label>
  @error('code')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div> 

  <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('amount') is-invalid @enderror" id="floatingInput" name="amount" placeholder="Coupon Amount (%)" @isset($edit) value="{{$edit->amount}}" @else value="{{old('amount')}}" @endisset>
 <label for="floatingInput">Coupon Amount</label>
  @error('amount')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div> 
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('condition') is-invalid @enderror" id="floatingInput" name="condition" placeholder="Coupon Condition" @isset($edit) value="{{$edit->condition}}" @else value="{{old('condition')}}" @endisset>
 <label for="floatingInput">Coupon Condition</label>
  @error('condition')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="date" class="form-control @error('expiry') is-invalid @enderror" id="floatingInput" name="expiry" placeholder="Coupon Expiry" @isset($edit) value="{{$edit->expiry}}" @else value="{{old('expiry')}}" @endisset>
 <label for="floatingInput">Coupon Expiry</label>
  @error('expiry')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <select class="form-control @error('type') is-invalid @enderror" name="type">
  <option value="PERCENT_OFF" @isset($edit) @if($edit->type == 'PERCENT_OFF') selected @endif @endisset>PERCENT_OFF</option>
  <option value="FIXED" @isset($edit) @if($edit->type == 'FIXED') selected @endif @endisset>FIXED</option>
 </select>
 <label for="floatingInput">Choose Type</label>
  @error('type')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>

<div class="col-sm-10 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content">@isset($edit){{$edit->content}}@endisset</textarea>
 <label for="floatingInput">Coupon Description</label>
  @error('content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

 <div class="col-sm-2 mt-3">
 <div class="form-floating mb-3">
 <select class="form-control @error('status') is-invalid @enderror" name="status">
  <option value="1" @isset($edit) @if($edit->status == 1) selected @endif @endisset>ACTIVE</option>
  <option value="0" @isset($edit) @if($edit->status == 0) selected @endif @endisset>INACTIVE</option>
 </select>
 <label for="floatingInput">Choose Status</label>
  @error('status')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</div>

</form>
</div>
</div>

</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
