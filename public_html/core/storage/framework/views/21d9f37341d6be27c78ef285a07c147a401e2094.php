
<?php $__env->startSection('title','Sub Admin'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Sub Admin</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Sub Admin</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<div class="mt-3">
<div class="row">
 <div class="col-lg-8">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-7">
  <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('search-subadmin')); ?>">
    <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">
 <input type="text" class="form-control <?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Search" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  <?php if(isset($search_keyword)): ?>
     <a href="<?php echo e(route('subadmin')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
    <?php endif; ?>
  <?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="invalid-feedback" role="alert">
        <strong><?php echo e($message); ?></strong>
    </span>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
 </form>
  </div>
 </div> 

 </div>
 <div class="col-lg-4">
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="subadminModal();"> <i class="ri-add-circle-line"></i> Add new</a>
 </div> 
</div>
<div class="text-muted pt-1"> Showing <?php echo e($data->firstItem()); ?> to <?php echo e($data->lastItem()); ?> of <?php echo e($data->total()); ?> &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>

<?php if($data->isNotEmpty()): ?>
<br>
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col">S.No</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Mobile</th>
    <th scope="col">Status</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
 $status = ($user->status==1) ? "bg-success" : "bg-danger";
 $user_st = ($user->status==1) ? 0 : 1;
?>
  <tr>
    <th scope="row"><?php echo e(++$i); ?></th>
    <td><?php echo e($user->name); ?>

      <span class="badge bg-info float-end"><?php echo e($user->type); ?></span>
    </td>
    <td><?php echo e($user->email); ?></td>
    <td><?php echo e($user->mobile); ?></td>
    <td><a href="<?php echo e(route('subadmin.update.status',[$user->id,$user_st])); ?>" onClick="return confirm('Are you sure?');"><?php echo statusBadge($user->status); ?></a></td>
    <td>
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="subadminModal('<?php echo e($user->id); ?>');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Sub Admin" onClick="changeSubadminPassword('<?php echo e($user->id); ?>')"><i class="icon nav-icon" data-feather="lock"></i></a> &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="View Roles" onClick="viewRoles('<?php echo e($user->id); ?>')"><i class="icon nav-icon" data-feather="eye"></i></a>
    <?php if(canDelete()): ?> &nbsp;
      <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Delete" onClick="deleteSubadmin('<?php echo e($user->id); ?>')" class="text-danger"><i class="icon nav-icon" data-feather="trash"></i></a>
     <?php endif; ?>
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<?php echo e($data->appends($_GET)->links()); ?>

<?php else: ?>

<div class="alert alert-danger alert-dismissible fade show w-50 m-auto" role="alert">
<i class="bi bi-exclamation-octagon me-1"></i>No Record Found!
</div>

<?php endif; ?>

</div>
</div>


</div>
</div>

</div>
<!-- container-fluid -->
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/subadmin.blade.php ENDPATH**/ ?>