@extends('admin.layouts.app')
@section('title','Add/Edit Identify Product')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start Blog title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Add/Edit Identify Product</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Add/Edit Identify Product</li>
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
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Identify Product
<a href="{{route('admin.identify.product')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('identify.product.update')}}" @else action="{{route('identify.product.create')}}" @endisset>
 @csrf
 @isset($edit) @method('PUT') 
 <input type="hidden" name="id" value="{{$edit->id}}" /> @endisset

<div class="row">
 <div class="col-lg-4">
  <div class="input-group mb-3">
   <input type="text" class="form-control" placeholder="Enter SKU No" name="sku" id="sku">
   <button class="btn btn-dark" type="button" id="fetch_btn" onClick="productBySKU();">Fetch</button>
  </div>      
 </div> 

</div>

<hr>

<div class="row">
 
 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('asin') is-invalid @enderror" id="asin" name="asin" placeholder="ASIN" @isset($edit) value="{{$edit->asin}}" @else value="{{old('asin')}}" @endisset readonly>
 <label for="floatingInput">ASIN</label>
  @error('asin')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-9">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name" placeholder="Product Name" @isset($edit) value="{{$edit->product_name}}" @else value="{{old('product_name')}}" @endisset readonly>
 <label for="floatingInput">Product Name</label>
  @error('product_name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
  <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('serial_no') is-invalid @enderror" id="floatingInput" name="serial_no" placeholder="Serial No" @isset($edit) value="{{$edit->serial_no}}" @else value="{{old('serial_no')}}" @endisset>
 <label for="floatingInput">Serial No</label>
  @error('serial_no')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="floatingInput" name="quantity" placeholder="Quantity" @isset($edit) value="{{$edit->quantity}}" @else value="{{old('quantity')}}" @endisset>
 <label for="floatingInput">Quantity</label>
  @error('quantity')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="date" class="form-control @error('warranty_start_date') is-invalid @enderror" id="floatingInput" name="warranty_start_date" placeholder="Warranty Start Date" @isset($edit) value="{{$edit->warranty_start_date}}" @else value="{{old('warranty_start_date')}}" @endisset>
 <label for="floatingInput">Warranty Start Date</label>
  @error('warranty_start_date')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="date" class="form-control @error('warranty_end_date') is-invalid @enderror" id="floatingInput" name="warranty_end_date" placeholder="Warranty End Date" @isset($edit) value="{{$edit->warranty_end_date}}" @else value="{{old('warranty_end_date')}}" @endisset>
 <label for="floatingInput">Warranty End Date</label>
  @error('warranty_end_date')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>
 
 <div class="col-sm-12">
 <div class="form-floating mb-3">
 <textarea class="form-control @error('remark') is-invalid @enderror" id="floatingInput" name="remark" placeholder="Remark">@isset($edit){{$edit->remark}}@else{{old('remark')}}@endisset</textarea>
 <label for="floatingInput">Remark</label>
  @error('remark')
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
