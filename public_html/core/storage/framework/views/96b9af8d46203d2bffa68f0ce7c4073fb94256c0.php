<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit User</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>

<div class="modal-body">
<form method="post" onSubmit="event.preventDefault()" id="user-form">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />

<div class="row">
<div class="col-lg-7">
<input type="text" id="name" name="name" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> placeholder="Your Name" onKeyup="$(this).text('');">
</div>

<div class="col-lg-5">
<input type="text" id="mobile" name="mobile" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->mobile); ?>" <?php else: ?> value="<?php echo e(old('mobile')); ?>" <?php endif; ?> placeholder="Your Mobile no.">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-8">
<input type="text" id="email" name="email" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->email); ?>" <?php else: ?> value="<?php echo e(old('email')); ?>" <?php endif; ?> placeholder="Your Email" onKeyup="$(this).text('');">
</div>

<div class="col-lg-4">
<input type="password" id="password" name="password" class="form-control" placeholder="Your Password">
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createUser('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> User</button>
</div>
</div>
</form>
</div><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/modal/user/addedit-user.blade.php ENDPATH**/ ?>