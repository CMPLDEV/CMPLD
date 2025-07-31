@if($slider->isNotEmpty())
@php $i = 1; @endphp
<div class="container-fluid">
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-inner" 
style="border-radius: 20px;margin-top: 10px;box-shadow: 0px 0px 5px 0px lightgrey;">
@foreach($slider as $row)
<div class="carousel-item @if($i++ == 1) active @endif">
<a href="{{$row->link}}">    
<img src="uploaded_files/slider/{{$row->image}}" class="d-block w-100" alt="{{$row->title}}" title="{{setting()->comp_name}}">
</a> 
</div>
@endforeach

</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="visually-hidden">Previous</span>
</button>
<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
<span class="visually-hidden">Next</span>
</button>
</div>   

</div>
@endif


<section class="bg-light py-2">
<div class="container-fluid">
<div class="row">
<div class="col-md-6 col-lg-3">
<div class="media align-items-top">
<img src="assets/img/deliverry.png" alt="delivery">
<div class="media-body ml-4">
<h4 class="h6">Delivery All Over India</h4>
<p class="mbb">On Time Safe Delivery</p>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="media align-items-top">
<img src="assets/img/return.png" alt="return">
<div class="media-body ml-4">
<h4 class="h6">24 Hours Return</h4>
<p class="mbb">Wrong Product Free Return</p>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="media align-items-top">
<img src="assets/img/quality.png" alt="quality">
<div class="media-body ml-4">
<h4 class="h6">Quality Guarantee</h4>
<p class="mbb">Product Checked by Expert team</p>
</div>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="media align-items-top">
<img src="assets/img/support.png" alt="">
<div class="media-body ml-4">
<h4 class="h6">Support 24/7</h4>
<p class="mbb">Direct Service Support by Experts</p>
</div>
</div>
</div>

</div>
</div>
</section>

<style>
.bg-light {
padding-bottom: 20px !important;
padding-top: 20px !important;
background: #e8eff994 !important;
margin-top: 10px;
}
.media.align-items-top {
display: flex;
align-items: start;
}
.media.align-items-top img {
max-width: 100px;
margin-top: -30px;
}
.ml-4, .mx-4 {
margin-left: 15px !important;
}
.h6 {
font-size: 15px;
}
.mbb{
font-size: 12px;
line-height: 10px;}
</style>