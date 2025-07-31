@extends('admin.layouts.app')
@section('title','Showcase Listing')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Showcase Listing</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"></li>  
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Showcase Listing</li>
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
 <div class="col-lg-8">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{$data->total()}}</span>
  </div>

  <div class="col-lg-7">

  </div>
 </div>
 </div>
 <div class="col-lg-4">
 <a href="{{route('showcase.add')}}" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="icon nav-icon" data-feather="plus"></i> Add New </a>

 </div> 
</div>
<div class="text-muted pt-1"> Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>
<hr>
@if($data->isNotEmpty())
<hr>
<form action="{{route('showcase.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Showcase</th>
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
    <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</td>
    <td><img src="{{asset(showImage($row->banner,'uploaded_files/showcase'))}}" alt="{{$row->name}}" width="100" class="rounded">
    <a href="{{route('showcase.product',$row->id)}}"> {{$row->name}} <i class="fas fa-arrow-right"></i> </a> 
    </td>
    
    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="{{ $row->id }}"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="{{ $row->order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>

    <td>
    <a href="{{route('showcase.update.status',[$row->id,$row_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($row->status)!!}</a>
    </td>
    <td>
      <a href="{{route('showcase.edit',$row->id)}}" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a>
    </td>
  </tr>
@endforeach
</tbody>
</table>


<div class="card">
 <div class="card-footer"> 
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Update Order" class="btn btn-outline-warning req_for btn-sm">
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
