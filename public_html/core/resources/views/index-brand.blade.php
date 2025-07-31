@if($brands->isNotEmpty())
<div class="category-area fix mt-3-px pb-75 ">
<div class="row row-3">
@foreach($brands as $row)
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-12">
<a href="{{categoryURL($row->slug)}}">
<div class="single-category p-rel wow fadeInUp" data-wow-delay=".3s" style="margin-bottom:4px">
<div class="cat-thumb fix">
<img src="{{showImage($row->image,'uploaded_files/category')}}" alt="{{$row->name}}" title="{{$row->name}}">
</div>
<div class="cat-content p-abs bottom-left"> 
<span class="cat-subtitle">{{$row->name}}</span>
</div>
</div>
</a>
</div>
@endforeach
</div>
</div>
@endif

