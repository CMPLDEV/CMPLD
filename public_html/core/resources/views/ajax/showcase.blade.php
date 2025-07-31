@if($showcases->isNotEmpty())
 @foreach($showcases as $showcase)
<div class="top-selling-product pb-50">
<div class="container-fluid">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
@if(empty($showcase->banner))    
 <span class="p-subtitle p-subtitle-2">Explore {{$showcase->name}}</span>
 <h3 class="p-title pb-15 mb-0">Best Products</h3>
@else
 <a href="{{$showcase->url}}" class="cat_banner"> <img src="uploaded_files/showcase/{{$showcase->banner}}" title="{{setting()->comp_name}}" alt="{{setting()->comp_name}}" width="100%" /> </a>
@endif
</div>
</div>
</div>

<div class="row">
<div class="col-xxl-12">
<div class="top-selling-active-2 owl-carousel pt-4">
@foreach($showcase->products as $row)
<div class="single-product mb-15 wow fadeInUp bxp" data-wow-delay=".1s">
<div class="product-thumb"><a href="{{productURL($row->slug)}}">
<img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->name}}" title="{{$row->name}}"></a>
<div class="cart-btn cart-btn-2 p-abs">
<a href="javascript:void(0);" onClick="addCart('{{$row->product_id}}');">Add to cart</a>
</div>
<span class="discount discount-3 p-abs">{{discount($row->product_id)}}%</span>
@if($row->stock == 0)
 <span class="stock">Out Of Stock</span>
@endif

<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('{{$row->product_id}}');">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('{{$row->product_id}}');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
</div>
</div>
<div class="product-content">
<h4 class="pro-title pro-title-2"><a href="{{productURL($row->slug)}}">{{$row->name}}</a></h4>
<div class="pro-price">
<span>{{currency()}}{{$row->price}}</span>
<del>{{currency()}}{{$row->mrp}}</del>
</div>
<!--{!! starRating($row->product_id) !!}-->
</div>
</div>
@endforeach
</div>
</div>
</div>
<div class="row">
<div class="col-lg-12 text-center">
<div class="p-btn p-btn-1 wow fadeInUp" data-wow-delay="1.2s">
 <a href="{{$showcase->url}}">View All</a>
</div>
</div>
</div>
</div>
</div>
 @endforeach
@endif