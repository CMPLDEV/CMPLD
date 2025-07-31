<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Slider</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
@csrf

<input type="hidden" name="id" value="{{$id}}" />

<div class="modal-body">

<div class="row">

<div class="col-lg-6">
 @isset($edit)
  <img src="{{asset(showImage($edit->image,'uploaded_files/slider'))}}" alt="image" width="100%">
 @else 
  <img src="{{asset(noBanner())}}" alt="image" width="100%" class="img-thumbnail">   
 @endisset 
 <br><br>
 <input type="file" name="image" id="image" class="form-control">  
 
</div>

<div class="col-lg-6">

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="title" name="title" class="form-control" @if(isset($edit)) value="{{ $edit->title }}" @else value="{{ old('title') }}" @endif placeholder="Title" onKeyup="$(this).text('');">
 </div>
 
 <div class="col-lg-12 mt-4">
 <input type="text" id="link" name="link" class="form-control" @if(isset($edit)) value="{{ $edit->link }}" @else value="{{ old('link') }}" @endif placeholder="Link" onKeyup="$(this).text('');">
 </div>
 
</div>

<br>
<textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Description">@isset($edit){{$edit->description}}@endisset</textarea>

</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createSlider('{{$id}}');">
 @if($id==0) Add @else Update @endif Slider</button>
</div>
</div>
</div>
</form>
