@extends('admin.layouts.app')
@section('title','Add/Edit FAQ')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit FAQ</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit FAQ</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset FAQ
<a href="{{route('admin.faq')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('faq.update')}}" @else action="{{route('faq.create')}}" @endisset>
 @csrf
 @isset($edit) 
  @method('PUT')  
  <input type="hidden" name="id" value="{{$edit->id}}"> 
 @endisset

<div class="row mb-3">

<div class="col-sm-10">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('question') is-invalid @enderror" id="floatingInput" name="question" placeholder="Question" @isset($edit) value="{{$edit->question}}" @else value="{{old('question')}}" @endisset>
 <label for="floatingInput">Question</label>
  @error('question')
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
 
 <div class="col-sm-12 mb-3 mt-2">
 <label for="floatingInput">Answer</label>
 <textarea type="text" class="form-control" id="answer" rows="3" name="answer" placeholder="Enter Answer" @isset($edit) value="{{$edit->answer}}" @else value="{{old('answer')}}" @endisset>@isset($edit) {{$edit->answer}} @endisset</textarea>
  @error('answer')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
<script>CKEDITOR.replace('answer');</script>


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