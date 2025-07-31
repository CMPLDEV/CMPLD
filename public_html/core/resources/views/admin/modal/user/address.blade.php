<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">{{$user->name}}'s Address List</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>

<div class="card">

<div class="container mt-2">
 <div class="row">
  <div class="col-lg-12">
   <button type="button" class="btn btn-dark btn-sm float-end" onClick="userAddAddressModal('{{$user->id}}','add');">Add new</button> 
  </div>   
 </div>   
</div>

@if($data->isNotEmpty())    
<table class="table table-bordered">
<thead>
   <tr>
   <th>S.No</th> 
   <th>Name</th>
   <th>Email</th>
   <th>Mobile</th>
   <th>Address</th>
   <th>Action</th>
   </tr>
 </thead>
 <tbody>
  @foreach($data as $row) 
    <tr>
    <td>{{$i++}}.</td>  
    <td>{{$row->name}}</td>
    <td>{{$row->email}}</td>
    <td>{{$row->mobile}}</td>
    <td>
     {{$row->address}} {{$row->city}}, {{state($row->state)}} {{country($row->country)}} - {{$row->pincode}}    
    </td>
    <td>
     <a href="javascript:void(0);" class="btn btn-info" title="Edit" onClick="userAddAddressModal('{{$row->id}}','update','{{$user->id}}');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
     <a href="{{route('user.address.remove',$row->id)}}" class="btn btn-danger" title="Delete" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="delete"></i></a>   
    </td>
    </tr>
  @endforeach
</tbody>
</table>  
@else
 <div class="p-2">
 <h4>No Record Found.</h4> 
 </div>
@endif
</div>
