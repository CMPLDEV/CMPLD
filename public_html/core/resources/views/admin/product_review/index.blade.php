@extends('admin.layouts.app')
@section('title','Product Review')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product Review</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product Review</li>
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
<form action="#" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Product</th>
    <th scope="col">Reviews Count</th>
    <th scope="col">Created At</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</th>
    <td><a href="{{route('admin.product.review.detail',$row->product_id)}}">{{$row->name}} <i class="icon nav-icon" data-feather="arrow-right"></i> </a></td>
    <td>{{totalReviews($row->product_id)}}</td>
    <td> {{date('d M, Y',strtotime($row->created_at))}} </td>
  </tr>
@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 @if(canDelete())  
 <!--<input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">-->
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
