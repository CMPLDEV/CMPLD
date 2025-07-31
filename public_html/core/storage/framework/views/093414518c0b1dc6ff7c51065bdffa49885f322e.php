

<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('description','Dashboard'); ?>
<?php $__env->startSection('keywords','Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<section class="user-wrap">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 p-0">
<?php echo $__env->make('user.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="col-lg-9">
<div class="dashboard-box">
<h3 class=""><a href="<?php echo e(route('userpanel.address.add')); ?>" class="btn update-btn btn-sm">Add new</a></h3>
<?php if($data->isNotEmpty()): ?>
<div class="row">
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <div class="col-lg-6">
 <div class="add-box">
<div class="add-item">
<div class="add-title">
<?php if(user()->default_address == $row->id): ?>
<h4> <input type="radio" name="address" value="<?php echo e($row->id); ?>" checked> Default</h4>
<?php else: ?>
<h4> <input type="radio" name="address" value="<?php echo e($row->id); ?>" onClick="setDefaultAddress(this.value);"> </h4>
<?php endif; ?>
</div>
<div class="add-main">
  <h3><?php echo e($row->name); ?></h3> <br>
  <p><?php echo e($row->address); ?> <?php echo e($row->city); ?>, <?php echo e(state($row->state)); ?> <?php echo e($row->pincode); ?>

  <?php echo e(country($row->country)); ?></p>
  <p><span>Phone Number:</span> <span><?php echo e($row->mobile); ?></span></p>
  <p><span>Email Address:</span> <span><?php echo e($row->email); ?></span></p>
</div>
<div class="add-button">
  <a href="<?php echo e(route('userpanel.address.edit',$row->id)); ?>" class="edit-btn">Edit</a> | 
  <a href="<?php echo e(route('userpanel.address.remove',$row->id)); ?>" class="edit-btn" onClick="return confirm('Are you sure?');">Remove</a>
</div>
</div>
</div>
 </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
</div>
<?php else: ?>
 <h4 class="text-center" style="font-size: 12px;">
     <img class="no-add-img" style="max-width: 350px;margin: auto;display: block;" src="assets/img/no-add.png" alt="No Address Available">
     No Address Available.</h4>
<?php endif; ?>

</div>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/user/address.blade.php ENDPATH**/ ?>