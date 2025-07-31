@extends('admin.layouts.app')
@section('title','Ticket Detail')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Ticket Detail</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Ticket Detail</li>
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
  
  </div>

  <div class="col-lg-7">

  </div>
 </div> 


 </div>
 <div class="col-lg-3">
 <a href="{{route('ticket')}}" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Back"> <i class="ri-arrow-left-double-line"></i> Back</a> 
</div> 
</div>
</div>

<style>
.tabc{font-family: sans-serif;padding: 5px 10px;border-bottom: 1px solid lightgray;border-left: 1px solid lightgray;}
.tabc span{color:#eb4924;}
.bg-white{background-color:#fff;padding:20px;}
</style>
<div class="container-fluid mt-3">
 
<h4 style="background-color: #eb4924;padding: 10px;font-family: sans-serif;
        color: #fff;"> # {{$ticket->id}} Complaint Box</h4>
<div class="bg-white">
<div class="row">
<div class="col-lg-9">
<div class="row">
<div class="col-lg-3 tabc" style="border-top: 1px solid lightgray;">
<span> Complaint</span> - {{$ticket->name}}
</div>
<div class="col-lg-3 tabc" style="border-top: 1px solid lightgray;">
<span> Contact No.</span> - {{$ticket->mobile}}
</div>
<div class="col-lg-6 tabc" style="border-top: 1px solid lightgray;">
<span> Email address</span> - {{$ticket->email}}
</div>

<div class="col-lg-4 tabc">
<span> Subject</span> - {{$ticket->subject}}
</div>

<div class="col-lg-8 tabc">
<span> Product</span> - @if(!empty($warranty)) {{$warranty->product_name}} @else N/A @endif
</div>

<div class="col-lg-9 tabc">
<span> Message</span> - {{$ticket->content}}
</div>

<div class="col-lg-3 tabc">
<span> Status</span> - <span class="{{ticketStatusColor($ticket->status)}} fw-bold">{{$ticket->status}}</span>
</div>

@if(!empty($ticket->attachment))
<div class="col-lg-12 tabc">
<span> Attachment</span> - <a href="uploaded_files/ticket/{{$ticket->attachment}}" target="_blank">View <i class="fa fa-paperclip"></i> </a>
</div>
@endif
</div>            
</div>
<div class="col-lg-3 tabc" >
<h4>Update Your Comments</h4> <br>
<form method="POST" action="{{route('ticket.update.comment')}}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="ticket_id" value="{{$ticket->id}}" />

<span>Status</span>
<select class="form-control" name="status">
 <option value="OPEN" @isset($ticket) @if($ticket->status == "OPEN") selected @endif @endisset>OPEN</option>
 <option value="WORK IN PROGRESS" @isset($ticket) @if($ticket->status == "WORK IN PROGRESS") selected @endif @endisset>WORK IN PROGRESS</option>
 <option value="SUSPENDED" @isset($ticket) @if($ticket->status == "SUSPENDED") selected @endif @endisset>SUSPENDED</option>
 <option value="WAITING FOR USER" @isset($ticket) @if($ticket->status == "WAITING FOR USER") selected @endif @endisset>WAITING FOR USER</option>
 <option value="RESOLVED" @isset($ticket) @if($ticket->status == "RESOLVED") selected @endif @endisset>RESOLVED</option>
</select>
<br>
<span> Upload attachment </span> 
<input type="file" class="form-control" name="attachment" /> <br>

<textarea type="text" placeholder="Your Comment" rows="3" class="form-control @error('message') is-invalid @enderror" name="message"></textarea> <br>
@error('message') <span class="invalid-feedback">{{$message}}</span> @enderror
<button type="submit" class="btn btn-primary" style="width: 100%;background-color: #1b3480;border: none;">Update Comment</button>  
</form>

</div>
</div>
</div>

<div class="row">
 <div class="col-lg-12">       
@if($comments->isNotEmpty())
<div id="accordion">
<div class="card">
<a class="card-link" data-bs-toggle="collapse" data-bs-target="#collapseComment" onclick="">
<div class="card-header bg-info">
<strong class="text-white"><i class="fas fa-comments"></i> &nbsp; Show Comment History</strong>
</div>
</a>
<div id="collapseComment" class="collapse" data-parent="#accordion">
<div class="card-body">

<div class="row">

<div class="col-lg-12">

<table class="table table-striped">
<tbody>
@foreach($comments as $row)
<tr><td><strong>Date & Time &nbsp;<i class="fa fa-angle-double-right"></i>&nbsp;</strong> 
{{date('d-m-Y',strtotime($row->created_at))}} | {{date('h:i:s a',strtotime($row->created_at))}}</td>
<td>{{$row->status}}</td>
</tr>
<tr><td colspan="2">{{$row->message}} 
@if(!empty($row->attachment))
<a href="uploaded_files/ticket/{{$row->attachment}}" title="View Attachment" target="_blank"><i class="fa fa-paperclip"></i></a>
@endif
&nbsp;<small class="text-secondary"> <i class="fas fa-user"></i> Admin </small>
</td>
</tr>
@endforeach
</tbody>
</table>

</div>

</div> 

</div>
</div>
</div>
</div>
@endif
</div>
</div>

</div>

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

@endsection
