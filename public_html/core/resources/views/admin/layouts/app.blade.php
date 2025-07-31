@include('admin.layouts.header')

@include('admin.layouts.navbar')
@include('admin.layouts.sidebar')
<div class="main-content">
 @yield('content')
 @include('admin.layouts.footer-copyright')
</div>
</div>
@include('admin.layouts.footer')