<div class="modal-header bg-light p-3">
<h5 class="modal-title" id="exampleModalLabel"><?php echo e($user->name); ?>'s Address List</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"
aria-label="Close" id="close-modal"></button>
</div>

<div class="card">

<div class="container mt-2">
 <div class="row">
  <div class="col-lg-12">
   <button type="button" class="btn btn-dark btn-sm float-end" onClick="userAddAddressModal('<?php echo e($user->id); ?>','add');">Add new</button> 
  </div>   
 </div>   
</div>

<?php if($data->isNotEmpty()): ?>    
<table class="table table-bordered">
<thead>
   <tr>
   <th>S.No</th> 
   <th>Name</th>
   <th>Email</th>
   <th>Mobile</th>
   <th>Address</th>
   <th>Action</th>
   </tr>
 </thead>
 <tbody>
  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
    <tr>
    <td><?php echo e($i++); ?>.</td>  
    <td><?php echo e($row->name); ?></td>
    <td><?php echo e($row->email); ?></td>
    <td><?php echo e($row->mobile); ?></td>
    <td>
     <?php echo e($row->address); ?> <?php echo e($row->city); ?>, <?php echo e(state($row->state)); ?> <?php echo e(country($row->country)); ?> - <?php echo e($row->pincode); ?>    
    </td>
    <td>
     <a href="javascript:void(0);" class="btn btn-info" title="Edit" onClick="userAddAddressModal('<?php echo e($row->id); ?>','update','<?php echo e($user->id); ?>');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
     <a href="<?php echo e(route('user.address.remove',$row->id)); ?>" class="btn btn-danger" title="Delete" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="delete"></i></a>   
    </td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>  
<?php else: ?>
 <div class="p-2">
 <h4>No Record Found.</h4> 
 </div>
<?php endif; ?>
</div>
<?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/modal/user/address.blade.php ENDPATH**/ ?>