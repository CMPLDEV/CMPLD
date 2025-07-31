@extends('admin.layouts.app')
@section('title','Add/Edit Gallery')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Gallery</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Gallery</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Gallery
<a href="{{route('admin.gallery')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('gallery.update')}}" @else action="{{route('gallery.create')}}" @endisset>
 @csrf
 @isset($edit) 
  @method('PUT')  
  <input type="hidden" name="id" value="{{$edit->id}}"> 
 @endisset

<div class="row mb-3">

<div class="col-lg-3">
 @if(isset($edit) && !empty($edit->image))
  <img src="{{asset(showImage($edit->image,'uploaded_files/gallery'))}}" alt="image" width="100%">
 @else 
  <img src="{{asset(noImage())}}" alt="image" width="100%">   
 @endif 
 <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"> 
 @error('image')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror  
</div>

<div class="col-lg-9">
<div class="row">

<div class="col-sm-7">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="Title" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
 <label for="floatingInput">Title</label>
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div> 
 
 <div class="col-sm-3">
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

</div>

</div>

<div class="row">

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
