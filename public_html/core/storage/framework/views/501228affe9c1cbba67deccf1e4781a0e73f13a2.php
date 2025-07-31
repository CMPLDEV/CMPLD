<div class="user-profile">
<div class="user-specs">
<h3>My Account</h3>
</div>
<div class="menu-profile">
<a href="<?php echo e(route('userpanel')); ?>" <?php if(Route::currentRouteName()=="userpanel"): ?> class="active" <?php endif; ?>> Dashboard <i class="fas fa-chart-line fl-lt"></i></a>
<a href="<?php echo e(route('userpanel.profile')); ?>" <?php if(Route::currentRouteName()=="userpanel.profile"): ?> class="active" <?php endif; ?>> Account Details <i class="far fa-user fl-lt"></i> </a>
<a href="<?php echo e(route('userpanel.order')); ?>" <?php if(Route::currentRouteName()=="userpanel.order"): ?> class="active" <?php endif; ?>> Orders <i class="fab fa-opencart fl-lt"></i> </a>
<a href="<?php echo e(route('userpanel.order.return')); ?>" <?php if(Route::currentRouteName()=="userpanel.order.return"): ?> class="active" <?php endif; ?>> Return & Refund <i class="fas fa-undo fl-lt"></i></a>
<a href="<?php echo e(route('userpanel.ticket')); ?>" <?php if(Route::currentRouteName()=="userpanel.ticket"): ?> class="active" <?php endif; ?>> Ticket System <i class="far fa-ticket fl-lt"></i></a>
<a href="<?php echo e(route('userpanel.changepassword')); ?>" <?php if(Route::currentRouteName()=="userpanel.changepassword"): ?> class="active" <?php endif; ?>> Change Password <i class="far fa-lock-alt fl-lt"></i></a>
<a href="javascript:void(0);" onClick="document.getElementById('logout-form').submit();" >Logout <i class="far fa-sign-out-alt fl-lt"></i></a>
</div>
</div><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/user/sidebar.blade.php ENDPATH**/ ?>