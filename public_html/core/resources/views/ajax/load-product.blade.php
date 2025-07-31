@if($products->isNotEmpty())
 @foreach($products as $row)
<div class="col-lg-3 col-md-4 col-6">
<div class="single-product bxp mb-15 wow fadeInUp" data-wow-delay=".1s">
<div class="product-thumb">
<a href="{{productURL($row->slug)}}">
 <img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->name}}" title="{{$row->name}}">
</a>
<div class="cart-btn cart-btn-1 p-abs">
<a href="javascript:void(0);" onClick="addCart('{{$row->id}}');">Add to cart</a>
</div>
<span class="discount discount-1 p-abs">{{discount($row->id)}}%</span>

@if($row->stock == 0)
 <span class="stock">Out Of Stock</span>
@endif

<div class="product-action product-action-1 p-abs">
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="quickView('{{$row->id}}');">
<i class="fal fa-eye"></i>
<i class="fal fa-eye"></i>
</a>
<a href="javascript:void(0);" class="icon-box icon-box-1" onClick="addWishlist('{{$row->id}}');">
<i class="fal fa-heart"></i>
<i class="fal fa-heart"></i>
</a>
<!--<a href="javascript:void(0);" class="icon-box icon-box-1" title="Add to compare" onClick="addCompare('{{$row->id}}');">-->
<!--<i class="fal fa-layer-group"></i>-->
<!--<i class="fal fa-layer-group"></i>-->
<!--</a>-->
</div>
</div>
<div class="product-content">
<h4 class="pro-title pro-title-1"><a href="{{productURL($row->slug)}}">{{$row->name}}</a></h4>
<div class="pro-price">
<span>{{currency()}}{{$row->price}}</span>
<del>{{currency()}}{{$row->mrp}}</del>
</div>
<!--<div class="rating">-->
<!--{!! starRating($row->id) !!}-->
<!--</div>-->
</div>
</div>
</div>
@endforeach
@else
<div class="alert alert-danger alert-dismissible fade show w-50 m-auto">
 <strong>No data available to show !</strong>.
</div>
@endif

 <script>
  $(document).ready(function(){
   var last_page = '{{$products->lastPage()}}';
   lastPage(last_page);
   var result = "Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}}";
   $('#showing-result').html(result);
  });    
 </script>