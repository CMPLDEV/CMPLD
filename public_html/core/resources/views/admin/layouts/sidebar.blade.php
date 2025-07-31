<div class="vertical-menu">
<div class="navbar-brand-box">
<a href="" class="logo logo-dark">
<span class="logo-sm">
<img src="{{asset(showImage(setting()->logo,'uploaded_files/logo'))}}" alt="{{setting()->comp_name}}" height="60">
</span>
<span class="logo-lg">
<img src="{{asset(showImage(setting()->logo,'uploaded_files/logo'))}}" alt="{{setting()->comp_name}}" height="60">
</span>
</a>

<a href="" class="logo logo-light">
<span class="logo-lg">
<img src="{{asset(showImage(setting()->logo,'uploaded_files/logo'))}}" alt="{{setting()->comp_name}}" height="60">
</span>
<span class="logo-sm">
<img src="{{asset(showImage(setting()->logo,'uploaded_files/logo'))}}" alt="{{setting()->comp_name}}" height="60">
</span>
</a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
<i class="fa fa-fw fa-bars"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

<!--- Sidemenu -->
<div id="sidebar-menu">
<!-- Left Menu Start -->
<ul class="metismenu list-unstyled" id="side-menu"> 
<li>
<a href="{{route('home')}}" target="_blank">
<i class="icon nav-icon" data-feather="globe"></i>
<span class="menu-item" data-key="t-sales">Visit Website</span>
</a>
</li>

<li class="{{checkRoles(16)}}">
<a href="{{route('setting.advance')}}">
<i class="icon nav-icon" data-feather="tool"></i>
<span class="menu-item" data-key="t-sales">Advance Setting</span>
</a>
</li>

<li class="{{checkRoles(7)}}">
<a href="{{route('page')}}">
<i class="icon nav-icon" data-feather="file"></i>
<span class="menu-item" data-key="t-sales">Site Pages</span>
</a>
</li>

<li class="{{checkRoles(2)}}">
<a href="{{route('subadmin')}}">
<i class="icon nav-icon" data-feather="users"></i>
<span class="menu-item" data-key="t-sales">Sub Admin</span>
</a>
</li>

<li class="{{checkRoles(4)}}">
<a href="{{route('user')}}">
<i class="icon nav-icon" data-feather="user"></i>
<span class="menu-item" data-key="t-sales">User</span>
</a>
</li>

<li class="{{checkRoles(5)}}">
<a href="{{route('admin.category')}}">
<i class="icon nav-icon" data-feather="list"></i>
<span class="menu-item" data-key="t-filemanager">Category</span>
</a>
</li>

<li class="{{checkRoles(6)}}">
<a href="{{route('product')}}">
<i class="icon nav-icon" data-feather="box"></i>
<span class="menu-item" data-key="t-filemanager">Product</span>
</a>
</li>

<li class="{{checkRoles(5)}}">
<a href="{{route('admin.brand')}}">
<i class="icon nav-icon" data-feather="list"></i>
<span class="menu-item" data-key="t-filemanager">Brands</span>
</a>
</li>

<li class="{{checkRoles(19)}}">
<a href="{{route('admin.identify.product')}}">
<i class="icon nav-icon" data-feather="info"></i>
<span class="menu-item" data-key="t-filemanager">Identify Product</span>
</a>
</li>

<li class="{{checkRoles(14)}}">
<a href="{{route('admin.order')}}">
<i class="icon nav-icon" data-feather="shopping-cart"></i>
<span class="menu-item" data-key="t-filemanager">Order</span>
</a>
</li>

<li class="{{checkRoles(18)}}">
<a href="{{route('ticket')}}">
<i class="icon nav-icon" data-feather="paperclip"></i>
<span class="menu-item" data-key="t-filemanager">Ticket</span>
</a>
</li>

<li class="{{checkRoles(27)}}">
<a href="{{route('admin.return.refund')}}">
<i class="icon nav-icon" data-feather="refresh-ccw"></i>
<span class="menu-item" data-key="t-filemanager">Return & Refund</span>
</a>
</li>

<li class="{{checkRoles(29)}}">
<a href="{{route('showcase')}}">
<i class="icon nav-icon" data-feather="columns"></i>
<span class="menu-item" data-key="t-sales">Manage Showcase</span>
</a>
</li>

<li class="{{checkRoles(12)}}">
<a href="{{route('enquiry')}}">
<i class="icon nav-icon" data-feather="mail"></i>
<span class="menu-item" data-key="t-filemanager">Enquiry</span>
</a>
</li>

<li class="{{checkRoles(26)}}">
<a href="{{route('admin.testimonial')}}">
<i class="icon nav-icon" data-feather="hash"></i>
<span class="menu-item" data-key="t-filemanager">Testimonial</span>
</a>
</li>

<li class="{{checkRoles(8)}}">
<a href="{{route('slider')}}">
<i class="icon nav-icon" data-feather="image"></i>
<span class="menu-item" data-key="t-filemanager">Slider</span>
</a>
</li>

<li class="{{checkRoles(9)}}">
<a href="{{route('admin.blog')}}">
<i class="icon nav-icon" data-feather="twitch"></i>
<span class="menu-item" data-key="t-filemanager">Blog</span>
</a>
</li>

<li class="{{checkRoles(17)}}">
<a href="{{route('admin.gallery')}}">
<i class="icon nav-icon" data-feather="image"></i>
<span class="menu-item" data-key="t-filemanager">Gallery</span>
</a>
</li>

<li class="{{checkRoles(32)}}">
<a href="{{route('admin.certificate')}}">
<i class="icon nav-icon" data-feather="file-text"></i>
<span class="menu-item" data-key="t-filemanager">Certificates</span>
</a>
</li>

<li class="{{checkRoles(20)}}">
<a href="{{route('product.negotiation')}}">
<i class="icon nav-icon" data-feather="mail"></i>
<span class="menu-item" data-key="t-filemanager">Product Negotiation</span>
</a>
</li>

<li class="{{checkRoles(23)}}">
<a href="{{route('admin.offer')}}">
<i class="icon nav-icon" data-feather="percent"></i>
<span class="menu-item" data-key="t-filemanager">Offer</span>
</a>
</li>

<li class="{{checkRoles(13)}}">
<a href="{{route('admin.coupon')}}">
<i class="icon nav-icon" data-feather="gift"></i>
<span class="menu-item" data-key="t-filemanager">Coupon</span>
</a>
</li>

<li class="{{checkRoles(24)}}">
<a href="{{route('admin.product.reviews')}}">
<i class="icon nav-icon" data-feather="message-square"></i>
<span class="menu-item" data-key="t-filemanager">Product Reviews</span>
</a>
</li>

<li class="{{checkRoles(30)}}">
<a href="{{route('admin.faq')}}">
<i class="icon nav-icon" data-feather="help-circle"></i>
<span class="menu-item" data-key="t-filemanager">FAQ's</span>
</a>
</li>

<li class="{{checkRoles(25)}}">
<a href="{{route('admin.location')}}">
<i class="icon nav-icon" data-feather="map-pin"></i>
<span class="menu-item" data-key="t-filemanager">Location Pincodes</span>
</a>
</li>

<li class="{{checkRoles(21)}}">
<a href="{{route('our.client')}}">
<i class="icon nav-icon" data-feather="disc"></i>
<span class="menu-item" data-key="t-filemanager">Our Client</span>
</a>
</li>

<li class="{{checkRoles(22)}}">
<a href="{{route('our.partner')}}">
<i class="icon nav-icon" data-feather="grid"></i>
<span class="menu-item" data-key="t-filemanager">Our Partner</span>
</a>
</li>

<li class="{{checkRoles(28)}}">
<a href="{{route('our.associates')}}">
<i class="icon nav-icon" data-feather="grid"></i>
<span class="menu-item" data-key="t-filemanager">Our Associates</span>
</a>
</li>

<li class="{{checkRoles(31)}}">
<a href="{{route('log')}}">
<i class="icon nav-icon" data-feather="hexagon"></i>
<span class="menu-item" data-key="t-filemanager">Log History</span>
</a>
</li>

<li class="{{checkRoles(15)}}">
<a href="{{route('admin.subscription')}}">
<i class="icon nav-icon" data-feather="bookmark"></i>
<span class="menu-item" data-key="t-filemanager">Newsletter</span>
</a>
</li>

<li class="{{checkRoles(10)}}">
<a href="{{route('marketplace')}}">
<i class="icon nav-icon" data-feather="map"></i>
<span class="menu-item" data-key="t-filemanager">Market Place</span>
</a>
</li>

<li class="{{checkRoles(11)}}">
<a href="{{route('productseo')}}">
<i class="icon nav-icon" data-feather="bar-chart-2"></i>
<span class="menu-item" data-key="t-filemanager">Product SEO</span>
</a>
</li>

</ul>
</div>
<!-- Sidebar -->
</div>
</div>
