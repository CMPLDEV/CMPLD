<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit State</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<?php if(isset($edit)): ?>
 <?php echo method_field('PUT'); ?>
<?php endif; ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />

<div class="modal-body">

<div class="col-lg-12">

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="name" name="name" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> placeholder="Name">
 </div> 
</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createState('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> State</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/modal/location/addedit-state.blade.php ENDPATH**/ ?>