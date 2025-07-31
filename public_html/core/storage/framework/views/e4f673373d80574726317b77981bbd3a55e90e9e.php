
<?php $__env->startSection('title','Logs History'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Logs History</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Logs History</li>
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
 <div class="col-lg-9">
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-10">
    <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('log.search')); ?>">
    <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">

 <select name="filter" id="filter" class="form-control">
  <option value="">Choose action</option>
  <option value="ADD" <?php if(isset($filter)): ?> <?php if($filter=="ADD"): ?> selected <?php endif; ?> <?php endif; ?>>ADD</option>
  <option value="UPDATE" <?php if(isset($filter)): ?> <?php if($filter=="UPDATE"): ?> selected <?php endif; ?> <?php endif; ?>>UPDATE</option>
  <option value="DELETE" <?php if(isset($filter)): ?> <?php if($filter=="DELETE"): ?> selected <?php endif; ?> <?php endif; ?>>DELETE</option>
 </select>
 
 <input type="text" class="form-control" name="date" placeholder="Search By Date" <?php if(isset($date)): ?> value="<?php echo e($date); ?>" <?php endif; ?> onClick="$(this).attr('type','date');">
 
 <input type="text" class="form-control <?php $__errorArgs = ['search_keyword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-25" placeholder="Search by: Action title" name="search_keyword" <?php if(isset($search_keyword)): ?> value="<?php echo e($search_keyword); ?>" <?php endif; ?>>
 
  <button class="btn btn-secondary" type="submit"><i class="icon nav-icon" data-feather="search"></i></button>
  </div>
  <?php if(isset($search_keyword) || isset($filter) || isset($date)): ?>
     <a href="<?php echo e(route('log')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
 <div class="col-lg-2">
 
</div> 
</div>
</div>

<?php if($data->isNotEmpty()): ?>
<hr>
<form action="#" method="GET" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
 <tr>
  <th scope="col">S.No</th>
  <th scope="col">Action</th>
  <th scope="col">Action By</th>
  <th scope="col">Action On</th>
  <th scope="col">Action Title</th>
  <th scope="col">Created At</th>
 </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
 <tr>
  <th scope="row"><?php echo e(++$i); ?>.</th>
  <td><?php echo e($row->action); ?></td>
  <td><?php echo e($row->action_by); ?></td>
  <td><?php echo e($row->action_on); ?></td>
  <td width="500"><?php echo e($row->action_title); ?></td>
  <td><?php echo e(date('d-m-Y  h:s A',strtotime($row->created_at))); ?></td>
 </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>

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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/log.blade.php ENDPATH**/ ?>