<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit District</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
@csrf

@isset($edit)
 @method('PUT')
@endisset

<input type="hidden" name="id" value="{{$id}}" />
<input type="hidden" name="state_id" value="{{$state_id}}" />

<div class="modal-body">

<div class="col-lg-12">

<div class="row">
 <div class="col-lg-8">
 <input type="text" id="pincode" name="pincode" class="form-control" @if(isset($edit)) value="{{ $edit->pincode }}" @else value="{{ old('pincode') }}" @endif placeholder="Pincode">
 </div>
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createDistrict('{{$id}}');">
 @if($id==0) Add @else Update @endif District</button>
</div>
</div>
</div>
</form>
