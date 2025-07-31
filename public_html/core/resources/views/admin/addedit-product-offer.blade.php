@extends('admin.layouts.app')
@section('title','Add/Edit Product Offer')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Product Offer</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Product Offer</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Product Offer
<a href="{{route('product.offer',$product->id)}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('product.offer.update')}}" @else action="{{route('product.offer.create')}}" @endisset>
 @csrf
 <input type="hidden" name="product_id" value="{{$product->id}}" />
 @isset($edit) <input type="hidden" name="id" value="{{$edit->id}}" />
 @method('PUT')
 @endisset

<div class="row">
 
 <div class="col-sm-6">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="Enter Name" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
 <label for="floatingInput">Title</label>
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('link') is-invalid @enderror" id="floatingInput" name="link" placeholder="Enter Name" @isset($edit) value="{{$edit->link}}" @else value="{{old('link')}}" @endisset>
 <label for="floatingInput">Link</label>
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

</div>


<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control @error('content') is-invalid @enderror" id="floatingInput" rows="4" name="content" placeholder="Enter Content">@isset($edit){{$edit->content}}@endisset</textarea>
 <label for="">Description</label>
  @error('content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
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
