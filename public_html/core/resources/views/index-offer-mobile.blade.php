@if($offers->isNotEmpty())
<div class="category-area fix pt-2 pb-20">
<div class="container-fluid">
<div class="blog-active-6 owl-carousel">
@foreach($offers as $row)
<div class="">
<a href="{{$row->link}}">
<div class="single-category p-rel wow fadeInUp" data-wow-delay=".3s" style="margin-bottom:4px">
<div class="cat-thumb fix">
<img src="{{showImage($row->image,'uploaded_files/offer')}}" alt="{{$row->name}}" title="{{$row->name}}">
</div>
<!--<div class="cat-content p-abs bottom-left"> -->
<!--<span class="cat-subtitle">{{$row->name}}</span>-->
<!--</div>-->
</div>
</a>
</div>
@endforeach
</div>
</div>
</div>
@endif

<style>


.category-area{

display: none;}


@media screen and (max-width: 600px){
.category-area {

display: block;
}}

</style>