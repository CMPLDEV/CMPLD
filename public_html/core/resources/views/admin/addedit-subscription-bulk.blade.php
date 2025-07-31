@extends('admin.layouts.app')
@section('title','Subcription Bulk')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Subcription Bulk</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Subcription Bulk</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Subscription Bulk
<a href="{{route('subscription.bulk')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="" @else action="{{route('subscription.bulk.create')}}" @endisset>
 @csrf

<div class="row mb-3">

<div class="col-lg-3">
 @if(isset($edit) && !empty($edit->image))
  <img src="{{asset(showImage($edit->image,'uploaded_files/subscription'))}}" alt="image" width="100%">
   <br> <a href="{{route('blog.remove.image',[$edit->id,'image'])}}" class="text-danger">Remove</a>
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

 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('subject') is-invalid @enderror" id="floatingInput" name="subject" placeholder="Subject" @isset($edit) value="{{$edit->subject}}" @else value="{{old('subject')}}" @endisset>
 <label for="floatingInput">Subject</label>
  @error('subject')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>

 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="4" name="content" placeholder="Enter Content">@isset($edit){{$edit->content}}@endisset</textarea>
  @error('content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 <script>CKEDITOR.replace('content');</script>

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
