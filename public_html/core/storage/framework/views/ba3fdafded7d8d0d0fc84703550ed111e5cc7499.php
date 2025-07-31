
<?php $__env->startSection('title','Dashboard'); ?>
<?php $__env->startSection('content'); ?>

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Analytics</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
<li class="breadcrumb-item active">Analytics</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">
    
<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase" id="order_title"></h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center" id="total_order"></h4>
<div class="text-muted">Total Number of Orders</div>
</div>
<div>
<div class="dropdown">
<select class="form-control" name="order" onChange="orderAnalytic(this.value);">
 <option value="today">Today</option>
 <option value="yesterday">Yesterday</option>
 <option value="weekly">Last 7 days</option>
 <option value="monthly">Last 30 days</option>
 <option value="yearly">Last Year</option>
</select>
</div>
</div>
</div>

 <div id="order_chart">
  <div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>
 </div>

</div>
</div>
</div>    
    
<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase" id="sales_title"></h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center"><?php echo e(setting()->currency); ?> &nbsp; <span id="total_sales"> </span> &nbsp; <small class="text-muted" style="font-size:12px;">(Inc. shipping price)</small></h4>
<div class="text-muted">Total Earning</div>
</div>
<div>
<div class="dropdown">
<select class="form-control" name="sales" onChange="salesAnalytic(this.value);">
 <option value="today">Today</option>
 <option value="yesterday">Yesterday</option>
 <option value="weekly">Last 7 days</option>
 <option value="monthly">Last 30 days</option>
 <option value="yearly">Last Year</option>
</select>
</div>
</div>
</div>
<div id="sales_chart">
<div style="text-align: center;" class="ajax-spinner"><div class="spinner-border"></div></div>    
</div>
</div>
</div>
</div>
<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase">Top Selling Product</h6>
<div class="text-muted" id="top_selling_title">Today's top-5</div>
</div>
<div>
<div class="dropdown">
<select class="form-control" name="top_selling" onChange="topSellingAnalytic(this.value);">
 <option value="today">Today</option>
 <option value="yesterday">Yesterday</option>
 <option value="weekly">Last 7 days</option>
 <option value="monthly">Last 30 days</option>
 <option value="yearly">Last Year</option>
</select>
</div>
</div>
</div>
<div id="top_selling_chart"></div>
</div>
</div>
</div>

<div class="col-xl-6 col-sm-6">
<div class="row">

<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<a href="<?php echo e(route('product')); ?>">    
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase">Total Products</h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center text-muted">
<i class="icon nav-icon" data-feather="box"></i> &nbsp; <?php echo e($product_count); ?>

</h4>
</div>
<div>
</div>
</div>
</div>
</a>
</div>
</div>


<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<a href="<?php echo e(route('enquiry')); ?>">    
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase">Enquiry Received</h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center text-muted">
<i class="icon nav-icon" data-feather="mail"></i> &nbsp; <?php echo e($enquiry_count); ?>

</h4>
</div>
<div>
</div>
</div>
</div>
</a>
</div>
</div>

<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<a href="<?php echo e(route('admin.order')); ?>">    
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase">Order Placed</h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center text-muted">
<i class="icon nav-icon" data-feather="shopping-cart"></i> &nbsp; <?php echo e($order_count); ?>

</h4>
</div>
<div>
</div>
</div>
</div>
</a>
</div>
</div>

<div class="col-xl-6 col-sm-6">
<!-- Card -->
<div class="card">
<a href="<?php echo e(route('user')); ?>">    
<div class="card-body">
<div class="d-flex justify-content-between">
<div>
<h6 class="font-size-xs text-uppercase">Active Users</h6>
<h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center text-muted">
<i class="icon nav-icon" data-feather="users"></i> &nbsp; <?php echo e($user_count); ?>

</h4>
</div>
<div>
</div>
</div>
</div>
</a>
</div>
</div>

</div>    
</div>    

</div>

</div> 

</div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
 <script src="admin_assets/js/analytic.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/index.blade.php ENDPATH**/ ?>