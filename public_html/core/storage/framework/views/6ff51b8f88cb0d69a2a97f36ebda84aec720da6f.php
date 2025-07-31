<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Brand</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />
<input type="hidden" name="parent_id" id="parent_id" value="0">

<div class="modal-body">

<div class="row">

<div class="col-lg-4">
 <?php if(isset($edit)): ?>
  <img src="<?php echo e(asset(showImage($edit->image,'uploaded_files/category'))); ?>" alt="image" width="100%">
  <?php if(!empty($edit->image)): ?><a href="<?php echo e(route('category.remove.image',[$edit->id,'image'])); ?>" class="text-danger" onClick="return confirm('Are you sure?');">Remove</a><?php endif; ?>
 <?php else: ?> 
  <img src="<?php echo e(asset(noImage())); ?>" alt="image" width="100%">   
 <?php endif; ?> 
 <input type="file" name="image" id="image" class="form-control">
 <span class="text-danger"><strong>679px x 679px</strong> , <strong>Size:</strong> 150 KB</span>
 
 <br><br>
<textarea name="meta_keywords" id="meta_keywords" cols="30" rows="2" class="form-control" placeholder="Meta Keywords"><?php if(isset($edit)): ?><?php echo e($edit->meta_keywords); ?><?php endif; ?></textarea>
 
</div>

<div class="col-lg-8">

<div class="row mb-3">
<div class="col-lg-12">
<?php if(isset($edit) && !empty($edit->banner)): ?>
  <img src="<?php echo e(asset(showImage($edit->banner,'uploaded_files/category'))); ?>" alt="banner" width="100%">
  <?php if(!empty($edit->image)): ?><a href="<?php echo e(route('category.remove.image',[$edit->id,'banner'])); ?>" class="text-danger" onClick="return confirm('Are you sure?');">Remove</a><?php endif; ?>
 <?php else: ?> 
  <img src="<?php echo e(asset(noBanner())); ?>" alt="banner" width="100%">   
 <?php endif; ?>
 <input type="file" name="banner" id="banner" class="form-control mt-2"> 
 <span class="text-danger"><strong>Dimension:</strong> 1500px x 300px, <strong>Size:</strong> 200 KB</span>
</div>    
</div>

<div class="row">
 <div class="col-lg-12">
 <input type="text" id="name" name="name" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> placeholder="Brand Name" onKeyup="$(this).text('');">
 </div> 
</div>

<br>
<textarea name="content" id="content" cols="30" rows="2" class="form-control" placeholder="Content"><?php if(isset($edit)): ?><?php echo e($edit->content); ?><?php endif; ?></textarea>

<br>
<textarea name="meta_title" id="meta_title" cols="30" rows="2" class="form-control" placeholder="Meta Title"><?php if(isset($edit)): ?><?php echo e($edit->meta_title); ?><?php endif; ?></textarea>

<br>
<textarea name="meta_description" id="meta_description" cols="30" rows="2" class="form-control" placeholder="Meta Description"><?php if(isset($edit)): ?><?php echo e($edit->meta_description); ?><?php endif; ?></textarea>

</div>

</div>


<div class="modal-footer mt-5">
<div class="hstack gap-2 justify-content-end">
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createBrand('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> Brand</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/modal/brand/addedit-brand.blade.php ENDPATH**/ ?>