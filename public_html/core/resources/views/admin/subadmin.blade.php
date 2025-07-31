@extends('admin.layouts.app')
@section('title','Sub Admin')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Sub Admin</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Sub Admin</li>
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
  <form class="search-form d-flex align-items-center" method="GET" action="{{route('search-subadmin')}}">
    @csrf  
 <div class="input-group mb-3">
 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @isset($search_keyword)
     <a href="{{route('subadmin')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    @endisset
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
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="subadminModal();"> <i class="ri-add-circle-line"></i> Add new</a>
 </div> 
</div>
<div class="text-muted pt-1"> Showing {{$data->firstItem()}} to {{$data->lastItem()}} of {{$data->total()}} &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>

@if($data->isNotEmpty())
<br>
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col">S.No</th>
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
 $status = ($user->status==1) ? "bg-success" : "bg-danger";
 $user_st = ($user->status==1) ? 0 : 1;
@endphp
  <tr>
    <th scope="row">{{++$i}}</th>
    <td>{{$user->name}}
      <span class="badge bg-info float-end">{{$user->type}}</span>
    </td>
    <td>{{$user->email}}</td>
    <td>{{$user->mobile}}</td>
    <td><a href="{{route('subadmin.update.status',[$user->id,$user_st])}}" onClick="return confirm('Are you sure?');">{!!statusBadge($user->status)!!}</a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="subadminModal('{{$user->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Sub Admin" onClick="changeSubadminPassword('{{$user->id}}')"><i class="icon nav-icon" data-feather="lock"></i></a> &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="View Roles" onClick="viewRoles('{{$user->id}}')"><i class="icon nav-icon" data-feather="eye"></i></a>
    @if(canDelete()) &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Delete" onClick="deleteSubadmin('{{$user->id}}')" class="text-danger"><i class="icon nav-icon" data-feather="trash"></i></a>
     @endif
    </td>
  </tr>
@endforeach
</tbody>
</table>
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
