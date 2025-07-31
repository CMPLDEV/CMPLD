@extends('admin.layouts.app')
@section('title','Add/Edit Showcase Product')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Showcase Product</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Showcase Product</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Showcase Product
<a href="{{route('showcase.product', $showcase->id)}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('showcase.product.update')}}" @else action="{{route('showcase.product.create')}}" @endisset>
 @csrf
 
 <input type="hidden" name="showcase_id" value="{{$showcase->id}}">
 @isset($edit)
  @method('PUT')
  <input type="hidden" name="id" value="{{$edit->id}}">
 @endisset

<div class="row mb-3">

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <select name="product_id" id="product_id" class="selectpicker @error('product_id') is-invalid @enderror" data-live-search="true">
 <option value="">Choose any</option>
 @foreach($all_products as $row)
  <option value="{{$row->id}}">{{$row->name}}</option>
 @endforeach
</select>
 @error('product_id')
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

@section('custom-script')
 <script>
  let company_name = $('#company_name').val();
  let data_array = company_name.split("-");
  let id = data_array[data_array.length - 1].trim();  
  showCompanyProducts(id);  
 </script>   
@endsection