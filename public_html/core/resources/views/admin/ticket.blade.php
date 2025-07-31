@extends('admin.layouts.app')
@section('title','Ticket List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Ticket List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Ticket List</li>
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
 <form class="search-form d-flex align-items-center" method="GET" action="{{route('ticket.search')}}">
    @csrf  
 <div class="input-group mb-3">
 @if(isAdmin())
 <select class="form-control" name="admin_id">
   <option value="">Choose user</option> 
   <option value="0" @isset($admin_id) @if($admin_id == 0) selected @endif @endisset>Admin</option>
   @foreach($admins as $row)
    <option value="{{$row->id}}" @isset($admin_id) @if($admin_id == $row->id) selected @endif @endisset>{{$row->name}}</option>
   @endforeach
  </select>
  @else
  <input type="hidden" name="admin_id" value="{{admin()->id}}" />
 @endif
 <select name="status" id="filter" class="form-control">
  <option value="">Status</option>
  <option value="OPEN" @isset($status) @if($status=="OPEN") selected @endif @endisset>OPEN</option>
  <option value="WORK IN PROGRESS" @isset($status) @if($status=="WORK IN PROGRESS") selected @endif @endisset>WORK IN PROGRESS</option>
  <option value="SUSPENDED" @isset($status) @if($status=="SUSPENDED") selected @endif @endisset>SUSPENDED</option>
  <option value="WAITING FOR USER" @isset($status) @if($status=="WAITING FOR USER") selected @endif @endisset>WAITING FOR USER</option>
  <option value="RESOLVED" @isset($status) @if($status=="RESOLVED") selected @endif @endisset>RESOLVED</option>
  <option value="CLOSED" @isset($status) @if($status=="CLOSED") selected @endif @endisset>CLOSED</option>
 </select>

 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword) || isset($status) || isset($admin_id))
     <a href="{{route('ticket')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 <!-- <a href="{{route('page.add')}}" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="ri-add-circle-line"></i> Add new</a> -->
</div> 
</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="{{route('ticket.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Ticket no</th>
    <th scope="col">Serial no</th>
    <th scope="col">Subject</th>
    <th scope="col">Status</th>
    <th scope="col">Assigned Person</th>
    <th scope="col">Created At</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</th>
    <td>#{{$row->id}}</td>
    <td>{{$row->serial_no}}</td>
    <td> <a href="{{route('ticket.detail',$row->id)}}" @if($row->is_seen == 0) class="fw-bold" @endif> {{$row->subject}} <i class="fa fa-arrow-right"></i> </a> </td>
    <td> <span class="{{ticketStatusColor($row->status)}} fw-bold">{{$row->status}}</span> </td>
    <td> @if($row->admin_id !=0 && !empty(admin($row->admin_id))) {{admin($row->admin_id)->name}} @else - @endif </td>
    <td> {{date('d-m-Y',strtotime($row->created_at))}} </td>
  </tr>

@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <div class="row">
 <div class="col-lg-4 col-sm-12">
 @if(admin()->type != "SUB_ADMIN")     
  <div class="input-group mb-3">
  <select class="form-control" name="admin_id" id="admin_id">
   <option value="">Choose user</option> 
   <option value="0">Admin</option>
   @foreach($admins as $row)
    <option value="{{$row->id}}">{{$row->name}}</option>
   @endforeach
  </select>
  <button class="btn btn-success" type="button" onClick="assignTicket();">Assign</button>
 </div> 
 @endif
 </div>
 
 <div class="col-lg-8 col-sm-12">
  @if(canDelete())  
   <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
  @endif      
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
