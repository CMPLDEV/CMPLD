<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Sub Admin</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />

<div class="modal-body">

<div class="row">
<div class="col-lg-6">
<input type="text" id="name" name="name" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> placeholder="Your Name" onKeyup="$(this).text('');">
</div>

<div class="col-lg-6">
<input type="text" id="email" name="email" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->email); ?>" <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?> placeholder="Your Email" onKeyup="$(this).text('');">
</div>

</div>

<div class="row mt-3">
<div class="col-lg-6">
<input type="text" id="mobile" name="mobile" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->mobile); ?>" <?php else: ?> value="<?php echo e(old('mobile')); ?>" <?php endif; ?> placeholder="Your Mobile no.">
</div>
<?php if(!isset($edit)): ?>
<div class="col-lg-6">
<input type="password" id="password" name="password" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->password); ?>" <?php else: ?> value="<?php echo e(old('password')); ?>" <?php endif; ?> placeholder="Your Password">
</div>
<?php endif; ?>
</div>

<div class="row mt-3">
<div class="col-lg-4">
<select name="type" id="type" class="form-control">
<?php if($flag == 1): ?>
<option value="ADMIN">Admin</option>
<?php endif; ?>
<option value="SUB_ADMIN">Sub Admin</option>
</select>
</div>

<div class="col-lg-8">
<?php if(Auth::user()->type=="SUPER_ADMIN"): ?>
<select name="roles[]" id="roles" class="selectpicker" multiple data-live-search="true" >

  <option value="1" <?php if(isset($roles)): ?> <?php if(in_array('1',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Settings</option>
  <option value="2" <?php if(isset($roles)): ?> <?php if(in_array('2',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Sub Admin</option>
  <option value="3" <?php if(isset($roles)): ?> <?php if(in_array('3',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Change Password</option>
  <option value="4" <?php if(isset($roles)): ?> <?php if(in_array('4',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage User</option>
  <option value="5" <?php if(isset($roles)): ?> <?php if(in_array('5',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Category</option>
  <option value="6" <?php if(isset($roles)): ?> <?php if(in_array('6',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Product</option>
  <option value="7" <?php if(isset($roles)): ?> <?php if(in_array('7',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Pages</option>
  <option value="8" <?php if(isset($roles)): ?> <?php if(in_array('8',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Slider</option>
  <option value="9" <?php if(isset($roles)): ?> <?php if(in_array('9',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Blog</option>
  <option value="10" <?php if(isset($roles)): ?> <?php if(in_array('10',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Marketplace</option>
  <option value="11" <?php if(isset($roles)): ?> <?php if(in_array('11',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product SEO</option>
  <option value="12" <?php if(isset($roles)): ?> <?php if(in_array('12',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Enquiry</option>
  <option value="13" <?php if(isset($roles)): ?> <?php if(in_array('13',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Coupon</option>
  <option value="14" <?php if(isset($roles)): ?> <?php if(in_array('14',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Order</option>
  <option value="15" <?php if(isset($roles)): ?> <?php if(in_array('15',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Newsletter</option>
  <option value="16" <?php if(isset($roles)): ?> <?php if(in_array('16',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Advance Setting</option>
  <option value="17" <?php if(isset($roles)): ?> <?php if(in_array('17',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Gallery</option>
  <option value="18" <?php if(isset($roles)): ?> <?php if(in_array('18',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Ticket History</option>
  <option value="19" <?php if(isset($roles)): ?> <?php if(in_array('19',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Identify Product</option>
  <option value="20" <?php if(isset($roles)): ?> <?php if(in_array('20',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Negotiation</option>
  <option value="21" <?php if(isset($roles)): ?> <?php if(in_array('21',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Client</option>
  <option value="22" <?php if(isset($roles)): ?> <?php if(in_array('22',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Partner</option>
  <option value="23" <?php if(isset($roles)): ?> <?php if(in_array('23',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Offer</option>
  <option value="24" <?php if(isset($roles)): ?> <?php if(in_array('24',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Review</option>
  <option value="25" <?php if(isset($roles)): ?> <?php if(in_array('25',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Location Pincode</option>
  <option value="26" <?php if(isset($roles)): ?> <?php if(in_array('26',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Testimonial</option>
  <option value="27" <?php if(isset($roles)): ?> <?php if(in_array('27',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Return & Refund</option>
  <option value="28" <?php if(isset($roles)): ?> <?php if(in_array('28',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Associates</option>
  <option value="29" <?php if(isset($roles)): ?> <?php if(in_array('29',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Showcase</option>
  <option value="30" <?php if(isset($roles)): ?> <?php if(in_array('30',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage FAQ</option>
  <option value="31" <?php if(isset($roles)): ?> <?php if(in_array('31',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Log History</option>
  <option value="32" <?php if(isset($roles)): ?> <?php if(in_array('32',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Certificates</option>
</select>

<?php else: ?>

<select name="roles[]" id="roles" class="selectpicker" multiple data-live-search="true" >
 
<?php if(in_array('1', $login_user_roles)): ?>
  <option value="1" <?php if(isset($roles)): ?> <?php if(in_array('1',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Settings</option>
<?php endif; ?>
<?php if(in_array('2', $login_user_roles)): ?>
  <option value="2" <?php if(isset($roles)): ?> <?php if(in_array('2',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Sub Admin</option>
<?php endif; ?>
<?php if(in_array('3', $login_user_roles)): ?>
  <option value="3" <?php if(isset($roles)): ?> <?php if(in_array('3',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Change Password</option>
<?php endif; ?>
<?php if(in_array('4', $login_user_roles)): ?>
  <option value="4" <?php if(isset($roles)): ?> <?php if(in_array('4',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage User</option>
<?php endif; ?>
<?php if(in_array('5', $login_user_roles)): ?>
  <option value="5" <?php if(isset($roles)): ?> <?php if(in_array('5',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Category</option>
<?php endif; ?>
<?php if(in_array('6', $login_user_roles)): ?>
  <option value="6" <?php if(isset($roles)): ?> <?php if(in_array('6',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Product</option>
<?php endif; ?>
<?php if(in_array('7', $login_user_roles)): ?>
  <option value="7" <?php if(isset($roles)): ?> <?php if(in_array('7',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Pages</option>
<?php endif; ?>
<?php if(in_array('8', $login_user_roles)): ?>
  <option value="8" <?php if(isset($roles)): ?> <?php if(in_array('8',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Slider</option>
<?php endif; ?>
<?php if(in_array('9', $login_user_roles)): ?>
  <option value="9" <?php if(isset($roles)): ?> <?php if(in_array('9',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Blog</option>
<?php endif; ?>
<?php if(in_array('10', $login_user_roles)): ?>
  <option value="10" <?php if(isset($roles)): ?> <?php if(in_array('10',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Marketplace</option>
<?php endif; ?>
<?php if(in_array('11', $login_user_roles)): ?>
  <option value="11" <?php if(isset($roles)): ?> <?php if(in_array('11',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product SEO</option>
<?php endif; ?>
<?php if(in_array('12', $login_user_roles)): ?>
  <option value="12" <?php if(isset($roles)): ?> <?php if(in_array('12',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Enquiry</option>
<?php endif; ?>
<?php if(in_array('13', $login_user_roles)): ?>
  <option value="13" <?php if(isset($roles)): ?> <?php if(in_array('13',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Coupon</option>
<?php endif; ?>
<?php if(in_array('14', $login_user_roles)): ?>
  <option value="14" <?php if(isset($roles)): ?> <?php if(in_array('14',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Order</option>
<?php endif; ?>
<?php if(in_array('15', $login_user_roles)): ?>
  <option value="15" <?php if(isset($roles)): ?> <?php if(in_array('15',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Newsletter</option>
<?php endif; ?>
<?php if(in_array('16', $login_user_roles)): ?>
  <option value="16" <?php if(isset($roles)): ?> <?php if(in_array('16',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Advance Setting</option>
<?php endif; ?>
<?php if(in_array('17', $login_user_roles)): ?>
  <option value="17" <?php if(isset($roles)): ?> <?php if(in_array('17',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Gallery</option>
<?php endif; ?>
<?php if(in_array('18', $login_user_roles)): ?>
  <option value="18" <?php if(isset($roles)): ?> <?php if(in_array('18',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Ticket History</option>
<?php endif; ?>
<?php if(in_array('19', $login_user_roles)): ?>
  <option value="19" <?php if(isset($roles)): ?> <?php if(in_array('19',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Identify Product</option>
<?php endif; ?>
<?php if(in_array('20', $login_user_roles)): ?>
  <option value="20" <?php if(isset($roles)): ?> <?php if(in_array('20',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Negotiation</option>
<?php endif; ?>
<?php if(in_array('20', $login_user_roles)): ?>
  <option value="20" <?php if(isset($roles)): ?> <?php if(in_array('20',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Negotiation</option>
<?php endif; ?>
<?php if(in_array('21', $login_user_roles)): ?>
  <option value="21" <?php if(isset($roles)): ?> <?php if(in_array('21',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Client</option>
<?php endif; ?>
<?php if(in_array('22', $login_user_roles)): ?>
  <option value="22" <?php if(isset($roles)): ?> <?php if(in_array('22',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Partner</option>
<?php endif; ?>
<?php if(in_array('23', $login_user_roles)): ?>
  <option value="23" <?php if(isset($roles)): ?> <?php if(in_array('23',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Offer</option>
<?php endif; ?>
<?php if(in_array('24', $login_user_roles)): ?>
  <option value="24" <?php if(isset($roles)): ?> <?php if(in_array('24',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Product Review</option>
<?php endif; ?>
<?php if(in_array('25', $login_user_roles)): ?>
  <option value="25" <?php if(isset($roles)): ?> <?php if(in_array('25',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Location Pincodes</option>
<?php endif; ?>
<?php if(in_array('26', $login_user_roles)): ?>
  <option value="26" <?php if(isset($roles)): ?> <?php if(in_array('26',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Testimonial</option>
<?php endif; ?>
<?php if(in_array('27', $login_user_roles)): ?>
  <option value="27" <?php if(isset($roles)): ?> <?php if(in_array('27',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Return & Refund</option>
<?php endif; ?>
<?php if(in_array('28', $login_user_roles)): ?>
  <option value="28" <?php if(isset($roles)): ?> <?php if(in_array('28',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Our Associates</option>
<?php endif; ?>
<?php if(in_array('29', $login_user_roles)): ?>
  <option value="29" <?php if(isset($roles)): ?> <?php if(in_array('29',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage Showcase</option>
<?php endif; ?>
<?php if(in_array('30', $login_user_roles)): ?>
  <option value="30" <?php if(isset($roles)): ?> <?php if(in_array('30',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Manage FAQ</option>
<?php endif; ?>
<?php if(in_array('31', $login_user_roles)): ?>
  <option value="31" <?php if(isset($roles)): ?> <?php if(in_array('31',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Log History</option>
<?php endif; ?>
<?php if(in_array('32', $login_user_roles)): ?>
  <option value="32" <?php if(isset($roles)): ?> <?php if(in_array('32',$roles)): ?> selected <?php endif; ?> <?php endif; ?> >Certificates</option>
<?php endif; ?>

 </select>

<?php endif; ?>
</div>

</div>

<div class="row mt-3">
<div class="col-lg-6">
<input type="checkbox" id="can_delete" name="can_delete" <?php if(isset($edit)): ?> <?php if($edit->can_delete==1): ?> checked <?php endif; ?> <?php endif; ?>> <label for="can_delete">Sub Admin can delete data?</label>
</div>
</div>

<div class="row mt-2">
<div class="col-lg-6">
 <label>Category</label>    
 <select class="selectpicker" name="category_ids[]" data-live-search="true" multiple>
  <?php $__currentLoopData = adminCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if(in_array($row->id, explode(',',$edit->category_ids))): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
   <?php $__currentLoopData = adminCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if(in_array($row->id, explode(',',$edit->category_ids))): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp; -<?php echo e($row->name); ?></option>
    <?php $__currentLoopData = adminCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if(in_array($row->id, explode(',',$edit->category_ids))): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp;&nbsp; --<?php echo e($row->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>    
</div>

<div class="col-lg-6">
 <label>Brand</label>    
 <select class="selectpicker" name="brand_ids[]" data-live-search="true" multiple>
  <?php $__currentLoopData = adminBrands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if(in_array($row->id, explode(',',$edit->brand_ids))): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>    
</div>
</div>

<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createSubadmin('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> Data</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/modal/subadmin/addedit-subadmin.blade.php ENDPATH**/ ?>