

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
<div class="dashboard-box dash">
<h3>Dashboard</h3>
<p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses,and edit your password and account details.</p>

<div class="row">
<div class="col-lg-3 col-6 mb-2"><a href="<?php echo e(route('userpanel.order')); ?>">
<div class="dash-item">
    <span>
    <i class="far fa-shopping-bag"></i>
    </span>
    <h2>Orders</h2>
</div>
</a></div>
<div class="col-lg-3 col-6 mb-2"><a href="<?php echo e(route('userpanel.ticket')); ?>">
<div class="dash-item">
    <span>
    <i class="far fa-ticket"></i>
    </span>
    <h2>Ticket System</h2>
</div>
</a></div>
<div class="col-lg-3 col-6 mb-2"><a href="<?php echo e(route('userpanel.profile')); ?>">
<div class="dash-item">
    <span>
    <i class="far fa-user"></i>
    </span>
    <h2>profile</h2>
</div>
</a></div>
<div class="col-lg-3 col-6 mb-2"><a href="javascript:void(0);" onClick="document.getElementById('logout-form').submit();" >
<div class="dash-item">
    <span>
    <i class="far fa-sign-out-alt"></i>
    </span>
    <h2>Logout</h2>
</div>
</a></div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/index.blade.php ENDPATH**/ ?>