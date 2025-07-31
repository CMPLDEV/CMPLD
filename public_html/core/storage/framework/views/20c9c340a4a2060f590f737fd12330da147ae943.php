
<?php $__env->startSection('title','Users List'); ?>
<?php $__env->startSection('content'); ?>

<form method="GET" action="<?php echo e(route('user.export')); ?>" id="export-form">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="user_ids" id="user_ids" />
</form>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Users List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item">
<select onChange="showPerPage('user_per_page',this.value);" class="rounded-0 border-secondary">
 <option value="">Show Per Page</option> 
 <option value="25" <?php if(setting()->user_per_page==25): ?> selected <?php endif; ?>>25</option>
 <option value="50" <?php if(setting()->user_per_page==50): ?> selected <?php endif; ?>>50</option>
 <option value="75" <?php if(setting()->user_per_page==75): ?> selected <?php endif; ?>>75</option>
 <option value="100" <?php if(setting()->user_per_page==100): ?> selected <?php endif; ?>>100</option>
</select>
</li>   
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Users List</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->
<div class="row">
<div class="col-lg-12">

<?php if(count($errors)>0): ?>
<div class="alert alert-danger alert-dismissible fade show mb-3 w-50 m-auto">
<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
<strong>Errors Occured!</strong>
<ul style="margin-left:25px;">
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <li><?php echo e($error); ?></li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ul>
</div>
<?php endif; ?>

<div class="card">
<div class="card-body">
<div class="mt-3">
<div class="row">
 <div class="col-lg-8">
 <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('user.search')); ?>">
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
     <a href="<?php echo e(route('user')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 <div class="col-lg-4">
 <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Import" onClick="importUser();"> <i class="icon nav-icon" data-feather="upload"></i></a>
  &nbsp;
 <a href="javascript:void(0);" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="Export" onClick="exportUser();"> <i class="icon nav-icon" data-feather="download"></i></a>
 &nbsp;
 <a href="javascript:void(0);" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New" onClick="userModal();"> <i class="icon nav-icon" data-feather="plus"></i> </a>
 </div> 
</div>
</div>

<?php if($data->isNotEmpty()): ?>
<br>
<form action="<?php echo e(route('user.bottom.action')); ?>" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
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
 $user_st = ($user->status==1) ? 0 : 1;
?>
  <tr>
    <th scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($user->id); ?>"> <?php echo e(++$i); ?></th>
    <td><?php echo e($user->name); ?>

      <span class="badge bg-info float-end"><?php echo e($user->type); ?></span>
    </td>
    <td><?php echo e($user->email); ?></td>
    <td><?php echo e($user->mobile); ?></td>
    <td>
      <a href="<?php echo e(route('user.update.status',[$user->id,$user_st])); ?>" onClick="return confirm('Are you sure?');"><?php echo statusBadge($user->status); ?></a> 
    </td>
    <td>
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Edit" onClick="userModal('<?php echo e($user->id); ?>');"><i class="icon nav-icon" data-feather="edit"></i></a> &nbsp;
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Address" onClick="userAddressModal('<?php echo e($user->id); ?>','add');"><i class="icon nav-icon" data-feather="map-pin"></i></a> &nbsp;
     <a href="javascript:void(0);" data-bs-toggle="tooltip" title="Delete" onClick="deleteUser('<?php echo e($user->id); ?>')" class="text-danger"><i class="icon nav-icon" data-feather="trash"></i></a>
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

<div class="card">
 <div class="card-footer">
 <div class="row">
  <div class="col-lg-12">
  <input type="submit" name="req_for" class="btn btn-outline-success" value="Active" /> &nbsp;
  <input type="submit" name="req_for" class="btn btn-outline-danger" value="Inactive" /> &nbsp;
  <input type="submit" name="req_for" class="btn btn-outline-danger float-end" value="Delete" /> 
  </div>
 </div> 
 </div> 
</div>
</form>
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/user.blade.php ENDPATH**/ ?>