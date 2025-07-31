<header id="page-topbar">
<div class="navbar-header">
<div class="d-flex">
<!-- LOGO -->
<div class="navbar-brand-box">
<a href="" class="logo logo-dark">
<span class="logo-sm">
<img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>" height="22">
</span>
<span class="logo-lg">
<img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>" height="22">
</span>
</a>

<a href="" class="logo logo-light">
<span class="logo-sm">
<img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>" height="22">
</span>
<span class="logo-lg">
<img src="uploaded_files/logo/<?php echo e(setting()->logo); ?>" alt="<?php echo e(setting()->comp_name); ?>" height="22">
</span>
</a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
<i class="fa fa-fw fa-bars"></i>
</button>

</div>

<div class="d-flex">

<div class="dropdown d-inline-block <?php echo e(checkRoles(1)); ?>">
<button type="button" class="btn header-item noti-icon right-bar-toggle" id="right-bar-toggle" onClick="window.location.href='<?php echo e(route('setting')); ?>'">
<i class="icon-sm" data-feather="settings"></i>
</button>
</div>

<div class="dropdown d-inline-block">
<button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown"
data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="rounded-circle header-profile-user" <?php if(!empty(Auth::guard('admin')->user()->pic)): ?> src="<?php echo e(asset('uploaded_files/profile/'.Auth::guard('admin')->user()->pic)); ?>" <?php else: ?> src="<?php echo e(asset('admin_assets/images/user.png')); ?>" <?php endif; ?> alt="<?php echo e(Auth::guard('admin')->user()->name); ?>">
<span class="ms-2 d-none d-sm-block user-item-desc">
<span class="user-name"><?php echo e(Auth::guard('admin')->user()->name); ?></span>
<span class="user-sub-title"><?php echo e(reverseSlug(Auth::guard('admin')->user()->type)); ?></span>
</span>
</button>
<div class="dropdown-menu dropdown-menu-end pt-0">
<div class="p-3 bg-primary border-bottom">
<h6 class="mb-0 text-white"><?php echo e(Auth::guard('admin')->user()->name); ?></h6>
<p class="mb-0 font-size-11 text-white-50 fw-semibold"><?php echo e(Auth::guard('admin')->user()->email); ?></p>
</div>

<a class="dropdown-item" href="javascript:void(0);" onClick="profile();"><i class="fas fa-user-circle text-muted align-middle me-1"></i> <span class="align-middle">Profile</span></a>

<a class="dropdown-item <?php echo e(checkRoles(1)); ?>" href="<?php echo e(route('setting')); ?>"><i class="fas fa-user-cog text-muted align-middle me-1"></i> <span class="align-middle">Account Settings</span></a>

<a class="dropdown-item <?php echo e(checkRoles(3)); ?>" href="<?php echo e(route('change.my.password')); ?>"><i class="fas fa-key text-muted align-middle me-1"></i> <span class="align-middle">Change Password</span></a>

<div class="dropdown-divider"></div>
<a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>"><i class="fas fa-sign-out-alt text-muted align-middle me-1"></i> <span class="align-middle">Logout</span></a>
</div>
</div>
</div>
</div>
</header><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/admin/layouts/navbar.blade.php ENDPATH**/ ?>