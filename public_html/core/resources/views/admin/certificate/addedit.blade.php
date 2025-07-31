@extends('admin.layouts.app')
@section('title','Add/Edit Certificate')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Certificate</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Certificate</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Certificate
<a href="{{route('admin.certificate')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('certificate.update',$edit->id)}}" @else action="{{route('certificate.create')}}" @endisset>
 @csrf

<div class="row mb-3">

<div class="col-lg-3">
 @if(isset($edit) && !empty($edit->pdf))
  <h6><a href="{{url('uploaded_files/certificate/'.$edit->pdf)}}" target="_blank">View Certificate <i class="fa fa-arrow-right"></i></a></h6>
 @else 
  <h6>No certificate uploaded!</h6>   
 @endif 
 <input type="file" name="pdf" id="pdf" class="form-control @error('pdf') is-invalid @enderror"> 
 @error('pdf')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror  
</div>

<div class="col-lg-6">
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

<div class="col-lg-3">
<div class="form-floating mb-3">
 <input type="date" class="form-control @error('issued_on') is-invalid @enderror" id="floatingInput" name="issued_on" placeholder="Issued On" @isset($edit) value="{{$edit->issued_on}}" @else value="{{old('issued_on')}}" @endisset>
 <label for="floatingInput">Issued On</label>
  @error('issued_on')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
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