@extends('admin.layouts.app')
@section('title','Logs History')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Logs History</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Logs History</li>
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

  <div class="col-lg-10">
    <form class="search-form d-flex align-items-center" method="GET" action="{{route('log.search')}}">
    @csrf  
 <div class="input-group mb-3">

 <select name="filter" id="filter" class="form-control">
  <option value="">Choose action</option>
  <option value="ADD" @isset($filter) @if($filter=="ADD") selected @endif @endisset>ADD</option>
  <option value="UPDATE" @isset($filter) @if($filter=="UPDATE") selected @endif @endisset>UPDATE</option>
  <option value="DELETE" @isset($filter) @if($filter=="DELETE") selected @endif @endisset>DELETE</option>
 </select>
 
 <input type="text" class="form-control" name="date" placeholder="Search By Date" @isset($date) value="{{$date}}" @endisset onClick="$(this).attr('type','date');">
 
 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror w-25" placeholder="Search by: Action title" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
 
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword) || isset($filter) || isset($date))
     <a href="{{route('log')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 <div class="col-lg-2">
 
</div> 
</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="#" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
 <tr>
  <th scope="col">S.No</th>
  <th scope="col">Action</th>
  <th scope="col">Action By</th>
  <th scope="col">Action On</th>
  <th scope="col">Action Title</th>
  <th scope="col">Created At</th>
 </tr>
</thead>
<tbody>
@foreach($data as $row)
 <tr>
  <th scope="row">{{++$i}}.</th>
  <td>{{$row->action}}</td>
  <td>{{$row->action_by}}</td>
  <td>{{$row->action_on}}</td>
  <td width="500">{{$row->action_title}}</td>
  <td>{{date('d-m-Y  h:s A',strtotime($row->created_at))}}</td>
 </tr>
@endforeach
</tbody>
</table>

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
</div>
@endsection