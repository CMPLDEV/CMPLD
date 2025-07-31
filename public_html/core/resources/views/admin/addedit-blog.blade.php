@extends('admin.layouts.app')
@section('title','Add/Edit Blog')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Blog</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Blog</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Blog
<a href="{{route('admin.blog')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('blog.update',$edit->id)}}" @else action="{{route('blog.create')}}" @endisset>
 @csrf

<div class="row mb-3">

<div class="col-lg-3">
 @if(isset($edit) && !empty($edit->image))
  <img src="{{asset(showImage($edit->image,'uploaded_files/blog'))}}" alt="image" width="100%">
   <br> <a href="{{route('blog.remove.image',[$edit->id,'image'])}}" class="text-danger">Remove</a>
 @else 
  <img src="{{asset(noImage())}}" alt="image" width="100%">   
 @endif 
 <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"> 
 <span class="text-danger"><strong>679px x 679px</strong> , <strong>Size:</strong> 150 KB</span>
 @error('image')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror  
</div>

<div class="col-lg-9">
 @if(isset($edit) && !empty($edit->banner))
  <img src="{{asset(showImage($edit->banner,'uploaded_files/blog'))}}" alt="image" width="100%">
   <br> <a href="{{route('blog.remove.image',[$edit->id,'banner'])}}" class="text-danger">Remove</a>
 @else 
  <img src="{{asset(noBanner())}}" alt="image" width="100%">   
 @endif 
 <input type="file" name="banner" id="banner" class="form-control @error('banner') is-invalid @enderror mt-2"> 
 <span class="text-danger"><strong>Dimension:</strong> 1500px x 300px, <strong>Size:</strong> 200 KB</span>
 @error('banner')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror  
</div>

</div>

<div class="row">

 <div class="col-sm-8">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="Name" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
 <label for="floatingInput">Name</label>
  @error('name')
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
 
  <div class="col-sm-2">
  <input type="checkbox" name="is_news" id="is_news" @isset($edit) @if($edit->is_news) checked @endif @endisset />    
  <label for="is_news">Is News?</label>
 </div>

 <div class="col-sm-6">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('alt') is-invalid @enderror" id="floatingInput" name="alt" placeholder="Image Alt" @isset($edit) value="{{$edit->alt}}" @else value="{{old('alt')}}" @endisset>
 <label for="floatingInput">Image Alt</label>
  @error('alt')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>

 <div class="col-sm-6">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('title') is-invalid @enderror" id="floatingInput" name="title" placeholder="Image Title" @isset($edit) value="{{$edit->title}}" @else value="{{old('title')}}" @endisset>
 <label for="floatingInput">Image Title</label>
  @error('title')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content">@isset($edit){{$edit->content}}@endisset</textarea>
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
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_title" placeholder="Enter Meta Title">@isset($edit){{$edit->meta_title}}@endisset</textarea>
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
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_description" placeholder="Enter Meta Description">@isset($edit){{$edit->meta_description}}@endisset</textarea>
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
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_keywords" placeholder="Enter Meta Keywords">@isset($edit){{$edit->meta_keywords}}@endisset</textarea>
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

</form>
</div>
</div>

</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
