@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<style>
    .breadcrumb-wrapper-2 h3 {
    color: #ffffff;
    font-size: 40px;
    letter-spacing: 1px;
}
.breadcrumb-area-3 {
    padding: 80px 0;
}
</style>

<main>

<!-- breadcrumb area start -->
<div class="breadcrumb-area-3" style="background-image:url('assets/img/cart-banner.jpg');background-size: cover;">
<div class="container">
<div class="row">
<div class="col-xxl-12">     
<div class="breadcrumb-wrapper-2 text-center">
<h3>Wishlist</h3>
<nav aria-label="breadcrumb">
<ol class="breadcrumb justify-content-center">
<li class="breadcrumb-item"><a href="">Home</a></li>
<li class="breadcrumb-item active text-white" aria-current="page">Wishlist</li>
</ol>
</nav>
</div>                    
</div>
</div>
</div>
</div>
<!-- breadcrumb area end -->

<!-- Cart Area Strat-->
<section class="cart-area pt-100 pb-100">
<div class="container">
<div class="row">
@if($products->isNotEmpty())    
<div class="col-12">
<form action="#">
<div class="table-content table-responsive">
<table class="table">
<thead>
<tr>
<th class="product-thumbnail">Images</th>
<th class="cart-product-name">Product</th>
<th class="product-price">Unit Price</th>
<th class="product-quantity">Stock</th>
<th class="product-remove">Action</th>
</tr>
</thead>
<tbody>
@foreach($products as $row)
<tr>
<td class="product-thumbnail"><a href="{{productURL($row->slug)}}"><img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->image_alt}}" title="{{$row->image_title}}"></a></td>
<td class="product-name"><a href="{{productURL($row->slug)}}">{{$row->name}}</a></td>
<td class="product-price"><span class="amount">{{currency()}}{{$row->price}}</span></td>
<td class="product-name">{!!stockBadge($row->stock)!!}</td>
<td class="product-remove">
 <a href="javascript:void(0);" onClick="addCart('{{$row->pro_id}}');" class="btn btn-primary">Add to cart</a>   
 <a href="{{route('wishlist.remove',$row->id)}}"><i class="fa fa-times"></i></a>
</td>
</tr>
@endforeach
</tbody>
</table>
{{$products->appends($_GET)->links()}}
</div>
</form>
</div>
@else
 <center><h4 style="margin-top:50px;color:indianred">No Data Available To Show.</h4></center>
@endif
</div>
</div>
</section>
<!-- Cart Area End-->

</main>

@endsection