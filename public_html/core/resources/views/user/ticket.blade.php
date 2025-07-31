@extends('layouts.app')

@section('title','Ticket System | User Panel')
@section('description','Ticket System | User Panel')
@section('keywords','Ticket System | User Panel')

@section('content')

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
@include('user.sidebar')
</div>
<div class="col-lg-9">
<div class="dashboard-box">
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
 <form class="search-form d-flex align-items-center" method="GET" action="{{route('userpanel.ticket.search')}}">
    @csrf  
 <div class="input-group mb-3">

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
  <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
  </div>
  @if(isset($search_keyword) || isset($status))
     <a href="{{route('userpanel.ticket')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="fa fa-filter"></i></a>
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
  
 <div class="input-group mb-3">
  <input type="text" name="serial_no" id="serial_no" class="form-control" placeholder="Serial No." />
  <button class="btn btn-success" type="button" onClick="raiseTicket();">Raise a ticket</button>
 </div>
   
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
    <th scope="col">S.No</th>
    <th scope="col">Ticket no</th>
    <th scope="col">Contract No</th>
    <th scope="col">Subject</th>
    <th scope="col">Status</th>
    <!-- <th scope="col">Action</th> -->
  </tr>
</thead>
<tbody>
@foreach($data as $row)
  <tr>
    <th scope="row">{{++$i}}</th>
    <td>#{{$row->id}}</td>
    <td> {{$row->serial_no}} </td>
    <td> <a href="javascript:void(0);" onClick="viewTicket('{{$row->id}}');"> {{$row->subject}} <i class="fa fa-arrow-right"></i> </a> </td>
    <td> <span class="{{ticketStatusColor($row->status)}} fw-bold">{{$row->status}}</span> </td>

    <!-- <td>
      <a href="{{route('page.edit',$row->id)}}" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a>
    </td> -->
  </tr>

@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 
</div> 
</div>
</form>
{{$data->appends($_GET)->links()}}
@else

<div class="alert alert-danger alert-dismissible fade show w-100 m-auto" role="alert">
<i class="bi bi-exclamation-octagon me-1"></i>No Record Found!
</div>

@endif

</div>
</div>    
</div>
</div>
</div>
</div>
</section>

@endsection