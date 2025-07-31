@extends('admin.layouts.app')
@section('title','Order List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Order List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Order List</li>
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

  <div class="col-lg-9">
 <form class="search-form d-flex align-items-center" method="GET" action="{{route('order.search')}}">
  @csrf  
 <div class="input-group mb-3">

 <select name="type" id="type" class="form-control">
   <option value="">Payment Type</option> 
   <option value="COD" @isset($type) @if($type=="COD") selected @endif @endisset>COD</option> 
   <option value="PREPAID" @isset($type) @if($type=="PREPAID") selected @endif @endisset>PREPAID</option> 
 </select>

 <select name="status" class="form-control">
   <option value="">Choose Status</option> 
   <option value="PENDING" @isset($status) @if($status=="PENDING") selected @endif @endisset>PENDING</option> 
   <option value="DELIVERED" @isset($status) @if($status=="DELIVERED") selected @endif @endisset>DELIVERED</option>
   <option value="SHIPPED" @isset($status) @if($status=="SHIPPED") selected @endif @endisset>SHIPPED</option>
   <option value="CANCELLED" @isset($status) @if($status=="CANCELLED") selected @endif @endisset>CANCELLED</option>
   <option value="PAID" @isset($status) @if($status=="PAID") selected @endif @endisset>PAID</option>
   <option value="UNPAID" @isset($status) @if($status=="UNPAID") selected @endif @endisset>UNPAID</option> 
 </select>

 <input type="text" class="form-control @error('from') is-invalid @enderror" placeholder="Date From" name="from" @isset($from) value="{{$from}}" @endisset onClick="$(this).attr('type','date');">

 <input type="text" class="form-control @error('to') is-invalid @enderror" placeholder="Date To" name="to" @isset($to) value="{{$to}}" @endisset onClick="$(this).attr('type','date');">

 <input type="text" class="form-control @error('search_keyword') is-invalid @enderror" placeholder="Search" name="search_keyword" @isset($search_keyword) value="{{$search_keyword}}" @endisset>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  @if(isset($search_keyword) || isset($from) || isset($to) || isset($type) || isset($status))
     <a href="{{route('admin.order')}}" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    @endif
  @error('search_keyword')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    
 </form>
 
  </div>
  
  <div class="col-lg-1">
   <button type="button" class="btn btn-dark" onClick="exportOrder();">Export</button>      
  </div>
  
 </div> 


 </div>

</div>
</div>

@if($data->isNotEmpty())
<hr>
<form action="{{route('order.bottom.action')}}" method="GET" onSubmit="return checkboxValidation()">
 @csrf 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Order Info</th>
    <th scope="col">Amount</th>
    <th scope="col">User Info</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
@foreach($data as $row)
  <tr>
    <th scope="row"><input type="checkbox" name="ids[]" id="ids[]" class="ids" value="{{$row->id}}"> {{++$i}}</th>
    
    <td>
      <p> 
       ID: <a href="{{route('order.detail',$row->id)}}">#{{$row->id}}</a> <br>
       Type: {{$row->type}} - {{$row->sub_type}} <br>
     @if(!empty($row->gateway_order_id))
      Gateway Order ID: {{$row->gateway_order_id}} <br>
     @endif
     @if(!empty($row->gateway_payment_id))
      Transaction ID: {{$row->gateway_payment_id}} <br>
     @endif
     @if($row->coupon != '')
      Coupon: {{$row->coupon}} <br>
     @endif  
      Tracking No: {{$row->tracking_no}} 
      <a class="text-secondary" href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="updateTrackingNo('{{$row->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a>
     @if($row->user_id==0)
      <br/>
      <span class="badge bg-danger">GUEST</span> 
     @endif
    </p>
    </td>

    <td>
      <p> 
       Amount: {{setting()->currency.$row->amount}} <br>
      @if($row->discount) Discount: -{{setting()->currency.$row->discount}} <br>
      @endif
       Net Amount: {{setting()->currency.$row->net_amount}}
      </p>
    </td>
    
    <td>
      <p> 
       <i class="fas fa-user"></i>: {{$row->name}} <br>
       <i class="fas fa-envelope"></i>: {{$row->email}} <br>
       <i class="fas fa-phone"></i>: {{$row->mobile}}
      </p>
    </td>

    <td>
      <p> 
       Delivery Status: <span class="badge bg-primary">{{$row->delivery_status}}</span> <br>
       Payment Status: <span class="badge bg-dark text-white">{{$row->payment_status}}</span> <br>
      @if(!empty($row->cancel_note))  
       <b>Cancel Note: </b>{{$row->cancel_note}} <br>
       <b>Cancelled by: </b>{{$row->cancelled_by}}
      @endif
      </p>
    </td>

    <td> 
    @if(isInvoice($row->id)) 
    <a target="_blank" href="{{route('order.viewinvoice',$row->id)}}" data-bs-toggle="tooltip" title="View Invoice"><i class="icon nav-icon" data-feather="file-text"></i></a>
     &nbsp;&nbsp;  
    <a class="text-danger" href="{{route('order.removeinvoice',$row->id)}}" data-bs-toggle="tooltip" title="Remove Invoice" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="file-text"></i></a>
    @else
     <a href="{{route('order.generateinvoice',$row->id)}}" data-bs-toggle="tooltip" title="Generate Invoice" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="file"></i></a>
    @endif
    &nbsp;
  
  @if($row->delivery_status!="CANCELLED")  
    <a class="text-warning" data-bs-toggle="collapse" data-bs-target="#cancel{{$row->id}}" title="Cancel Order"><i class="icon nav-icon" data-feather="slash"></i></a>
    <div id="cancel{{$row->id}}" class="collapse">
     <h5>Cancel Note:</h5>   
     <input type="text" class="form-control mb-1" name="cancel_note" id="cancel_note{{$row->id}}" placeholder="Write cancel note" value="{{$row->cancel_note}}" maxlength="200">
     <button type="button" class="btn btn-danger btn-sm" onClick="cancelNoteSubmit('{{$row->id}}');">Cancel</button>
  </div>
  @endif
  &nbsp;
  @if(empty($row->tracking_no))
  <a class="text-info" href="javascript:void(0);" data-bs-toggle="tooltip" title="Shipping" onClick="shipping('{{$row->id}}');"><i class="icon nav-icon" data-feather="truck"></i></a>
  @endif
  
    <br>
    {{date('d-m-Y @ h:i A',strtotime($row->created_at))}}

    </td> 
  </tr>

@endforeach
</tbody>
</table>

<div class="card">
 <div class="card-footer">

 <input type="submit" name="req_for" value="PENDING" class="btn btn-outline-warning req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="DELIVERED" class="btn btn-outline-primary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="SHIPPED" class="btn btn-outline-success req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="PAID" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="UNPAID" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;

 @if(canDelete())  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm">
 @endif 

 <span class="badge bg-danger p-2 float-end" style="font-size:15px;">Order Total: {{setting()->currency.' '.$order_sum}}</span>

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
