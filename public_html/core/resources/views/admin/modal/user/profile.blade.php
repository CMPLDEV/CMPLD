<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="POST" id="user-form" action="{{route('update-profile')}}" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="modal-body">

<div class="row">

<div class="col-lg-12">
<input type="text" id="name" name="name" placeholder="Your Name" class="form-control" value="{{ $profile->name }}">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-6">
<input type="file" id="pic" name="pic" class="form-control">
</div>


<div class="col-lg-6">
 <img @if(!empty($profile->pic)) src="{{asset('uploads/profile/'.$profile->pic)}}" @else src="{{asset('admin_assets/img/user.png')}}" @endif alt="{{ $profile->name }}" class="rounded-circle" width="100">   
 <a class="text-danger" href="{{route('remove-pic')}}">Remove</a>
</div>

</div>

<div class="modal-footer mt-3">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit" id="edit-btn">Update Profile</button>
</div>
</div>
</div>
</form>
