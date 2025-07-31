
<?php $__env->startSection('title','Product List'); ?>
<?php $__env->startSection('content'); ?>

<style>
.number-list{
  font-size: 22px;
  font-weight: 600;
  color: #00aff0;
}
.ico{
  float: right;
  margin-top: 6px;
}
</style>

<form method="POST" action="<?php echo e(route('product.export')); ?>" id="export-form">
 <?php echo csrf_field(); ?>
 <input type="hidden" name="product_ids" id="product_ids" />
</form>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item">
<select onChange="showPerPage('product_per_page',this.value);" class="rounded-0 border-secondary">
 <option value="">Show Per Page</option> 
 <option value="50" <?php if(setting()->product_per_page==50): ?> selected <?php endif; ?>>50</option>
 <option value="100" <?php if(setting()->product_per_page==100): ?> selected <?php endif; ?>>100</option>
 <option value="200" <?php if(setting()->product_per_page==200): ?> selected <?php endif; ?>>200</option>
 <option value="500" <?php if(setting()->product_per_page==500): ?> selected <?php endif; ?>>500</option>
 <option value="1000" <?php if(setting()->product_per_page==1000): ?> selected <?php endif; ?>>1000</option>
 <option value="2000" <?php if(setting()->product_per_page==2000): ?> selected <?php endif; ?>>2000</option>
</select>
</li>  
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product List</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-4">
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->all_count); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">All Products</p>
</div>
</div>
</div>
<div class="col-lg-4">
<a href="<?php echo e(url('admin/product/search?_token='.csrf_token().'&filter=ACTIVE&search_keyword=')); ?>">    
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->active_count); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Active Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="<?php echo e(url('admin/product/search?_token='.csrf_token().'&filter=INACTIVE&search_keyword=')); ?>">    
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->inactive_count); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Inactive Listings</p>
</div>
</div>
</a>
</div>

<div class="col-lg-4">
<a href="<?php echo e(url('admin/product/search?_token='.csrf_token().'&filter=INSTOCK&search_keyword=')); ?>">    
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->in_stock); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">In-Stock Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="<?php echo e(url('admin/product/search?_token='.csrf_token().'&filter=OUTSTOCK&search_keyword=')); ?>">    
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->out_of_stock); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">Out-of Stock Listings</p>
</div>
</div>
</a>
</div>
<div class="col-lg-4">
<a href="<?php echo e(url('admin/product/search?_token='.csrf_token().'&filter=EOL&search_keyword=')); ?>">    
<div class="active-box card">
<div class="card-body">
<span class="number-list"><?php echo e(allProductCount()[0]->eol_count); ?> <i class="bx bx-info-circle ico"></i></span>
<p class="active m-0">End of Life Listings</p>
</div>
</div>
</a>
</div>

<!-- all product sec -->
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
 <div class="row">
  <div class="col-lg-2">
  <span class="badge bg-dark p-2 rounded-0 text-white">Total: <?php echo e($data->total()); ?></span>
  </div>

  <div class="col-lg-10">
  <form class="search-form d-flex align-items-center" method="GET" action="<?php echo e(route('product.search')); ?>">
    <?php echo csrf_field(); ?>  
 <div class="input-group mb-3">
 <select name="brand" id="brand" class="form-control">
  <option value="">Choose brand</option>     
  <?php $__currentLoopData = brands(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($brand)): ?> <?php if($brand == $row->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>
 <select name="category" id="category" class="selectpicker" data-live-search="true">
  <option value="">Choose category</option>     
  <?php $__currentLoopData = adminCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <option value="<?php echo e($row->id); ?>" <?php if(isset($category)): ?> <?php if($category == $row->id): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($row->name); ?></option>
   <?php $__currentLoopData = adminCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($row->id); ?>" <?php if(isset($category)): ?> <?php if($category == $row->id): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp; -<?php echo e($row->name); ?></option>
    <?php $__currentLoopData = adminCategories($row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <option value="<?php echo e($row->id); ?>" <?php if(isset($category)): ?> <?php if($category == $row->id): ?> selected <?php endif; ?> <?php endif; ?>> &nbsp;&nbsp; --<?php echo e($row->name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </select>
 <select name="filter" id="filter" class="form-control">
  <option value="">Sort By</option>
  <option value="A-Z" <?php if(isset($filter)): ?> <?php if($filter=="A-Z"): ?> selected <?php endif; ?> <?php endif; ?>>A-Z</option>
  <option value="Z-A" <?php if(isset($filter)): ?> <?php if($filter=="Z-A"): ?> selected <?php endif; ?> <?php endif; ?>>Z-A</option>
  <option value="ON" <?php if(isset($filter)): ?> <?php if($filter=="ON"): ?> selected <?php endif; ?> <?php endif; ?>>Old - New</option>
  <option value="NO" <?php if(isset($filter)): ?> <?php if($filter=="NO"): ?> selected <?php endif; ?> <?php endif; ?>>New - Old</option>
  <option value="ACTIVE" <?php if(isset($filter)): ?> <?php if($filter=="ACTIVE"): ?> selected <?php endif; ?> <?php endif; ?>>Active</option>
  <option value="INACTIVE" <?php if(isset($filter)): ?> <?php if($filter=="INACTIVE"): ?> selected <?php endif; ?> <?php endif; ?>>Inactive</option>
  <option value="INSTOCK" <?php if(isset($filter)): ?> <?php if($filter=="INSTOCK"): ?> selected <?php endif; ?> <?php endif; ?>>In-Stock</option>
  <option value="OUTSTOCK" <?php if(isset($filter)): ?> <?php if($filter=="OUTSTOCK"): ?> selected <?php endif; ?> <?php endif; ?>>Out-of Stock</option>
  <option value="EOL" <?php if(isset($filter)): ?> <?php if($filter=="EOL"): ?> selected <?php endif; ?> <?php endif; ?>>End of life</option>
 </select>

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
  <?php if(isset($search_keyword) || isset($filter) || isset($category) || isset($brand)): ?>
     <a href="<?php echo e(route('product')); ?>" class="text-danger" data-bs-toggle="tooltip" title="Remove Filter"><i class="icon nav-icon" data-feather="filter"></i></a>
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
<?php if(canUpdate()): ?> 
 <a href="javascript:void(0);" class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Import" onClick="importProduct();"> <i class="icon nav-icon" data-feather="upload"></i></a>
  &nbsp;
 <a href="javascript:void(0);" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" title="Export" onClick="exportProduct();"> <i class="icon nav-icon" data-feather="download"></i></a>
 &nbsp;
 <?php endif; ?> 
 <a href="<?php echo e(route('product.add')); ?>" class="float-end btn btn-primary btn-sm" data-bs-toggle="tooltip" title="Add New"> <i class="icon nav-icon" data-feather="plus"></i></a>

 </div> 
</div>
<div class="text-muted pt-1"> Showing <?php echo e($data->firstItem()); ?> to <?php echo e($data->lastItem()); ?> of <?php echo e($data->total()); ?> &nbsp;&nbsp;&nbsp;&nbsp;</div>
</div>
<hr>
<?php if($data->isNotEmpty()): ?>
<hr>
<form action="<?php echo e(route('product.bottom.action')); ?>" method="POST" onSubmit="return checkboxValidation()">
 <?php echo csrf_field(); ?> 
<table class="table table-bordered">
<thead>
  <tr>
    <th scope="col"><input type="checkbox" id="checkAll"> S.No</th>
    <th scope="col">Product Details</th>
    <th scope="col">MRP</th>
    <th scope="col">Price</th>
    <th scope="col">Stock</th>
    <th scope="col">Show As</th>
    <th scope="col">Order</th>
    <th scope="col">Status</th>
    <th scope="col">Date</th>
    <th scope="col">Action</th>
  </tr>
</thead>
<tbody>
<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
 $row_st = ($row->status==1) ? 0 : 1;
?>
  <tr>
    <td scope="row"> <input type="checkbox" name="ids[]" id="ids[]" class="ids" value="<?php echo e($row->id); ?>"> <?php echo e(++$i); ?></td>
    <td class="v-align"><img src="<?php echo e(asset(showImage($row->image,'uploaded_files/product'))); ?>" width="60" class="rounded" style="float: left;margin-right: 15px;">
   <a href="<?php echo e(productURL($row->slug)); ?>" target="_blank" style="color:#038edc;font-weight: 600;"><?php echo e(Str::limit($row->name, 35, $end='...')); ?></a> <br>
   <b>SKU ID:</b> <?php echo e($row->sku); ?> <br>
    <?php if(!empty(category($row->category_id))): ?> <?php echo e(category($row->category_id)->name); ?> <?php endif; ?>
    
    </td>
    
    <input type="hidden" name="hidden_ids[]" class="hidden_ids" value="<?php echo e($row->id); ?>"/>
    <td class="text-center v-align"><input type="number" min="0" name="mrp[]" class="mrp form-control" value="<?php echo e($row->mrp); ?>" style="background-color:whitesmoke;text-align:center;width:70px;padding:0px" />
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="price[]" class="price form-control" value="<?php echo e($row->price); ?>" style="background-color:whitesmoke;text-align:center;width:70px;padding:0px" />
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="stock[]" class="stock form-control" value="<?php echo e($row->stock); ?>" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>
    
    <td>
    <?php if($row->is_featured == 1): ?>
      <span class="badge bg-warning" title="Featured">Featured</span>
    <?php endif; ?>

    <?php if($row->is_best == 1): ?>
      <span class="badge bg-warning" title="Best">Best</span>
    <?php endif; ?>
    
    <?php if($row->is_eol == 1): ?>
        <span class="badge bg-warning" title="EOL">EOL</span>
    <?php endif; ?>
    </td>
    
    <td class="text-center v-align"><input type="number" min="0" name="order_by[]" class="order_by form-control" value="<?php echo e($row->order_by); ?>" style="background-color:whitesmoke;text-align:center;width:60px;padding:0px" />
    </td>

    <td>
    <a href="<?php echo e(route('product.update.status',[$row->id,$row_st])); ?>" onClick="return confirm('Are you sure?');"><?php echo statusBadge($row->status); ?></a>
    </td>
    <td width="120px">
     <p><b>Created:</b> <?php echo e($row->created_at); ?></p>
     <p><b>Updated:</b> <?php echo e($row->updated_at); ?></p>
    </td>
    <td>
     <div class="d-flex">
      <a href="<?php echo e(route('product.edit',$row->id)); ?>" data-bs-toggle="tooltip" title="Edit"><i class="icon nav-icon" data-feather="edit"></i></a> 
       &nbsp;&nbsp;&nbsp;&nbsp;
     <a href="<?php echo e(route('product.copy',$row->id)); ?>" data-bs-toggle="tooltip" title="Copy" onClick="return confirm('Are you sure?');"><i class="icon nav-icon" data-feather="copy"></i></a> 
       &nbsp;&nbsp;
      <a href="<?php echo e(route('product.offer',$row->id)); ?>" data-bs-toggle="tooltip" title="Manage Offer"> <i class="fa fa-gift" style="font-size: 17px;
    margin: 0 10px;"></i></a>
     &nbsp;&nbsp;
     <a href="https://cmpl-amazon-calculator.netlify.app/" target="popup" onclick="window.open('https://cmpl-amazon-calculator.netlify.app/','popup','width=750,height=550'); return false;" title="Calculator">
    <img src="admin_assets/images/calculator.png" style="max-width: 15px;" alt=" Calc" title="Calculator" target="_blank" onerror="this.onerror=null;this.src='';">
    </a>
      </div>
    </td>
  </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>


<div class="card">
 <div class="card-footer"> 
 <input type="submit" name="req_for" value="Active" class="btn btn-outline-success req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Inactive" class="btn btn-outline-danger req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Make Featured" class="btn btn-outline-dark req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Featured" class="btn btn-outline-dark req_for btn-sm"> &nbsp;

 <input type="submit" name="req_for" value="Make Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove Best" class="btn btn-outline-secondary req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Make EOL" class="btn btn-outline-info req_for btn-sm"> &nbsp;
 <input type="submit" name="req_for" value="Remove EOL" class="btn btn-outline-info req_for btn-sm"> &nbsp;
 
 <input type="submit" name="req_for" value="Update Input" class="btn btn-outline-dark req_for btn-sm">
 <?php if(canDelete()): ?>  
 <input type="submit" name="req_for" value="Delete" class="btn btn-danger req_for btn-sm float-end">
 <?php endif; ?> 
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

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/admin/product.blade.php ENDPATH**/ ?>