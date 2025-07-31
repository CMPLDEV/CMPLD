<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Marketplace</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{$id}}" />

<div class="modal-body">

<div class="col-lg-12">

<div class="row">
 <div class="col-lg-7">
 <input type="text" id="name" name="name" class="form-control" @if(isset($edit)) value="{{ $edit->name }}" @else value="{{ old('name') }}" @endif placeholder="Title" onKeyup="$(this).text('');">
 </div> 
 <div class="col-lg-5">
  <select class="form-control" name="parent_id" id="parent_id">
   <option value="">Parent category</option> 
   <option value="0" @isset($edit) @if($edit->parent_id == 0) selected @endif @endisset>Nothing</option>
   @foreach(marketplaces() as $row)
    <option value="{{$row->id}}" @isset($edit) @if($edit->parent_id == $row->id) selected @endif @endisset> {{$row->name}}</option>
   @endforeach
  </select>  
 </div>  
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createMarketplace('{{$id}}');">
 @if($id==0) Add @else Update @endif Location</button>
</div>
</div>
</div>
</form>
