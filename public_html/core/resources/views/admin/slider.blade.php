@extends('admin.layouts.app')
@section('title','Slider List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Slider List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Slider List</li>
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
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{COUNT($data)}}</span>
  </div>

  <div class="col-lg-7">

  </div>
 </div> 


 </div>
 <div class="col-lg-3">
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="sliderModal();"> <i class="ri-add-circle-line"></i> Add new</a>
 </div> 
</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="{{route('slider.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Image</th>
    <th scope="col">Title</th>
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
  <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{$i++}}</td>
    <td class="v-align">
     <img src="{{asset(showImage($row->image,'uploaded_files/slider'))}}" alt="{{$row->name}}" width="100">
    </td>
    <td>{{$row->title}} </td>

    <input type="hidden" name="order_by_ids[]" class="order_by_ids" value="{{ $row->id }}"/>
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="{{ $row->order_by }}" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>

    <td><a href="{{route('slider.update.status',[$row->id,$row_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($row->status)!!}</a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="sliderModal('{{$row->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a>
     @if(canDelete()) &nbsp;
      <a href="javascript:void(0);" class="text-danger" data-bs-toggle="tooltip" title="Delete" onClick="deleteSlider('{{$row->id}}')"><i class="icon nav-icon" data-feather="trash"></i></a>
     @endif
    </td>
  </tr>
@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <input type="submit" name="req_for" value="Update Order" class="btn btn-outline-warning req_for btn-sm">
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
