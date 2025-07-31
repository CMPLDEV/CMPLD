@if($testimonials->isNotEmpty())
<section class="testimonials">
<div class="container-test">
<div class="row">
<div class="col-xxl-12">
<div class="section-title text-center">
<h3 class="p-title mb-0">Google Review's</h3>
</div>
</div>
</div>

<div class="owl-carousel client-testimonial-carousel">
@foreach($testimonials as $row) 
<div class="single-testimonial-item">
<p>{{$row->content}}</p>
<h3> {{$row->name}} <span class="text-muted">{{$row->designation}}</span> </h3>
<img src="{{showImage($row->image, 'uploaded_files/testimonial')}}" alt="{{$row->name}}" class="rounded-circle" width="100" />
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
<i class="fas fa-star mk"></i>
</div>
@endforeach
</div>

</div>
</section>
@endif

