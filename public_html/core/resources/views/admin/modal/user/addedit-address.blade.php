<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Address</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>

<div class="modal-body">
<form method="post" onSubmit="event.preventDefault()" id="user-form">
@csrf

<input type="hidden" name="id" value="{{$id}}">

<input type="hidden" name="user_id" value="{{$user_id}}">

<div class="row">
<div class="col-lg-7">
<input type="text" id="name" name="name" class="form-control" @if(isset($edit)) value="{{ $edit->name }}" @endif placeholder="Your Name" onKeyup="$(this).text('');">
</div>

<div class="col-lg-5">
<input type="text" id="mobile" name="mobile" class="form-control" @if(isset($edit)) value="{{ $edit->mobile }}" @endif placeholder="Your Mobile no.">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-7">
<input type="text" id="email" name="email" class="form-control" @if(isset($edit)) value="{{ $edit->email }}" @endif placeholder="Your Email" onKeyup="$(this).text('');">
</div>

<div class="col-lg-5">
<input type="text" id="city" name="city" class="form-control" placeholder="Your City" @if(isset($edit)) value="{{ $edit->city }}" @endif onKeyup="$(this).text('');">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-12">
<input type="text" id="address" name="address" class="form-control" @if(isset($edit)) value="{{ $edit->address }}" @endif placeholder="Your Address" onKeyup="$(this).text('');">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-5">
<select name="country" id="country" class="selectpicker" data-live-search="true" onChange="getStates(this.value);">
 <option value="">Choose country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @isset($edit) @if($edit->country == $row->id) selected @endif @endisset>{{$row->name}}</option>
 @endforeach
</select>
</div>

<div class="col-lg-4">
<select name="state" id="state" class="form-control">
 <option value="">Choose state</option>
@isset($edit)
 @foreach(states($edit->country) as $row)
  <option value="{{$row->id}}" @if($edit->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
@endisset
</select>
</div>

<div class="col-lg-3">
<input type="text" id="pincode" name="pincode" class="form-control" @if(isset($edit)) value="{{ $edit->pincode }}" @else value="{{ old('pincode') }}" @endif placeholder="Pincode" onKeyup="$(this).text('');">
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createUserAddress('{{$type}}');">
 @if($id==0) Add @else Update @endif Address</button>
</div>
</div>
</form>
</div>