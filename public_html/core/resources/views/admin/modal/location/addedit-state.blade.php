<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit State</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
@csrf

@isset($edit)
 @method('PUT')
@endisset

<input type="hidden" name="id" value="{{$id}}" />

<div class="modal-body">

<div class="col-lg-12">

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="name" name="name" class="form-control" @if(isset($edit)) value="{{ $edit->name }}" @else value="{{ old('name') }}" @endif placeholder="Name">
 </div> 
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createState('{{$id}}');">
 @if($id==0) Add @else Update @endif State</button>
</div>
</div>
</div>
</form>
