@if($featured_products->isNotEmpty())
<div class="top-selling-area pt-0 pb-50">
<div class="container">
<div class="row">
<div class="col-xxl-12">
<div class="section-title top-selling-title text-center">
<span class="p-subtitle p-subtitle-2">Explore The Products</span>
<h3 class="p-title pb-15 mb-0">Top Selling Products</h3>
<p class="p-desc"></p>
</div>
</div>
</div>
<div class="row pb-20">
@foreach($featured_products as $row)
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-6">
<div class="single-product mb-15 wow fadeInUp bxp" data-wow-delay=".1s">
<div class="product-thumb"><a href="{{productURL($row->slug)}}">
<img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->name}}" title="{{$row->name}}"></a>
<div class="cart-btn cart-btn-1 p-abs">
<a href="javascript:void(0);" onClick="addCart('{{$row->id}}');">Add to cart</a>
</div>
<span class="discount discount-3 p-abs">{{discount($row->id)}}%</span>
@if($row->stock == 0)
 <span class="stock">Out Of Stock</span>
@endif

<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('{{$row->id}}');" data-bs-toggle="modal" data-bs-target="#productModal">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('{{$row->id}}');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
</div>
</div> 
<div class="product-content">
<h4 class="pro-title pro-title-1"><a href="{{productURL($row->slug)}}">{{$row->name}}</a></h4>
<div class="pro-price">
<span>{{currency()}}{{$row->price}}</span>
<del>{{currency()}}{{$row->mrp}}</del>
</div>
<!--{!! starRating($row->id) !!}-->
</div>
</div>
</div>
@endforeach

</div>
<div class="row">
<div class="col-xxl-12">
<div class="btn-area text-center wow fadeInUp" data-wow-delay="1.2s">
<div class="p-btn p-btn-1"><a href="all-categories.html">SHOW ALL PRODUCTS</a></div>
</div>
</div>
</div>
</div>
</div>
@endif