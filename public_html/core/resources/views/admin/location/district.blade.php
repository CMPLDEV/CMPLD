@extends('admin.layouts.app')
@section('title','Pincodes List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Pincodes List of "{{$state->name}}"</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Pincodes List</li>
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
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: {{$data->total()}}</span>
  </div>

  <div class="col-lg-7">
   <form class="search-form d-flex align-items-center" method="GET" action="{{route('district.search')}}">
    @csrf  

   <input type="hidden" name="state_id" value="{{$state->id}}" />    
    
 <div class="input-group mb-3">

 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search by name" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword))
     <a href="{{route('district',$state->id)}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 
 <a href="{{route('admin.location')}}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Go Back"> <i class="ri-add-circle-line"></i> Back</a>
     
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="districtModal('{{$state->id}}');"> <i class="ri-add-circle-line"></i> Add new</a>
</div> 
</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="{{route('district.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Pincode</th>
    <th scope="col">Status</th>
    <th scope="col">Created at</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</th>
    
    <td>{{$row->pincode}}</td>
    
    <td> {!!statusBadge($row->status)!!} </td>
    
    <td>{{date('d-m-Y',strtotime($row->created_at))}}</td>
    
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="districtModal('{{$state->id}}','{{$row->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a>
    </td>
  </tr>

@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer"> 
 <input type="submit" name="req_for" value="Active" class="btn btn-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-danger req_for btn-sm">
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
