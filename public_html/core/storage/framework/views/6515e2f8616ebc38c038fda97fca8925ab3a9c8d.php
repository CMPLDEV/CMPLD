<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Slider</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />

<div class="modal-body">

<div class="row">

<div class="col-lg-6">
 <?php if(isset($edit)): ?>
  <img src="<?php echo e(asset(showImage($edit->image,'uploaded_files/slider'))); ?>" alt="image" width="100%">
 <?php else: ?> 
  <img src="<?php echo e(asset(noBanner())); ?>" alt="image" width="100%" class="img-thumbnail">   
 <?php endif; ?> 
 <br><br>
 <input type="file" name="image" id="image" class="form-control">  
 
</div>

<div class="col-lg-6">

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="title" name="title" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->title); ?>" <?php else: ?> value="<?php echo e(old('title')); ?>" <?php endif; ?> placeholder="Title" onKeyup="$(this).text('');">
 </div>
 
 <div class="col-lg-12 mt-4">
 <input type="text" id="link" name="link" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->link); ?>" <?php else: ?> value="<?php echo e(old('link')); ?>" <?php endif; ?> placeholder="Link" onKeyup="$(this).text('');">
 </div>
 
</div>

<br>
<textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Description"><?php if(isset($edit)): ?><?php echo e($edit->description); ?><?php endif; ?></textarea>

</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createSlider('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> Slider</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/modal/slider/addedit-slider.blade.php ENDPATH**/ ?>