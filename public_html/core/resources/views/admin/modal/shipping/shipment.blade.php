<div class="modal-header">
<h4 class="modal-title">Create Shipment with Shipway</h4>
 <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<form method="POST" action="{{route('order.shipment.create')}}">
@csrf    
<input type="hidden" name="order_id" value="{{$order_id}}">
<input type="hidden" name="weight" value="{{$weight}}">
<input type="hidden" name="length" value="{{$length}}">
<input type="hidden" name="breadth" value="{{$breadth}}">
<input type="hidden" name="height" value="{{$height}}">
<div class="row">
  @for($i=0; $i < COUNT($result['rate_card']); $i++)
 <div class="col-md-4 border"> 
 <input type="radio" value="{{$result['rate_card'][$i]['carrier_id']}}" name="courier_id" id="courier{{$i}}" /> <label for="courier{{$i}}"><b>{{$result['rate_card'][$i]['courier_name']}}</b></label>
  
  <p><b>Delivery Charges: </b> {{$result['rate_card'][$i]['delivery_charge']}} </p>
    
  <p><b>RTO Charges: </b> {{$result['rate_card'][$i]['rto_charge']}} </p>
    
  <p><b>Charged Weight: </b> {{$result['rate_card'][$i]['charged_weight']}} </p>
    
  <p><b>Zone: </b> {{$result['rate_card'][$i]['zone']}}</p>
    
   </div> 
  @endfor
</div>
<div class="row mt-2">
<div class="col-md-4">
  <button type="submit" class="btn btn-primary btn-sm" style="min-height: -webkit-fill-available;">Create</button>   
 </div>    
</div>
</div>
</form>
</div>