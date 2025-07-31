<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1"> 
<meta name="csrf-token" content="{{ csrf_token() }}"> 
<meta name="robots"@if(setting()->meta_robots) content="index,follow" @else content="noindex,nofollow" @endif>
<base href="{{url('/')}}">
<title>@yield('title')</title>
<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
@if(Route::is('product.detail'))
<meta property="og:title" content="@yield('og_title')" />
<meta property="og:description" content="@yield('og_description')" />
<meta property="og:type" content="website" />
<meta property="og:image" content="@yield('og_image')" />
<meta property="og:image:type" content="image/*" />
<meta property="og:image:height" content="300" />
<meta property="og:image:width" content="300" />
<meta property="og:site_name" content="{{setting()->comp_name}}" />
<meta property="og:url" content="{{Request::fullUrl()}}" />

<script type="application/ld+json">
{
"@context": "https://schema.org/", 
"@type": "Product", 
"name": "{{$data->name}}",
"image": "{{setting()->website_url}}/uploaded_files/product/{{$data->image}}",
"description": "@yield('og_description')",
"brand": {
"@type": "Brand",
"name": "{{$data->brand}}"
},
"sku": "{{$data->sku}}",
"mpn": "{{$data->asin}}",
"offers": {
"@type": "Offer",
"url": "{{Request::fullUrl()}}",
"priceCurrency": "INR",
"price": "{{$data->price}}",
"availability": "https://schema.org/InStock",
"itemCondition": "https://schema.org/NewCondition"
},
"aggregateRating": {
"@type": "AggregateRating",
"ratingValue": "4.5",
"ratingCount": "1"
}
}
</script>
@else 
{!! setting()->site_schema !!}
@endif

@if(!empty(setting()->favicon))
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploaded_files/favicon/'.setting()->favicon) }}">
@endif

<meta name="author" content="{{setting()->company_name}}">
<link rel="canonical" href="{{Request::fullUrl()}}" />
<link rel="stylesheet" href="assets/css/preloader.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<link rel="stylesheet" href="assets/css/meanmenu.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/slick.css">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link href="assets/glightbox/css/glightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/nice-select.css">
<link rel="stylesheet" href="assets/css/ui-range-slider.css">
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="admin_assets/css/alertify/alertify.min.css"/>
<link rel="stylesheet" href="admin_assets/css/alertify/default.min.css"/>
<link rel="stylesheet" href="assets/css/rating.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css" integrity="sha512-uq8QcHBpT8VQcWfwrVcH/n/B6ELDwKAdX4S/I3rYSwYldLVTs7iII2p6ieGCM13QTPEKZvItaNKBin9/3cjPAg==" crossorigin=anonymous >
@yield('custom-css')
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/menu.js"></script>
<script src="https://cdn.razorpay.com/widgets/affordability/affordability.js">
</script>
{!! setting()->site_verification !!}
{!! setting()->analytics !!}
</head>
<body>
{{generateSession()}}

<!-- preloader start -->
<!--<div id="loading ">-->
<!--<div id="loading-center">-->
<!--<div id="loading-center-absolute">-->
<!--    <img src="assets/img/computer.gif">-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!-- preloader end -->