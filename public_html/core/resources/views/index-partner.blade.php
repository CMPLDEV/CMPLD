@if($our_partners->isNotEmpty())
<div class="container pb-15 mt-5">
<div class="row">
<div class="col-lg-12">
<div class="section-title text-center">
<h3 class="p-title mb-0">Our Partners</h3>
</div>      
<div class="custom-slick">
@foreach($our_partners as $row)    
<div style="border: 1px solid lightgrey; border-radius: 5px;padding:10px;margin-right:10px;">
<img src="{{showImage($row->image, 'uploaded_files/our_partner')}}" />
<p class="text-muted text-center mt-2 fw-bold">{{Str::limit($row->title, 25, $end='..')}}</p>
</div>
@endforeach
</div>  
</div>     
</div>    
</div>
@endif