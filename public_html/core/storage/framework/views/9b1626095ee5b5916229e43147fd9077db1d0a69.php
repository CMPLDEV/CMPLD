<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel">Add/Edit Category</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>
<form method="post" onSubmit="event.preventDefault()" id="user-form" enctype="multipart/form-data">
<?php echo csrf_field(); ?>

<input type="hidden" name="id" value="<?php echo e($id); ?>" />

<div class="modal-body">

<div class="row">

<div class="col-lg-4">
 <label>Icon</label>
 <?php if(isset($edit)): ?>
  <img src="<?php echo e(asset(showImage($edit->icon,'uploaded_files/category'))); ?>" alt="icon" width="100%">
  <?php if(!empty($edit->icon)): ?><a href="<?php echo e(route('category.remove.image',[$edit->id,'icon'])); ?>" class="text-danger" onClick="return confirm('Are you sure?');">Remove</a><?php endif; ?>
 <?php else: ?> 
  <img src="<?php echo e(asset(noImage())); ?>" alt="icon" width="100%">   
 <?php endif; ?> 
 <input type="file" name="icon" id="icon" class="form-control">  
 <span class="text-danger"><strong>679px x 679px</strong> , <strong>Size:</strong> 150 KB</span>
 
 <br>
 
 <label>Image</label>
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
 <div class="col-lg-7">
 <input type="text" id="name" name="name" class="form-control" <?php if(isset($edit)): ?> value="<?php echo e($edit->name); ?>" <?php else: ?> value="<?php echo e(old('name')); ?>" <?php endif; ?> placeholder="Category Name">
 </div> 
 <div class="col-lg-5">
 <select class="form-control" name="parent_id" id="parent_id">
   <option value="">Parent category</option> 
   <option value="0" <?php if(isset($edit)): ?> <?php if($edit->parent_id == 0): ?> selected <?php endif; ?> <?php endif; ?>>Nothing</option>
   <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if($edit->parent_id == $row->id): ?> selected <?php endif; ?> <?php endif; ?>> <?php echo e($row->name); ?></option>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
 </div>  
</div>

<br>

<div class="row">
 <div class="col-lg-8">
 <select class="selectpicker" name="brand_ids[]" id="brand_ids" data-live-search="true" multiple>
  <?php $__currentLoopData = adminBrands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($edit)): ?> <?php if(in_array($row->id, explode(',',$edit->brand_ids))): ?> selected <?php endif; ?> <?php endif; ?>> <?php echo e($row->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </select>
 </div> 
 <div class="col-lg-4">
 <input type="checkbox" id="show_brand" name="show_brand" <?php if(isset($edit)): ?> <?php if($edit->show_brand): ?> checked <?php endif; ?> <?php endif; ?>>
 <label for="show_brand">Show Brand</label>
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
<button type="submit" class="btn btn-success user-submit btn-sm" id="edit-btn" onClick="createCategory('<?php echo e($id); ?>');">
 <?php if($id==0): ?> Add <?php else: ?> Update <?php endif; ?> Category</button>
</div>
</div>
</div>
</form>
<?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/modal/category/addedit-category.blade.php ENDPATH**/ ?>