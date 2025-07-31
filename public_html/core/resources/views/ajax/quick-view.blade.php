<div class="product__modal-inner position-relative">
<div class="product__modal-close">
<button data-bs-dismiss="modal" aria-label="Close">
<i class="ti-close"></i>
</button>
</div>
<div class="product__modal-left">
<div class="tab-content mb-10" id="productModalThumb">

<div class="tab-pane fade show active" id="pro-1" role="tabpanel" aria-labelledby="pro-1-tab">
<div class="product__modal-thumb w-img">
<img src="{{showImage($data->image,'uploaded_files/product')}}" alt="{{$data->image_alt}}" title="{{$data->image_title}}">
</div>
</div>

@foreach($more_images as $row)
<div class="tab-pane fade" id="pro-{{$row->id}}" role="tabpanel" aria-labelledby="pro-{{$row->id}}-tab">
<div class="product__modal-thumb w-img">
<img src="{{showImage($row->image,'uploaded_files/more_image')}}" alt="{{$data->image_alt}}" title="{{$data->image_title}}">
</div>
</div>
@endforeach

</div>
@if($more_images->isNotEmpty())
<div class="product__modal-nav">
<ul class="nav nav-tabs" id="productModalNav" role="tablist">

<li class="nav-item" role="presentation">
<button class="nav-link active" id="pro-1-tab" data-bs-toggle="tab" data-bs-target="#pro-1" type="button" role="tab" aria-controls="pro-1" aria-selected="true">
<img src="{{showImage($data->image,'uploaded_files/product')}}" alt="{{$data->image_alt}}" title="{{$data->image_title}}">
</button>
</li>

@foreach($more_images as $row)
<li class="nav-item" role="presentation">
<button class="nav-link" id="pro-{{$row->id}}-tab" data-bs-toggle="tab" data-bs-target="#pro-{{$row->id}}" type="button" role="tab" aria-controls="pro-{{$row->id}}" aria-selected="false">
<img src="{{showImage($row->image,'uploaded_files/more_image')}}" alt="{{$data->image_alt}}" title="{{$data->image_title}}">
</button>
</li>
@endforeach

</ul>
</div>
@endif
</div>
<div class="product__modal-right">
<h5 class="">
<a href="{{productURL($data->slug)}}">{{$data->name}}</a>
</h5>
<div class="product__modal-rating d-flex align-items-center">
{!! starRating($data->id) !!}
<div class="customer-review">
<a href="#">({{totalReviews($data->id)}} customer review)</a>
</div>
</div>
<div class="product__modal-price mb-10">
<span class="price new-price">{{currency()}}{{$data->price}}</span>
<span class="price old-price">{{currency()}}{{$data->mrp}}</span>
</div>
<div class="product__modal-price mb-10">
<b>Availability:</b>
@if($data->is_eol) <span class="badge bg-danger">End of life</span> @else {!! stockBadge($data->stock) !!} @endif
</div>

@if(!empty($data->sku))
<div class="product__modal-sku">
<b> SKU: </b> <span> {{$data->sku}}</span>
</div>
@endif

<div class="product__modal-quantity mb-15 mt-4">
<h5>Quantity:</h5>
<form action="#">
<div class="pro-quan-area d-sm-flex align-items-center">
<div class="product-quantity mr-20 mb-25">
<div class="cart-plus-minus">
<div class="dec qtybutton" onClick="decrementQty();">-</div>    
<input class="cart-plus-minus-box" type="text" name="qtybutton" value="1" id="qty" readonly="">
<div class="inc qtybutton" onClick="incrementQty();">+</div>
</div>
</div>
<div class="product__modal-cart mb-25">
<button class="product-modal-cart-btn " type="button" onClick="addCart('{{$data->id}}');">Add to cart</button>
</div>
</div>
</form>
</div>


</div>
</div>