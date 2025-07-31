<div class="modal-header">
<h4 class="modal-title">Order Dimension</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
<form method="post" id="user-form" action="{{route('order.shipment.create')}}" @if($order->is_shipway) onSubmit="return confirm('Do you really want to update?');" @endif>
@csrf

<div class="row">
 <div class="col-lg-3">
   <label>Order ID</label>     
   <input type="text" readonly class="form-control" name="order_id" id="order_id" value="{{$order->id}}" />  
 </div>
 <div class="col-lg-4">
   <label>Payment Type</label>       
   <input type="text" readonly class="form-control" name="payment_mode" id="payment_mode" value="{{$payment_type}}" />  
 </div>
 <div class="col-lg-5">
   <label>E-waybill <i class="fas fa-info-circle" title="Please provide E-waybill. It is mandatory for shipments with amount greater than Rs.50,000"></i></label>       
   <input type="text" class="form-control" name="ewaybill" id="ewaybill" />  
 </div>
</div>

<div class="row mt-3">
 <div class="col-lg-4">
   <label>Origin</label>     
   <input type="text" readonly class="form-control" name="pickup_postcode" id="pickup_postcode" value="{{$origin}}" />  
 </div>
 <div class="col-lg-4">
   <label>Destination</label>     
   <input type="text" readonly class="form-control" name="delivery_postcode" id="delivery_postcode" value="{{$destination}}" />  
 </div>
 <div class="col-lg-4">
   <label>Amount</label>     
   <input type="text" readonly class="form-control" name="order_amount" id="order_amount" value="{{$order_amount}}" />  
 </div>
</div>

<div class="row mt-3">
 <div class="col-lg-3">
   <label>Weight</label>     
   <input type="number" min="1" class="form-control" name="weight" id="weight" value="{{$weight}}" required/> 
 </div>
 <div class="col-lg-3">
   <label>Length</label>       
   <input type="text" class="form-control" name="length" id="length" value="{{$length}}" required/> 
 </div>
 <div class="col-lg-3">
   <label>Breadth</label>     
   <input type="text" class="form-control" name="breadth" id="breadth" value="{{$breadth}}" required/> 
 </div>
 <div class="col-lg-3">
   <label>Height</label>       
   <input type="text" class="form-control" name="height" id="height" value="{{$height}}" required/> 
 </div>
</div>

<div class="row mt-3">
 <div class="col-lg-6">
  <button type="submit" class="btn btn-primary btn-sm user-submit">@if($order->is_shipway) Update @else Create @endif Shipment</button>
 </div> 
</div>
</form>
</div>