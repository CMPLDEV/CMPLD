<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Sub Admin</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form">
@csrf

<input type="hidden" name="id" value="{{$id}}" />

<div class="modal-body">

<div class="row">
<div class="col-lg-6">
<input type="text" id="name" name="name" class="form-control" @if(isset($edit)) value="{{ $edit->name }}" @else value="{{ old('name') }}" @endif placeholder="Your Name" onKeyup="$(this).text('');">
</div>

<div class="col-lg-6">
<input type="text" id="email" name="email" class="form-control" @if(isset($edit)) value="{{ $edit->email }}" @else value="{{ old('email') }}" @endif placeholder="Your Email" onKeyup="$(this).text('');">
</div>

</div>

<div class="row mt-3">
<div class="col-lg-6">
<input type="text" id="mobile" name="mobile" class="form-control" @if(isset($edit)) value="{{ $edit->mobile }}" @else value="{{ old('mobile') }}" @endif placeholder="Your Mobile no.">
</div>
@if(!isset($edit))
<div class="col-lg-6">
<input type="password" id="password" name="password" class="form-control" @if(isset($edit)) value="{{ $edit->password }}" @else value="{{ old('password') }}" @endif placeholder="Your Password">
</div>
@endif
</div>

<div class="row mt-3">
<div class="col-lg-4">
<select name="type" id="type" class="form-control">
@if($flag == 1)
<option value="ADMIN">Admin</option>
@endif
<option value="SUB_ADMIN">Sub Admin</option>
</select>
</div>

<div class="col-lg-8">
@if(Auth::user()->type=="SUPER_ADMIN")
<select name="roles[]" id="roles" class="selectpicker" multiple data-live-search="true" >

  <option value="1" @if(isset($roles)) @if(in_array('1',$roles)) selected @endif @endif >Settings</option>
  <option value="2" @if(isset($roles)) @if(in_array('2',$roles)) selected @endif @endif >Manage Sub Admin</option>
  <option value="3" @if(isset($roles)) @if(in_array('3',$roles)) selected @endif @endif >Change Password</option>
  <option value="4" @if(isset($roles)) @if(in_array('4',$roles)) selected @endif @endif >Manage User</option>
  <option value="5" @if(isset($roles)) @if(in_array('5',$roles)) selected @endif @endif >Manage Category</option>
  <option value="6" @if(isset($roles)) @if(in_array('6',$roles)) selected @endif @endif >Manage Product</option>
  <option value="7" @if(isset($roles)) @if(in_array('7',$roles)) selected @endif @endif >Manage Pages</option>
  <option value="8" @if(isset($roles)) @if(in_array('8',$roles)) selected @endif @endif >Manage Slider</option>
  <option value="9" @if(isset($roles)) @if(in_array('9',$roles)) selected @endif @endif >Manage Blog</option>
  <option value="10" @if(isset($roles)) @if(in_array('10',$roles)) selected @endif @endif >Manage Marketplace</option>
  <option value="11" @if(isset($roles)) @if(in_array('11',$roles)) selected @endif @endif >Product SEO</option>
  <option value="12" @if(isset($roles)) @if(in_array('12',$roles)) selected @endif @endif >Manage Enquiry</option>
  <option value="13" @if(isset($roles)) @if(in_array('13',$roles)) selected @endif @endif >Manage Coupon</option>
  <option value="14" @if(isset($roles)) @if(in_array('14',$roles)) selected @endif @endif >Manage Order</option>
  <option value="15" @if(isset($roles)) @if(in_array('15',$roles)) selected @endif @endif >Manage Newsletter</option>
  <option value="16" @if(isset($roles)) @if(in_array('16',$roles)) selected @endif @endif >Advance Setting</option>
  <option value="17" @if(isset($roles)) @if(in_array('17',$roles)) selected @endif @endif >Manage Gallery</option>
  <option value="18" @if(isset($roles)) @if(in_array('18',$roles)) selected @endif @endif >Ticket History</option>
  <option value="19" @if(isset($roles)) @if(in_array('19',$roles)) selected @endif @endif >Identify Product</option>
  <option value="20" @if(isset($roles)) @if(in_array('20',$roles)) selected @endif @endif >Product Negotiation</option>
  <option value="21" @if(isset($roles)) @if(in_array('21',$roles)) selected @endif @endif >Our Client</option>
  <option value="22" @if(isset($roles)) @if(in_array('22',$roles)) selected @endif @endif >Our Partner</option>
  <option value="23" @if(isset($roles)) @if(in_array('23',$roles)) selected @endif @endif >Manage Offer</option>
  <option value="24" @if(isset($roles)) @if(in_array('24',$roles)) selected @endif @endif >Product Review</option>
  <option value="25" @if(isset($roles)) @if(in_array('25',$roles)) selected @endif @endif >Location Pincode</option>
  <option value="26" @if(isset($roles)) @if(in_array('26',$roles)) selected @endif @endif >Manage Testimonial</option>
  <option value="27" @if(isset($roles)) @if(in_array('27',$roles)) selected @endif @endif >Return & Refund</option>
  <option value="28" @if(isset($roles)) @if(in_array('28',$roles)) selected @endif @endif >Our Associates</option>
  <option value="29" @if(isset($roles)) @if(in_array('29',$roles)) selected @endif @endif >Manage Showcase</option>
  <option value="30" @if(isset($roles)) @if(in_array('30',$roles)) selected @endif @endif >Manage FAQ</option>
  <option value="31" @if(isset($roles)) @if(in_array('31',$roles)) selected @endif @endif >Log History</option>
  <option value="32" @if(isset($roles)) @if(in_array('32',$roles)) selected @endif @endif >Certificates</option>
</select>

@else

<select name="roles[]" id="roles" class="selectpicker" multiple data-live-search="true" >
 
@if(in_array('1', $login_user_roles))
  <option value="1" @if(isset($roles)) @if(in_array('1',$roles)) selected @endif @endif >Settings</option>
@endif
@if(in_array('2', $login_user_roles))
  <option value="2" @if(isset($roles)) @if(in_array('2',$roles)) selected @endif @endif >Manage Sub Admin</option>
@endif
@if(in_array('3', $login_user_roles))
  <option value="3" @if(isset($roles)) @if(in_array('3',$roles)) selected @endif @endif >Change Password</option>
@endif
@if(in_array('4', $login_user_roles))
  <option value="4" @if(isset($roles)) @if(in_array('4',$roles)) selected @endif @endif >Manage User</option>
@endif
@if(in_array('5', $login_user_roles))
  <option value="5" @if(isset($roles)) @if(in_array('5',$roles)) selected @endif @endif >Manage Category</option>
@endif
@if(in_array('6', $login_user_roles))
  <option value="6" @if(isset($roles)) @if(in_array('6',$roles)) selected @endif @endif >Manage Product</option>
@endif
@if(in_array('7', $login_user_roles))
  <option value="7" @if(isset($roles)) @if(in_array('7',$roles)) selected @endif @endif >Manage Pages</option>
@endif
@if(in_array('8', $login_user_roles))
  <option value="8" @if(isset($roles)) @if(in_array('8',$roles)) selected @endif @endif >Manage Slider</option>
@endif
@if(in_array('9', $login_user_roles))
  <option value="9" @if(isset($roles)) @if(in_array('9',$roles)) selected @endif @endif >Manage Blog</option>
@endif
@if(in_array('10', $login_user_roles))
  <option value="10" @if(isset($roles)) @if(in_array('10',$roles)) selected @endif @endif >Manage Marketplace</option>
@endif
@if(in_array('11', $login_user_roles))
  <option value="11" @if(isset($roles)) @if(in_array('11',$roles)) selected @endif @endif >Product SEO</option>
@endif
@if(in_array('12', $login_user_roles))
  <option value="12" @if(isset($roles)) @if(in_array('12',$roles)) selected @endif @endif >Manage Enquiry</option>
@endif
@if(in_array('13', $login_user_roles))
  <option value="13" @if(isset($roles)) @if(in_array('13',$roles)) selected @endif @endif >Manage Coupon</option>
@endif
@if(in_array('14', $login_user_roles))
  <option value="14" @if(isset($roles)) @if(in_array('14',$roles)) selected @endif @endif >Manage Order</option>
@endif
@if(in_array('15', $login_user_roles))
  <option value="15" @if(isset($roles)) @if(in_array('15',$roles)) selected @endif @endif >Manage Newsletter</option>
@endif
@if(in_array('16', $login_user_roles))
  <option value="16" @if(isset($roles)) @if(in_array('16',$roles)) selected @endif @endif >Advance Setting</option>
@endif
@if(in_array('17', $login_user_roles))
  <option value="17" @if(isset($roles)) @if(in_array('17',$roles)) selected @endif @endif >Manage Gallery</option>
@endif
@if(in_array('18', $login_user_roles))
  <option value="18" @if(isset($roles)) @if(in_array('18',$roles)) selected @endif @endif >Ticket History</option>
@endif
@if(in_array('19', $login_user_roles))
  <option value="19" @if(isset($roles)) @if(in_array('19',$roles)) selected @endif @endif >Identify Product</option>
@endif
@if(in_array('20', $login_user_roles))
  <option value="20" @if(isset($roles)) @if(in_array('20',$roles)) selected @endif @endif >Product Negotiation</option>
@endif
@if(in_array('20', $login_user_roles))
  <option value="20" @if(isset($roles)) @if(in_array('20',$roles)) selected @endif @endif >Product Negotiation</option>
@endif
@if(in_array('21', $login_user_roles))
  <option value="21" @if(isset($roles)) @if(in_array('21',$roles)) selected @endif @endif >Our Client</option>
@endif
@if(in_array('22', $login_user_roles))
  <option value="22" @if(isset($roles)) @if(in_array('22',$roles)) selected @endif @endif >Our Partner</option>
@endif
@if(in_array('23', $login_user_roles))
  <option value="23" @if(isset($roles)) @if(in_array('23',$roles)) selected @endif @endif >Manage Offer</option>
@endif
@if(in_array('24', $login_user_roles))
  <option value="24" @if(isset($roles)) @if(in_array('24',$roles)) selected @endif @endif >Product Review</option>
@endif
@if(in_array('25', $login_user_roles))
  <option value="25" @if(isset($roles)) @if(in_array('25',$roles)) selected @endif @endif >Location Pincodes</option>
@endif
@if(in_array('26', $login_user_roles))
  <option value="26" @if(isset($roles)) @if(in_array('26',$roles)) selected @endif @endif >Manage Testimonial</option>
@endif
@if(in_array('27', $login_user_roles))
  <option value="27" @if(isset($roles)) @if(in_array('27',$roles)) selected @endif @endif >Return & Refund</option>
@endif
@if(in_array('28', $login_user_roles))
  <option value="28" @if(isset($roles)) @if(in_array('28',$roles)) selected @endif @endif >Our Associates</option>
@endif
@if(in_array('29', $login_user_roles))
  <option value="29" @if(isset($roles)) @if(in_array('29',$roles)) selected @endif @endif >Manage Showcase</option>
@endif
@if(in_array('30', $login_user_roles))
  <option value="30" @if(isset($roles)) @if(in_array('30',$roles)) selected @endif @endif >Manage FAQ</option>
@endif
@if(in_array('31', $login_user_roles))
  <option value="31" @if(isset($roles)) @if(in_array('31',$roles)) selected @endif @endif >Log History</option>
@endif
@if(in_array('32', $login_user_roles))
  <option value="32" @if(isset($roles)) @if(in_array('32',$roles)) selected @endif @endif >Certificates</option>
@endif

 </select>

@endif
</div>

</div>

<div class="row mt-3">
<div class="col-lg-6">
<input type="checkbox" id="can_delete" name="can_delete" @isset($edit) @if($edit->can_delete==1) checked @endif @endisset> <label for="can_delete">Sub Admin can delete data?</label>
</div>
</div>

<div class="row mt-2">
<div class="col-lg-6">
 <label>Category</label>    
 <select class="selectpicker" name="category_ids[]" data-live-search="true" multiple>
  @foreach(adminCategories() as $row)
   <option value="{{$row->id}}" @isset($edit) @if(in_array($row->id, explode(',',$edit->category_ids))) selected @endif @endisset>{{$row->name}}</option>
   @foreach(adminCategories($row->id) as $row)
    <option value="{{$row->id}}" @isset($edit) @if(in_array($row->id, explode(',',$edit->category_ids))) selected @endif @endisset> &nbsp; -{{$row->name}}</option>
    @foreach(adminCategories($row->id) as $row)
     <option value="{{$row->id}}" @isset($edit) @if(in_array($row->id, explode(',',$edit->category_ids))) selected @endif @endisset> &nbsp;&nbsp; --{{$row->name}}</option>
    @endforeach
   @endforeach
  @endforeach
 </select>    
</div>

<div class="col-lg-6">
 <label>Brand</label>    
 <select class="selectpicker" name="brand_ids[]" data-live-search="true" multiple>
  @foreach(adminBrands() as $row)
   <option value="{{$row->id}}" @isset($edit) @if(in_array($row->id, explode(',',$edit->brand_ids))) selected @endif @endisset>{{$row->name}}</option>
  @endforeach
 </select>    
</div>
</div>

<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createSubadmin('{{$id}}');">
 @if($id==0) Add @else Update @endif Data</button>
</div>
</div>
</div>
</form>
