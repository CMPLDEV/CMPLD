<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="POST" id="user-form" action="<?php echo e(route('update-profile')); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<?php echo method_field('PUT'); ?>
<div class="modal-body">

<div class="row">

<div class="col-lg-12">
<input type="text" id="name" name="name" placeholder="Your Name" class="form-control" value="<?php echo e($profile->name); ?>">
</div>

</div>

<div class="row mt-3">

<div class="col-lg-6">
<input type="file" id="pic" name="pic" class="form-control">
</div>


<div class="col-lg-6">
 <img <?php if(!empty($profile->pic)): ?> src="<?php echo e(asset('uploaded_files/profile/'.$profile->pic)); ?>" <?php else: ?> src="<?php echo e(asset('admin_assets/images/user.png')); ?>" <?php endif; ?> alt="<?php echo e($profile->name); ?>" class="rounded-circle" width="60">
 <?php if(!empty($profile->pic)): ?>
  <a class="text-danger" href="<?php echo e(route('remove-pic')); ?>">Remove</a>
 <?php endif; ?>
</div>

</div>

<div class="modal-footer mt-3">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit" id="edit-btn">Update Profile</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/modal/subadmin/profile.blade.php ENDPATH**/ ?>