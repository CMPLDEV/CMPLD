@extends('admin.layouts.app')
@section('title','Add/Edit Software')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Software</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Software</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Software
<a href="{{route('brand.software',$brand->id)}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" @isset($edit) action="{{route('brand.software.update')}}" @else action="{{route('brand.software.create')}}" @endisset>
 @csrf
 <input type="hidden" name="brand_id" value="{{$brand->id}}" />
 @isset($edit) 
  @method('PUT') <input type="hidden" name="id" value="{{$edit->id}}" /> @endisset
<div class="row">

 <div class="col-sm-5">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="Enter Title" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
 <label for="floatingInput">Title</label>
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
  <div class="col-sm-5">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('link') is-invalid @enderror" id="floatingInput" name="link" placeholder="Enter Download Link" @isset($edit) value="{{$edit->link}}" @else value="{{old('link')}}" @endisset>
 <label for="floatingInput">Download Link</label>
  @error('link')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-2">
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
