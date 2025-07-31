<div class="user-profile">
<div class="user-specs">
<h3>My Account</h3>
</div>
<div class="menu-profile">
<a href="{{route('userpanel')}}" @if(Route::currentRouteName()=="userpanel") class="active" @endif> Dashboard <i class="fas fa-chart-line fl-lt"></i></a>
<a href="{{route('userpanel.profile')}}" @if(Route::currentRouteName()=="userpanel.profile") class="active" @endif> Account Details <i class="far fa-user fl-lt"></i> </a>
<a href="{{route('userpanel.order')}}" @if(Route::currentRouteName()=="userpanel.order") class="active" @endif> Orders <i class="fab fa-opencart fl-lt"></i> </a>
<a href="{{route('userpanel.order.return')}}" @if(Route::currentRouteName()=="userpanel.order.return") class="active" @endif> Return & Refund <i class="fas fa-undo fl-lt"></i></a>
<a href="{{route('userpanel.ticket')}}" @if(Route::currentRouteName()=="userpanel.ticket") class="active" @endif> Ticket System <i class="far fa-ticket fl-lt"></i></a>
<a href="{{route('userpanel.changepassword')}}" @if(Route::currentRouteName()=="userpanel.changepassword") class="active" @endif> Change Password <i class="far fa-lock-alt fl-lt"></i></a>
<a href="javascript:void(0);" onClick="document.getElementById('logout-form').submit();" >Logout <i class="far fa-sign-out-alt fl-lt"></i></a>
</div>
</div>