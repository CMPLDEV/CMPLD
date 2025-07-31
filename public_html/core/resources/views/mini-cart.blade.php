@if($carts->isNotEmpty())
<div class="cartmini__list">
<ul>
@foreach($carts as $row)
<li class="cartmini__item p-rel d-flex align-items-start">
<div class="cartmini__thumb mr-15">
<a href="{{productURL($row->slug)}}">
<img src="{{showImage($row->image,'uploaded_files/product')}}" alt="{{$row->image_alt}}" title="{{$row->image_title}}">
</a>
</div>
<div class="cartmini__content">
<h3 class="cartmini__title">
<a href="{{productURL($row->slug)}}">{{$row->name}}</a>
</h3>
<span class="cartmini__price">
<span class="price">{{$row->quantity}} × {{currency()}}{{$row->price}}</span>
</span>
</div>
<a href="{{route('cart.remove',$row->id)}}" class="cartmini__remove">
<i class="fal fa-times"></i>
</a>
</li>
@endforeach
</ul>
</div>
<div class="price-total">
    <div class="cartmini__total d-flex align-items-center justify-content-between">
<h5>Subtotal</h5>
<span>{{currency()}} {{cartTotal()}}</span>
</div>
<div class="cartmini__bottom">
<a href="{{route('cart')}}" class="s-btn w-100 mb-20">view cart</a>
<a href="{{route('checkout')}}" class="s-btn s-btn-2 w-100">checkout</a>
</div>
</div>
@else

<div class="empty-cart text-center">
    <div class="">
        <img src="assets/img/empty-cart-illustration.gif" alt="" title="">
    </div>
    <div class="empty-cart-text">
        <h4>There is nothing in your bag.</h4>
        <div class="css-1i27f3a ei037z21 text-center"><button class="css-1h4559r e8tshxd0"><a href="">Start Shopping</a></button></div>
    </div>
</div>

@endif