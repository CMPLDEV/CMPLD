@extends('admin.layouts.app')
@section('title','Users List')
@section('content')

<form method="GET" action="{{route('user.export')}}" id="export-form">
 @csrf
 <input type="hidden" name="user_ids" id="user_ids" />
</form>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Users List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item">
<select onChange="showPerPage('user_per_page',this.value);" class="rounded-0 border-secondary">
 <option value="">Show Per Page</option> 
 <option value="25" @if(setting()->user_per_page==25) selected @endif>25</option>
 <option value="50" @if(setting()->user_per_page==50) selected @endif>50</option>
 <option value="75" @if(setting()->user_per_page==75) selected @endif>75</option>
 <option value="100" @if(setting()->user_per_page==100) selected @endif>100</option>
</select>
</li>   
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Users List</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->
<div class="row">
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
 <form class="search-form d-flex align-items-center" method="GET" action="{{route('user.search')}}">
    @csrf  
 <div class="input-group mb-3">
 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @isset($search_keyword)
     <a href="{{route('user')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    @endisset
  @error('search_keyword')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
 </form>
 </div>
 <div class="col-lg-4">
 <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Import" onClick="importUser();"> <i class="icon nav-icon" data-feather="upload"></i></a>
  &nbsp;
 <a href="javascript:void(0);" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="Export" onClick="exportUser();"> <i class="icon nav-icon" data-feather="download"></i></a>
 &nbsp;
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="userModal();"> <i class="icon nav-icon" data-feather="plus"></i> </a>
 </div> 
</div>
</div>

@if($data->isNotEmpty())
<br>
<form action="{{route('user.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Mobile</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
@foreach($data as $user)
@php
 $user_st = ($user->status==1) ? 0 : 1;
@endphp
  <tr>
    <th scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$user->id}}"> {{++$i}}</th>
    <td>{{$user->name}}
      <span class="badge bg-info float-end">{{$user->type}}</span>
    </td>
    <td>{{$user->email}}</td>
    <td>{{$user->mobile}}</td>
    <td>
      <a href="{{route('user.update.status',[$user->id,$user_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($user->status)!!}</a> 
    </td>
    <td>
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="userModal('{{$user->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Address" onClick="userAddressModal('{{$user->id}}','add');"><i class="icon nav-icon" data-feather="map-pin"></i></a> &nbsp;
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Delete" onClick="deleteUser('{{$user->id}}')" class="text-danger"><i class="icon nav-icon" data-feather="trash"></i></a>
    </td>
  </tr>
@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <div class="row">
  <div class="col-lg-12">
  <input type="submit" name="req_for" class="btn btn-outline-success" value="Active" /> &nbsp;
  <input type="submit" name="req_for" class="btn btn-outline-danger" value="Inactive" /> &nbsp;
  <input type="submit" name="req_for" class="btn btn-outline-danger float-end" value="Delete" /> 
  </div>
 </div> 
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
