@extends('admin.layouts.app')
@section('title','Category List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Category List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Category List</li>
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
<div class="mt-3">
<div class="row">
 <div class="col-lg-9">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{categoryCount()}}</span>
  </div>

  <div class="col-lg-7">
   <form class="search-form d-flex align-items-center" method="GET" action="{{route('category.search')}}">
    @csrf  
 <div class="input-group mb-3">

 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword))
     <a href="{{route('admin.category')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 <div class="col-lg-3">
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="categoryModal();"> <i class="ri-add-circle-line"></i> Add new</a>
 </div> 
</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="{{route('category.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table id="" class="table table-bordered">
<thead>
  <tr>
  <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Image</th>
    <th scope="col">Name</th>
    <th scope="col">Attribute</th>
    <th scope="col">Order</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
@php
 $row_st = ($row->status==1) ? 0 : 1;
@endphp
  <tr>
  <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{$i++}} 
  @if($row->for_home == 1)  
   <span class="badge bg-warning" title="Home">Home</span>
  @endif
  @if($row->is_best == 1)  
   <span class="badge bg-warning" title="Best">Best</span>
  @endif
  @if($row->for_header == 1)  
   <span class="badge bg-warning" title="Header">Header</span>
  @endif
  @if($row->for_all == 1)  
   <span class="badge bg-warning" title="All">All</span>
  @endif
  
  </td>
    <td class="v-align">
     <img src="{{asset(showImage($row->image,'uploaded_files/category'))}}" alt="{{$row->name}}" width="40" class="rounded">
    </td>
    <td><a href="{{route('product.category',$row->id)}}" class="text-muted" target="_blank">{{$row->name}} ({{productCount($row->id)}})</a></td>
    
    <td><a href="{{route('category.attribute',$row->id)}}" class="btn btn-outline-dark btn-sm">Manage Attribute</a></td>
    
    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="{{ $row->id }}"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="{{ $row->order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>
    <td><a href="{{route('category.update.status',[$row->id,$row_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($row->status)!!}</a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="categoryModal('{{$row->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a>
     @if(canDelete()) &nbsp;
      <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Delete" onClick="deleteCategory('{{$row->id}}')"><i class="icon nav-icon" data-feather="trash"></i></a>
     @endif
    </td>
  </tr>
  @foreach(adminCategories($row->id) as $row)
@php
 $row_st = ($row->status==1) ? 0 : 1;
@endphp
  <tr>
  <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{$i++}} 
  @if($row->for_home == 1)  
   <span class="badge bg-warning" title="Home">Home</span>
  @endif
  @if($row->is_best == 1)  
   <span class="badge bg-warning" title="Best">Best</span>
  @endif
  @if($row->for_header == 1)  
   <span class="badge bg-warning" title="Header">Header</span>
  @endif
  @if($row->for_all == 1)  
   <span class="badge bg-warning" title="All">All</span>
  @endif
  </td>
    <td class="v-align">
     <img src="{{asset(showImage($row->image,'uploaded_files/category'))}}" alt="{{$row->name}}" width="40" class="rounded">
     
    </td>
    <td> <a href="{{route('product.category',$row->id)}}" class="text-muted" target="_blank"> - {{$row->name}} ({{productCount($row->id)}})</a> </td>
    
    <td><a href="{{route('category.attribute',$row->id)}}" class="btn btn-outline-dark btn-sm">Manage Attribute</a></td>
    
    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="{{ $row->id }}"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="{{ $row->order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>
    <td><a href="{{route('category.update.status',[$row->id,$row_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($row->status)!!}</a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="categoryModal('{{$row->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a>
     @if(canDelete()) &nbsp;
      <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Delete" onClick="deleteCategory('{{$row->id}}')"><i class="icon nav-icon" data-feather="trash"></i></a>
     @endif
    </td>
  </tr>
@endforeach
@endforeach
</tbody>
</table>
<div class="card">
 <div class="card-footer">
  
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Show Home" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Home" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Make Best" class="btn btn-outline-primary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Best" class="btn btn-outline-primary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Show Header" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Header" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Show All" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove All" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Update Order" class="btn btn-outline-warning req_for btn-sm">
 @if(canDelete())  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
 @endif 
</div> 
</div>

</form>
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
