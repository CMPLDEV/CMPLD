<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Area Pincode</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<?php if(isset($edit)): ?>
 <?php echo method_field('PUT'); ?>
<?php endif; ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />
<input type="hidden" name="district_id" value="<?php echo e($district_id); ?>" />

<div class="modal-body">

<div class="col-lg-12">

<div class="row">
 <div class="col-lg-6">
  <input type="text" id="pincode" name="pincode" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->pincode); ?>" <?php else: ?> value="<?php echo e(old('pincode')); ?>" <?php endif; ?> placeholder="Pincode">     
 </div>
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createArea('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> Area</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/modal/location/addedit-area.blade.php ENDPATH**/ ?>