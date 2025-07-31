@if($blogs->isNotEmpty())
<div class="blog-area pt-50 pb-50">
<div class="container">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
<span class="p-subtitle p-subtitle-2">Explore The Blog</span>
<h3 class="p-title pb-15 mb-0">Latest Blog Posts</h3>
</div>
</div>
</div>
<div class="blog-active owl-carousel">
@foreach($blogs as $row)
<div class="col-xxl-12">
<div class="single-blog wow fadeInUp" data-wow-delay=".4s">
<div class="blog-thumb">
<a href="{{route('blog.detail',$row->slug)}}"><img src="{{showImage($row->image,'uploaded_files/blog')}}" alt="{{$row->alt}}" title="{{$row->title}}"></a>
</div>
<div class="blog-content blog-content-3">
<div class="blog-meta blog-meta-2">Post date <a href="#"><span>{{date('d M, Y',strtotime($row->updated_at))}}</span></a>.
</div>
<h5 class="blog-title blog-title-2"><a href="{{route('blog.detail',$row->slug)}}">{{$row->name}}</a></h5>
<div class="border-bottom-gray border-0">
<p>{{Str::limit(strip_tags($row->content),100,$end='..')}}</p>
<div class="p-btn p-btn-3">
<a href="{{route('blog.detail',$row->slug)}}">Continue Reading</a>
</div>
</div>
</div>
</div>
</div>
@endforeach

</div>
</div>
</div>
@endif