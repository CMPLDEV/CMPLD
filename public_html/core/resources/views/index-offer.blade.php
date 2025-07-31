@if($offers->isNotEmpty())
<div class="container mt-4 mb-4">
<div class="row">
@foreach($offers as $row)     
<div class="col-lg-3">
<div class="card">
<a href="{{$row->link}}" target="_blank">   
<div class="card-body">
<img src="{{showImage($row->image, 'uploaded_files/offer')}}" alt="{{$row->name}}" width="100%" />    
</div>   
<!--<div class="card-footer">
{{$row->name}}    
</div>-->
</a>
</div>       
</div>
@endforeach
</div>
</div>
@endif

<style>

@media screen and (max-width: 600px){
.card {
    
    display: none;
}}
</style>