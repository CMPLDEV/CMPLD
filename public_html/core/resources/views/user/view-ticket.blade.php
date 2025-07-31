<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">View Ticket History </h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="ajax-form" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{$data->id}}" />

<div class="modal-body">

<div class="row">
 <div class="col-lg-12">
 <label><b>Status : </b></label>
 <span class="{{ticketStatusColor($data->status)}}">{{$data->status}}</span>
 </div> 
</div>

<div class="row">
 <div class="col-lg-12">
 <label><b>Subject : </b></label>
 {{$data->subject}}.
 </div> 
</div>

<div class="row">
 <div class="col-lg-6">
 <label><b>CONTRACT No : </b></label>
 {{$data->contract_no}}
 </div>
</div>

<div class="row mt-2">
 <div class="col-lg-12">
 <label><b>Description : </b></label>
 {{$data->content}}
 </div> 
</div>

<div class="row mt-2">
 <div class="col-lg-12">
 <label><b>Product : </b></label>
 {{$warranty->product_name}}
 </div> 
</div>

@if(!empty($data->attachment))
<div class="row mt-2">
 <div class="col-lg-12">
 <label><b><a href="uploaded_files/ticket/{{$data->attachment}}" target="_blank"> <i class="fa fa-paperclip"></i> View Attachment </a> </b></label>
 </div> 
</div>
@endif

@if($data->status == "RESOLVED")
<div class="row mt-2">
 <div class="col-lg-12">
 <a href="{{route('userpanel.ticket.close',$data->id)}}" class="btn btn-outline-danger" id="ticket-close" title="Click here if, the issue is resolved." onClick="confirmation(event,'This action will change the status to close.','ticket-close');">Close this ticket</a>
 </div> 
</div>
@endif

<hr>

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
&nbsp; <a href="uploaded_files/ticket/{{$row->attachment}}" target="_blank" title="View Attachment"><i class="fa fa-paperclip"></i></a>
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
</form>
