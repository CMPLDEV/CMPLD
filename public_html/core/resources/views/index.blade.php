@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('content')

<main>
 @include('index-slide')
 @include('index-offer')
 @include('index-offer-mobile')
 @include('index-category') 
 @include('index-showcase')
 @include('index-testimonial')
 @include('index-client')
 @include('index-partner')
 @include('index-associates')
 @include('index-blog')
</main>
@endsection

@section('custom-script')
<script>
$(document).ready(function(){
/* PARTNER LOGOS */
 $('.custom-slick').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 1500,
  arrows: false,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

/* TESTIMONIAL */
 $(".owl-carousel").owlCarousel({
  items:3,
  autoplay:true,
  margin:30,
  loop:true,
 });

});    
</script>
@endsection