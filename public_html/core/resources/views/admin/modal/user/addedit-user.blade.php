<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit User</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>

<div class="modal-body">
<form method="post" onSubmit="event.preventDefault()" id="user-form">
@csrf

<input type="hidden" name="id" value="{{$id}}" />

<div class="row">
<div class="col-lg-7">
<input type="text" id="name" name="name" class="form-control" @if(isset($edit)) value="{{ $edit->name }}" @else value="{{ old('name') }}" @endif placeholder="Your Name" onKeyup="$(this).text('');">
</div>

<div class="col-lg-5">
<input type="text" id="mobile" name="mobile" class="form-control" @if(isset($edit)) value="{{ $edit->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="Your Mobile no.">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-8">
<input type="text" id="email" name="email" class="form-control" @if(isset($edit)) value="{{ $edit->email }}" @else value="{{ old('email') }}" @endif placeholder="Your Email" onKeyup="$(this).text('');">
</div>

<div class="col-lg-4">
<input type="password" id="password" name="password" class="form-control" placeholder="Your Password">
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createUser('{{$id}}');">
 @if($id==0) Add @else Update @endif User</button>
</div>
</div>
</form>
</div>