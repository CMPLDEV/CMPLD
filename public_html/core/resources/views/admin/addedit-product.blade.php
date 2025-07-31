@extends('admin.layouts.app')
@section('title','Product List')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Product List</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Product List</li>
</ol>
</div>

</div>
</div>
</div>
<!-- end page title -->

<div class="row">

<div class="col-lg-12">

<div class="card">
<div class="card-body">
<h5 class="card-title">@isset($edit) Edit @else Add @endisset Product
<a href="{{route('product')}}" class="btn btn-info btn-sm float-end text-white">Back</a></h5>

<hr>

<form method="post" enctype="multipart/form-data" @isset($edit) action="{{route('product.update',$edit->id)}}" @else action="{{route('product.create')}}" @endisset>
 @csrf
 
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-bs-toggle="tab" href="#general">General</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#desc">Description</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#additional_attributes">Additional Attributes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#variants">Variants</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#more_images">More Images/Banner</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-bs-toggle="tab" href="#seo">SEO</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="general">
  
  <div class="row mb-3">

<div class="col-lg-3">
 @if(isset($edit) && !empty($edit->image))
  <img src="{{asset(showImage($edit->image,'uploaded_files/product'))}}" alt="image" width="150">
   <br> <a href="{{route('product.remove.image',[$edit->id,'image'])}}" class="text-danger">Remove</a>
 @else 
  <img src="{{asset(noImage())}}" alt="image" width="100%" class="img-thumbnail">   
 @endif 
 <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"> 
 <span class="text-danger"><strong>679px x 679px</strong> , <strong>Size:</strong> 150 KB</span>
 @error('image')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror  
</div>

<div class="col-sm-9">
@if(isset($edit) && !empty($edit->banner))
  <img src="{{asset(showImage($edit->banner,'uploaded_files/product'))}}" alt="image" width="100%">
   <br> <a href="{{route('product.remove.image',[$edit->id,'banner'])}}" class="text-danger">Remove</a>
 @else 
  <img src="{{asset(noBanner())}}" alt="image" width="100%" class="img-thumbnail">   
 @endif 
 <input type="file" name="banner" id="banner" class="form-control @error('banner') is-invalid @enderror mt-2"> 
 <span class="text-danger"><strong>Dimension:</strong> 1500px x 300px, <strong>Size:</strong> 200 KB</span>
 @error('banner')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

</div>

  <div class="row">
 
 <div class="col-sm-8">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" name="name" placeholder="Enter Name" @isset($edit) value="{{$edit->name}}" @else value="{{old('name')}}" @endisset>
 <label for="floatingInput">Name</label>
  @error('name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>   
 
 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('sku') is-invalid @enderror" id="floatingInput" name="sku" placeholder="Enter SKU" @isset($edit) value="{{$edit->sku}}" @else value="{{old('sku')}}" @endisset>
 <label for="floatingInput">SKU</label>
  @error('sku')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
 </div>

 <div class="col-sm-2">
 <div class="form-floating mb-3">
 <select class="form-control @error('status') is-invalid @enderror" name="status">
  <option value="1" @isset($edit) @if($edit->status == 1) selected @endif @endisset>ACTIVE</option>
  <option value="0" @isset($edit) @if($edit->status == 0) selected @endif @endisset>INACTIVE</option>
 </select>
 <label for="floatingInput">Choose Status</label>
  @error('status')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

</div>

  <div class="row">

<!-- <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" onChange="categoryForm(this.value);" @isset($edit) disabled @endisset>
  </select>-->

<div class="col-sm-3">
<div class="form-floating mb-3">
 <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" onChange="categoryForm(this.value);" @if(isset($edit) && !empty($edit->category_id)) disabled @endif>
 <option value="">Choose Category</option>
  @foreach($categories as $row)
  <option value="{{$row->id}}" @isset($edit) @if($row->id == $edit->category_id) selected @endif @endisset> &nbsp; {{$row->name}} </option>
   @foreach(adminCategories($row->id) as $row)
   <option value="{{$row->id}}" @isset($edit) @if($row->id == $edit->category_id) selected @endif @endisset> &nbsp; - {{$row->name}} </option>
   @endforeach
  @endforeach
  </select>
  <label>Categories</label>
  @error('category_id')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>
    
<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('mrp') is-invalid @enderror" id="floatingInput" name="mrp" placeholder="Enter MRP" @isset($edit) value="{{$edit->mrp}}" @else value="{{old('mrp')}}" @endisset title="Enter MRP">
 <label for="floatingInput"> MRP Price </label>
  @error('mrp')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('price') is-invalid @enderror" id="floatingInput" name="price" placeholder="Enter Price" @isset($edit) value="{{$edit->price}}" @else value="{{old('price')}}" @endisset title="Enter Price, if product is for sale.">
 <label for="floatingInput">Sale Price</label>
  @error('price')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('stock') is-invalid @enderror" id="floatingInput" name="stock" placeholder="Enter Stock" @isset($edit) value="{{$edit->stock}}" @else value="{{old('stock')}}" @endisset title="Enter Stock.">
 <label for="floatingInput">Stock</label>
  @error('stock')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('asin') is-invalid @enderror" id="floatingInput" name="asin" placeholder="Enter Asin" @isset($edit) value="{{$edit->asin}}" @else value="{{old('asin')}}" @endisset title="Enter Asin.">
 <label for="floatingInput">Asin</label>
  @error('asin')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>
    
</div>

  <div class="row"> 

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('keywords') is-invalid @enderror" id="floatingInput" name="keywords" placeholder="Enter Keywords" @isset($edit) value="{{$edit->keywords}}" @else value="{{old('keywords')}}" @endisset>
 <label for="floatingInput">Product Keywords</label>
  @error('keywords')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('video') is-invalid @enderror" id="floatingInput" name="video" placeholder="Enter Video Code" @isset($edit) value="{{$edit->video}}" @else value="{{old('video')}}" @endisset maxlength="11">
 <label for="floatingInput">Youtube Video [11 digits code]</label>
  @error('video')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

 <div class="col-sm-3">
 <div class="form-floating mb-3">
 <select class="form-control @error('warranty_period') is-invalid @enderror" name="warranty_period">
  @for($i = 1; $i <= 36; $i++)
   <option value="{{$i}}" @isset($edit) @if($edit->warranty_period == $i) selected @endif @endisset>{{$i}}</option>
  @endfor
 </select>
 <label for="floatingInput">Choose Warranty Duration (Months)</label>
  @error('warranty_period')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
<div class="form-floating mb-3">
 <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
 <option value="">Choose Brand</option>
  @foreach($brands as $row)
  <option value="{{$row->id}}" @isset($edit) @if($row->id == $edit->brand_id) selected @endif @endisset> &nbsp; {{$row->name}} </option>
  @endforeach
  </select>
  <label>Brands</label>
  @error('brand_id')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/replacement.png" alt="Replacement" width="30"></label>    
 <input type="text" class="form-control @error('replacement') is-invalid @enderror" id="floatingInput" name="replacement" @isset($edit) value="{{$edit->replacement}}" @else value="{{old('replacement')}}" @endisset>
  @error('replacement')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/delivery.png" alt="Delivery" width="30"></label>    
 <input type="text" class="form-control @error('delivery') is-invalid @enderror" id="floatingInput" name="delivery" @isset($edit) value="{{$edit->delivery}}" @else value="{{old('delivery')}}" @endisset>
  @error('delivery')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/shield.png" alt="Warranty" width="30"></label>     
 <input type="text" class="form-control @error('warranty') is-invalid @enderror" id="floatingInput" name="warranty" @isset($edit) value="{{$edit->warranty}}" @else value="{{old('warranty')}}" @endisset>
  @error('warranty')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
</div>

  <div class="row mt-3">
    
<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/badge.png" alt="Brand" width="30"></label>    
 <input type="text" class="form-control @error('brand') is-invalid @enderror" id="floatingInput" name="brand" @isset($edit) value="{{$edit->brand}}" @else value="{{old('brand')}}" @endisset>
  @error('brand')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/bluedart.png" alt="Blue Dart" width="30"></label>    
 <input type="text" class="form-control @error('bluedart') is-invalid @enderror" id="floatingInput" name="bluedart" @isset($edit) value="{{$edit->bluedart}}" @else value="{{old('bluedart')}}" @endisset>
  @error('bluedart')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

<div class="col-sm-4">
 <label for="floatingInput"><img src="assets/img/secure-transaction.png" alt="Secure Transaction" width="30"></label>    
 <input type="text" class="form-control @error('secure') is-invalid @enderror" id="floatingInput" name="secure" @isset($edit) value="{{$edit->secure}}" @else value="{{old('secure')}}" @endisset>
  @error('secure')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>

</div>
  
  </div>
  <div class="tab-pane container fade" id="desc">
      
  <div class="col-sm-12 mb-3 mt-2">
 <label for="floatingInput">Short Description</label>
 <textarea type="text" class="form-control" id="short_content" rows="3" name="short_content" placeholder="Enter Short Description" @isset($edit) value="{{$edit->short_content}}" @else value="{{old('short_content')}}" @endisset>@isset($edit) {{$edit->short_content}} @endisset</textarea>
  @error('short_content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
<script>CKEDITOR.replace('short_content');</script>      
  
  <div class="col-sm-12 mt-3">
<label for="">Description</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="content" rows="4" name="content" placeholder="Enter Content" >@isset($edit){{$edit->content}}@endisset</textarea>
  @error('content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>
<script>CKEDITOR.replace('content');</script>

<div class="col-sm-12 mt-3">
<label for="">Additional Information</label> 
 <div class="form-floating mb-3"> 
 <textarea type="text" class="form-control" id="additional_information" rows="4" name="additional_information" placeholder="Enter Content" >@isset($edit){{$edit->additional_information}}@endisset</textarea>
  @error('additional_information')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>
<script>CKEDITOR.replace('additional_information');</script>
  
  </div>
  <div class="tab-pane container fade" id="additional_attributes">
   <br/>
@isset($edit)
 @if($attributes->isNotEmpty())
  @foreach($attributes as $row)
   @php
    $cat_attr_values = array_map('trim', explode(',',$row->cat_attr_value));
   @endphp
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="{{$row->cat_attr_id}}" />     
    
<div class="col-sm-6">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="{{$row->pro_attr_key}}" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-6">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 @foreach($cat_attr_values as $value)
  <option value="{{$value}}" @if($value == $row->pro_attr_value) selected @endif>{{$value}}</option>
 @endforeach
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  @endforeach
 @endif
 
<!-- NON ADDED ATTRIBUTES --> 
 
@if($category_attributes->isNotEmpty())
 @foreach($category_attributes as $row)
  @php
   $values = explode(',',$row->value);
  @endphp
<div class="row element">

<input type="hidden" name="cat_attr_id[]" value="{{$row->id}}" />    
    
<div class="col-sm-6">
<div class="form-floating mb-3">
<input type="text" class="form-control" id="floatingInput" name="key[]" placeholder="Key" value="{{$row->key}}" readonly><label for="floatingInput">Key</label>
</div>
</div>

<div class="col-sm-6">
<div class="form-floating mb-3">
<select class="form-control" name="value[]">
 <option value="none">None</option>
 @foreach($values as $value)
  <option value="{{$value}}">{{$value}}</option>
 @endforeach
</select>    
<label for="floatingInput">Value</label>
</div>
</div>

</div>
  @endforeach
 @endif
 
@endisset

<div id="more_attributes"></div>
  
  </div>
  <div class="tab-pane container fade" id="variants">
   
   <div class="row mt-2">
    <h6>Variant 1</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant1_title') is-invalid @enderror" id="floatingInput" name="variant1_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant1_title}}" @else value="{{old('variant1_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant1_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant1_image') is-invalid @enderror" id="floatingInput" name="variant1_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant1_image}}" @else value="{{old('variant1_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant1_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant1_url') is-invalid @enderror" id="floatingInput" name="variant1_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant1_url}}" @else value="{{old('variant1_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant1_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 2</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant2_title') is-invalid @enderror" id="floatingInput" name="variant2_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant2_title}}" @else value="{{old('variant2_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant2_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant2_image') is-invalid @enderror" id="floatingInput" name="variant2_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant2_image}}" @else value="{{old('variant2_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant2_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant2_url') is-invalid @enderror" id="floatingInput" name="variant2_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant2_url}}" @else value="{{old('variant2_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant2_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 3</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant3_title') is-invalid @enderror" id="floatingInput" name="variant3_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant3_title}}" @else value="{{old('variant3_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant3_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant3_image') is-invalid @enderror" id="floatingInput" name="variant3_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant3_image}}" @else value="{{old('variant3_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant3_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant3_url') is-invalid @enderror" id="floatingInput" name="variant3_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant3_url}}" @else value="{{old('variant3_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant3_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 4</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant4_title') is-invalid @enderror" id="floatingInput" name="variant4_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant4_title}}" @else value="{{old('variant4_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant4_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant4_image') is-invalid @enderror" id="floatingInput" name="variant4_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant4_image}}" @else value="{{old('variant4_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant4_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant4_url') is-invalid @enderror" id="floatingInput" name="variant4_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant4_url}}" @else value="{{old('variant4_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant4_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 5</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant5_title') is-invalid @enderror" id="floatingInput" name="variant5_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant5_title}}" @else value="{{old('variant5_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant5_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant5_image') is-invalid @enderror" id="floatingInput" name="variant5_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant5_image}}" @else value="{{old('variant5_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant5_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant5_url') is-invalid @enderror" id="floatingInput" name="variant5_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant5_url}}" @else value="{{old('variant5_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant5_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-2">
    <h6>Variant 6</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant6_title') is-invalid @enderror" id="floatingInput" name="variant6_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant6_title}}" @else value="{{old('variant6_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant6_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant6_image') is-invalid @enderror" id="floatingInput" name="variant6_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant6_image}}" @else value="{{old('variant6_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant6_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant6_url') is-invalid @enderror" id="floatingInput" name="variant6_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant6_url}}" @else value="{{old('variant6_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant6_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 7</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant7_title') is-invalid @enderror" id="floatingInput" name="variant7_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant7_title}}" @else value="{{old('variant7_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant7_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant7_image') is-invalid @enderror" id="floatingInput" name="variant7_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant7_image}}" @else value="{{old('variant7_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant7_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant7_url') is-invalid @enderror" id="floatingInput" name="variant7_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant7_url}}" @else value="{{old('variant7_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant7_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 8</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant8_title') is-invalid @enderror" id="floatingInput" name="variant8_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant8_title}}" @else value="{{old('variant8_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant8_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant8_image') is-invalid @enderror" id="floatingInput" name="variant8_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant8_image}}" @else value="{{old('variant8_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant8_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant8_url') is-invalid @enderror" id="floatingInput" name="variant8_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant8_url}}" @else value="{{old('variant8_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant8_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 9</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant9_title') is-invalid @enderror" id="floatingInput" name="variant9_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant9_title}}" @else value="{{old('variant9_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant9_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant9_image') is-invalid @enderror" id="floatingInput" name="variant9_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant9_image}}" @else value="{{old('variant9_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant9_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant9_url') is-invalid @enderror" id="floatingInput" name="variant9_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant9_url}}" @else value="{{old('variant9_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant9_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   <div class="row mt-1">
    <h6>Variant 10</h6> 
    <div class="col-sm-3">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant10_title') is-invalid @enderror" id="floatingInput" name="variant10_title" placeholder="Enter Title" @isset($edit) value="{{$edit->variant10_title}}" @else value="{{old('variant10_title')}}" @endisset>
    <label for="floatingInput">Title</label>
    @error('variant10_title')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-4">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant10_image') is-invalid @enderror" id="floatingInput" name="variant10_image" placeholder="Enter Image Link" @isset($edit) value="{{$edit->variant10_image}}" @else value="{{old('variant10_image')}}" @endisset>
    <label for="floatingInput">Image Link</label>
    @error('variant10_image')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    <div class="col-sm-5">
    <div class="form-floating mb-3">
    <input type="text" class="form-control @error('variant10_url') is-invalid @enderror" id="floatingInput" name="variant10_url" placeholder="Enter URL" @isset($edit) value="{{$edit->variant10_url}}" @else value="{{old('variant10_url')}}" @endisset>
    <label for="floatingInput">URL to Redirect</label>
    @error('variant10_url')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
       
   </div>
   
  </div>
  <div class="tab-pane container fade" id="more_images">
   <div class="card mt-2">
    <div class="card-header"> 
    <h6 class="text-white"> Upload More Images : <input type="file" name="more_images[]" multiple> </h6> 
    <small class="text-white">You can select multiple files at once. </small> <br>
    <small class="text-white">File size should be less than or equals to 250 KB.</small>
    </div>
    <div class="card-body">
    
    <div class="row">
    @isset($edit)  
    @if(moreImages($edit->id)->isNotEmpty())
    @foreach(moreImages($edit->id) as $row)
    <div class="col-lg-1 col-xs-6">
    <img src="{{asset('uploaded_files/more_image/'.$row->image)}}" width="100%"> 
    <center><a href="{{route('product.remove.moreimg',$row->id)}}" class="text-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a></center>
    </div>
    @endforeach
    @endif
    @endisset 
    </div>
    </div>
    </div>
    <hr>
    <div class="card">
    <div class="card-header"> 
    <h6 class="text-white"> Upload More Banner : <input type="file" name="more_banners[]" multiple> </h6> 
    <small class="text-white">You can select multiple files at once. </small> <br>
    <small class="text-white">File size should be less than or equals to 250KB.</small>
    </div>
    <div class="card-body">
    
    <div class="row">
    @isset($edit)  
    @if(moreBanners($edit->id)->isNotEmpty())
    @foreach(moreBanners($edit->id) as $row)
    <div class="col-lg-1 col-xs-6">
    <img src="{{asset('uploaded_files/more_image/'.$row->image)}}" width="100%"> 
    <center><a href="{{route('product.remove.morebanner',$row->id)}}" class="text-danger" onClick="return confirm('Are you sure?');"><i class="fas fa-trash"></i></a></center>
    </div>
    @endforeach
    @endif
    @endisset 
    </div>
    </div>
    </div>   
  </div>
  <div class="tab-pane container fade" id="seo">

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_title" placeholder="Enter Meta Title" >@isset($edit){{$edit->meta_title}}@endisset</textarea>
 <label for="floatingInput">Meta Title</label>
  @error('meta_title')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_description" placeholder="Enter Meta Description">@isset($edit){{$edit->meta_description}}@endisset</textarea>
 <label for="floatingInput">Meta Description</label>
  @error('meta_description')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12 mt-3">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="meta_keywords" placeholder="Enter Meta Keywords" >@isset($edit){{$edit->meta_keywords}}@endisset</textarea>
 <label for="floatingInput">Meta Keywords</label>
  @error('meta_keywords')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>   
  </div>
</div> 

<div class="row">
<div class="col-sm-3 offset-sm-9 mt-3">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</form>
</div>

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
