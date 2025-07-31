<?php if($data->isNotEmpty()): ?>
 <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php
   $values = explode(',',$row->value);
  ?>
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="<?php echo e($row->id); ?>" />    
    
<div class="col-sm-5">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="<?php echo e($row->key); ?>" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-7">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <option value="<?php echo e($value); ?>"><?php echo e($value); ?></option>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php endif; ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/category-attribute-form.blade.php ENDPATH**/ ?>