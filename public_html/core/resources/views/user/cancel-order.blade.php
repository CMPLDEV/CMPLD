<div class="modal-header order-header">
<h4 class="modal-title">#{{$order->id}} Cancel</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">
 <h2 style="font-size: 15px !important;">Write A Cancel Note</h2>
 <form method="POST" action="{{route('userpanel.order.cancel')}}">
@csrf    
<input type="hidden" name="id" value="{{$order->id}}">
<textarea type="text" class="form-control mb-1 @error('cancel_note') is-invalid @enderror" name="cancel_note" placeholder="Write your reason here" rows="3">{{$order->cancel_note}}</textarea>
<button type="submit" class="btn update-btn">Cancel</button>
</form>

</div>