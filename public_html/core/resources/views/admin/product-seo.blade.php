@extends('admin.layouts.app')
@section('title','Product SEO')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product SEO</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product SEO</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
<div class="col-lg-12">

@if(count($errors)>0)
<div class="alert alert-danger alert-dismissible fade show mb-3 w-50 m-auto">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<strong>Errors Occured!</strong>
<ul style="margin-left:25px;">
  @foreach($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
</ul>
</div>
@endif

<div class="card">
<div class="card-body">

<form method="post" enctype="multipart/form-data" action="{{route('productseo.update')}}">
 @csrf

<input type="hidden" name="id" @if(!empty($data)) value="{{$data->id}}" @else value="0" @endif> 

<div class="row mb-3">

<div class="col-sm-12 mt-3">
<label for="">Content</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content" >@if(!empty($data)){{$data->content}}@endif</textarea>
  @error('content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>
<script>CKEDITOR.replace('content');</script>

<div class="col-sm-12 mt-3">
<div class="alert alert-secondary rounded-0">
  <strong>SEO Related Section</strong>
</div>   
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_title" placeholder="Enter Meta Title">@if(!empty($data)){{$data->meta_title}}@endif</textarea>
 <label for="floatingInput">Meta Title</label>
  @error('meta_title')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_description" placeholder="Enter Meta Description" >@if(!empty($data)){{$data->meta_description}}@endif</textarea>
 <label for="floatingInput">Meta Description</label>
  @error('meta_description')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_keywords" placeholder="Enter Meta Keywords">@if(!empty($data)){{$data->meta_keywords}}@endif</textarea>
 <label for="floatingInput">Meta Keywords</label>
  @error('meta_keywords')
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
</div>


</form><!-- End General Form Elements -->

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
