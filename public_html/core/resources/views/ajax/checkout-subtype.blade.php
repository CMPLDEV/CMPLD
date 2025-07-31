@if($sub_type == "GATEWAY")

<div class="row">
<div class="col-lg-6">
<div class="container">
<div class="pay pay-active">
<label>
<input type="radio" name="payment_gateway" value="Razorpay" class="payment_gateway" id="razorpay" checked>
<span> <img src="assets/img/razorpay.png" alt="Razorpay" style="width: 60%;
    margin: -40px;padding: 10px;" / > </span>
</label>
</div>
</div>   
</div>
<div class="col-lg-6">
<div class="container">
<div class="pay pay-active">
<label>
<input type="radio" name="payment_gateway" value="Payumony" class="payment_gateway" id="payu">
<span> <img src="assets/img/payu.png" alt="Payumoney" style="width: 60%;
    margin: -40px;padding: 10px;" /> </span>
</label>
</div>
</div>   
</div>
</div>

@elseif($sub_type == "UPI")

<img src="assets/img/qr-code.jpg" class="mt-3 d-block m-auto" width="250" />
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="form-control mt-3" />

@else

<div class="row mt-2 dbt">
<div class="col-lg-12">
<span> <strong>Acc Name:</strong> Computronics Multivision Private Limited.</span>
</div>
<div class="col-lg-12">
<span><strong>Director:</strong> Manish Vithalani.</span>
</div>
<div class="col-lg-12"><span> <strong>Acc No:</strong> 50200031357661.</span>
</div>
<div class="col-lg-12"><span> <strong>IFSC Code:</strong> HDFC0000288.</span>
</div>
</div>
<input type="text" name="transaction_id" placeholder="Enter Transaction ID" class="form-control mt-3" />

@endif