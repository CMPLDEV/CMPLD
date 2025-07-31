@extends('admin.layouts.app')
@section('title','Product List')
@section('content')

<style>
.number-list{
  font-size: 22px;
  font-weight: 600;
  color: #00aff0;
}
.ico{
  float: right;
  margin-top: 6px;
}
</style>

<form method="POST" action="{{route('product.export')}}" id="export-form">
 @csrf
 <input type="hidden" name="product_ids" id="product_ids" />
</form>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item">
<select onChange="showPerPage('product_per_page',this.value);" class="rounded-0 border-secondary">
 <option value="">Show Per Page</option> 
 <option value="50" @if(setting()->product_per_page==50) selected @endif>50</option>
 <option value="100" @if(setting()->product_per_page==100) selected @endif>100</option>
 <option value="200" @if(setting()->product_per_page==200) selected @endif>200</option>
 <option value="500" @if(setting()->product_per_page==500) selected @endif>500</option>
 <option value="1000" @if(setting()->product_per_page==1000) selected @endif>1000</option>
 <option value="2000" @if(setting()->product_per_page==2000) selected @endif>2000</option>
</select>
</li>  
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product List</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-4">
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->all_count}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">All Products</p>
</div>
</div>
</div>
<div class="col-lg-4">
<a href="{{url('admin/product/search?_token='.csrf_token().'&filter=ACTIVE&search_keyword=')}}">    
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->active_count}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Active Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="{{url('admin/product/search?_token='.csrf_token().'&filter=INACTIVE&search_keyword=')}}">    
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->inactive_count}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Inactive Listings</p>
</div>
</div>
</a>
</div>

<div class="col-lg-4">
<a href="{{url('admin/product/search?_token='.csrf_token().'&filter=INSTOCK&search_keyword=')}}">    
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->in_stock}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">In-Stock Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="{{url('admin/product/search?_token='.csrf_token().'&filter=OUTSTOCK&search_keyword=')}}">    
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->out_of_stock}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Out-of Stock Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="{{url('admin/product/search?_token='.csrf_token().'&filter=EOL&search_keyword=')}}">    
<div class="active-box card">
<div class="card-body">
<span class="number-list">{{allProductCount()[0]->eol_count}} <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">End of Life Listings</p>
</div>
</div>
</a>
</div>

<!-- all product sec -->
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
<div class="mt-3">
<div class="row">
 <div class="col-lg-8">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{$data->total()}}</span>
  </div>

  <div class="col-lg-10">
  <form class="search-form d-flex align-items-center" method="GET" action="{{route('product.search')}}">
    @csrf  
 <div class="input-group mb-3">
 <select name="brand" id="brand" class="form-control">
  <option value="">Choose brand</option>     
  @foreach(brands() as $row)
   <option value="{{$row->id}}" @isset($brand) @if($brand == $row->id) selected @endif @endisset>{{$row->name}}</option>
  @endforeach
 </select>
 <select name="category" id="category" class="selectpicker" data-live-search="true">
  <option value="">Choose category</option>     
  @foreach(adminCategories() as $row)
   <option value="{{$row->id}}" @isset($category) @if($category == $row->id) selected @endif @endisset>{{$row->name}}</option>
   @foreach(adminCategories($row->id) as $row)
    <option value="{{$row->id}}" @isset($category) @if($category == $row->id) selected @endif @endisset> &nbsp; -{{$row->name}}</option>
    @foreach(adminCategories($row->id) as $row)
     <option value="{{$row->id}}" @isset($category) @if($category == $row->id) selected @endif @endisset> &nbsp;&nbsp; --{{$row->name}}</option>
    @endforeach
   @endforeach
  @endforeach
 </select>
 <select name="filter" id="filter" class="form-control">
  <option value="">Sort By</option>
  <option value="A-Z" @isset($filter) @if($filter=="A-Z") selected @endif @endisset>A-Z</option>
  <option value="Z-A" @isset($filter) @if($filter=="Z-A") selected @endif @endisset>Z-A</option>
  <option value="ON" @isset($filter) @if($filter=="ON") selected @endif @endisset>Old - New</option>
  <option value="NO" @isset($filter) @if($filter=="NO") selected @endif @endisset>New - Old</option>
  <option value="ACTIVE" @isset($filter) @if($filter=="ACTIVE") selected @endif @endisset>Active</option>
  <option value="INACTIVE" @isset($filter) @if($filter=="INACTIVE") selected @endif @endisset>Inactive</option>
  <option value="INSTOCK" @isset($filter) @if($filter=="INSTOCK") selected @endif @endisset>In-Stock</option>
  <option value="OUTSTOCK" @isset($filter) @if($filter=="OUTSTOCK") selected @endif @endisset>Out-of Stock</option>
  <option value="EOL" @isset($filter) @if($filter=="EOL") selected @endif @endisset>End of life</option>
 </select>

 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword) || isset($filter) || isset($category) || isset($brand))
     <a href="{{route('product')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    @endif
  @error('search_keyword')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
 </form>
  </div>
 </div>
 </div>
 <div class="col-lg-4">
@if(canUpdate()) 
 <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Import" onClick="importProduct();"> <i class="icon nav-icon" data-feather="upload"></i></a>
  &nbsp;
 <a href="javascript:void(0);" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="Export" onClick="exportProduct();"> <i class="icon nav-icon" data-feather="download"></i></a>
 &nbsp;
 @endif 
 <a href="{{route('product.add')}}" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="icon nav-icon" data-feather="plus"></i></a>

 </div> 
</div>
<div class="text-muted pt-1"> Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>
<hr>
@if($data->isNotEmpty())
<hr>
<form action="{{route('product.bottom.action')}}" method="POST" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Product Details</th>
    <th scope="col">MRP</th>
    <th scope="col">Price</th>
    <th scope="col">Stock</th>
    <th scope="col">Show As</th>
    <th scope="col">Order</th>
    <th scope="col">Status</th>
    <th scope="col">Date</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
@php
 $row_st = ($row->status==1) ? 0 : 1;
@endphp
  <tr>
    <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</td>
    <td class="v-align"><img src="{{asset(showImage($row->image,'uploaded_files/product'))}}" width="60" class="rounded" style="float: left;margin-right: 15px;">
   <a href="{{productURL($row->slug)}}" target="_blank" style="color:#038edc;font-weight: 600;">{{Str::limit($row->name, 35, $end='...')}}</a> <br>
   <b>SKU ID:</b> {{$row->sku}} <br>
    @if(!empty(category($row->category_id))) {{category($row->category_id)->name}} @endif
    
    </td>
    
    <input type="hidden" name="hidden_ids[]" class="hidden_ids" value="{{ $row->id }}"/>
    <td class="text-center v-align"><input type="number" min="0" name="mrp[]" class="mrp form-control" value="{{ $row->mrp }}" style="background-color:whitesmoke;text-align:center;width:70px;padding:0px" />
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="price[]" class="price form-control" value="{{ $row->price }}" style="background-color:whitesmoke;text-align:center;width:70px;padding:0px" />
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="stock[]" class="stock form-control" value="{{ $row->stock }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>
    
    <td>
    @if($row->is_featured == 1)
      <span class="badge bg-warning" title="Featured">Featured</span>
    @endif

    @if($row->is_best == 1)
      <span class="badge bg-warning" title="Best">Best</span>
    @endif
    
    @if($row->is_eol == 1)
        <span class="badge bg-warning" title="EOL">EOL</span>
    @endif
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="{{ $row->order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>

    <td>
    <a href="{{route('product.update.status',[$row->id,$row_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($row->status)!!}</a>
    </td>
    <td width="120px">
     <p><b>Created:</b> {{$row->created_at}}</p>
     <p><b>Updated:</b> {{$row->updated_at}}</p>
    </td>
    <td>
     <div class="d-flex">
      <a href="{{route('product.edit',$row->id)}}" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a> 
       &nbsp;&nbsp;&nbsp;&nbsp;
     <a href="{{route('product.copy',$row->id)}}" data-bs-toggle="tooltip" title="Copy" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="copy"></i></a> 
       &nbsp;&nbsp;
      <a href="{{route('product.offer',$row->id)}}" data-bs-toggle="tooltip" title="Manage Offer"> <i class="fa fa-gift" style="font-size: 17px;
    margin: 0 10px;"></i></a>
     &nbsp;&nbsp;
     <a href="https://cmpl-amazon-calculator.netlify.app/" target="popup" onclick="window.open('https://cmpl-amazon-calculator.netlify.app/','popup','width=750,height=550'); return false;" title="Calculator">
    <img src="admin_assets/images/calculator.png" style="max-width: 15px;" alt=" Calc" title="Calculator" target="_blank" onerror="this.onerror=null;this.src='';">
    </a>
      </div>
    </td>
  </tr>
@endforeach
</tbody>
</table>


<div class="card">
 <div class="card-footer"> 
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Make Featured" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Featured" class="btn btn-outline-dark req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Make Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Make EOL" class="btn btn-outline-info req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove EOL" class="btn btn-outline-info req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Update Input" class="btn btn-outline-dark req_for btn-sm">
 @if(canDelete())  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
 @endif 
</div> 
</div>

</form>
{{$data->appends($_GET)->links()}}
@else

<div class="alert alert-danger alert-dismissible fade show w-50 m-auto" role="alert">
<i class="bi bi-exclamation-octagon me-1"></i>No Record Found!
</div>

@endif

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

@endsection
