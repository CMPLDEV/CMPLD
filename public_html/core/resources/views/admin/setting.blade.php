@extends('admin.layouts.app')
@section('title','Dashboard')
@section('content')

<div class="page-content">
<div class="container-fluid">
<!-- start page title -->
<div class="row">
<div class="col-12">
<div class="page-title-box d-flex align-items-center justify-content-between">
<h4 class="mb-0">Settings</h4>

<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item"><a href="">Dashboard</a></li>
<li class="breadcrumb-item active">Settings</li>
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

<form method="post" enctype="multipart/form-data" action="{{route('update-setting')}}">
 @csrf

<div class="row mb-3">

<div class="col-sm-5">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('comp_name') is-invalid @enderror" id="floatingInput" name="comp_name" placeholder="Enter Company Name" @if(!empty($data->comp_name)) value="{{$data->comp_name}}" @else value="{{old('comp_name')}}" @endif >
 <label for="floatingInput">Company Name</label>
  @error('comp_name')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('website_url') is-invalid @enderror" id="floatingInput" name="website_url" placeholder="Enter Website URL" @if(!empty($data->website_url)) value="{{$data->website_url}}" @else value="{{old('website_url')}}" @endif >
 <label for="floatingInput">Website URL</label>
 @error('website_url')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="floatingInput" name="whatsapp" placeholder="Enter WhatsApp No" @if(!empty($data->whatsapp)) value="{{$data->whatsapp}}" @else value="{{old('whatsapp')}}" @endif >
 <label for="floatingInput">WhatsApp No</label>
 @error('whatsapp')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email" placeholder="Enter Email" @if(!empty($data->email)) value="{{$data->email}}" @else value="{{old('email')}}" @endif >
 <label for="floatingInput">Email Address</label>
  @error('email')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="email" class="form-control @error('alt_email') is-invalid @enderror" id="floatingInput" name="alt_email" placeholder="Enter Alternate Email" @if(!empty($data->alt_email)) value="{{$data->alt_email}}" @else value="{{old('alt_email')}}" @endif >
 <label for="floatingInput">Alternate Email</label>
 @error('alt_email')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('mobile') is-invalid @enderror" id="floatingInput" name="mobile" placeholder="Enter Mobile No" @if(!empty($data->mobile)) value="{{$data->mobile}}" @else value="{{old('mobile')}}" @endif >
 <label for="floatingInput">Mobile No</label>
  @error('mobile')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('phone') is-invalid @enderror" id="floatingInput" name="phone" placeholder="Enter Phone No" @if(!empty($data->phone)) value="{{$data->phone}}" @else value="{{old('phone')}}" @endif >
 <label for="floatingInput">Phone No</label>
 @error('phone')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('address') is-invalid @enderror" id="floatingInput" name="address" placeholder="Enter Address" @if(!empty($data->address)) value="{{$data->address}}" @else value="{{old('address')}}" @endif>
 <label for="floatingInput">Address</label>
 @error('address')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="file" class="form-control @error('logo') is-invalid @enderror" id="floatingInput" name="logo">
 <label for="floatingInput">Logo</label>
 @error('logo')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 @if(!empty($data->logo))
  <img src="{{asset('uploaded_files/logo/'.$data->logo)}}" width="80" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
  <a href="{{route('remove-image','logo')}}" class="text-danger"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Remove"></i></a>
  @else
  <img src="{{asset(noImage())}}" width="80" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
 @endif
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="file" class="form-control @error('favicon') is-invalid @enderror" id="floatingInput" name="favicon">
 <label for="floatingInput">Favicon</label>
 @error('favicon')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 @if(!empty($data->favicon))
  <img src="{{asset('uploaded_files/favicon/'.$data->favicon)}}" width="60" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
  <a href="{{route('remove-image','favicon')}}" class="text-danger"><i class="fas fa-trash" data-bs-toggle="tooltip" title="Remove"></i></a>
  @else
  <img src="{{asset(noImage())}}" width="80" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}">
 @endif
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('city') is-invalid @enderror" id="floatingInput" name="city" placeholder="Enter City" @if(!empty($data->city)) value="{{$data->city}}" @else value="{{old('city')}}" @endif >
 <label for="floatingInput">City</label>
 @error('city')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('pincode') is-invalid @enderror" id="floatingInput" name="pincode" placeholder="Enter Pincode" @if(!empty($data->pincode)) value="{{$data->pincode}}" @else value="{{old('pincode')}}" @endif >
 <label for="floatingInput">Pincode</label>
 @error('pincode')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <select name="country" id="country" class="selectpicker" data-live-search="true" onChange="getStates(this.value);">
 <option value="">Choose country</option>
 @foreach(countries() as $row)
  <option value="{{$row->id}}" @if($data->country == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
</select>
 @error('country')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3">
 <div class="form-floating mb-3">
 <select name="state" id="state" class="form-control">
 <option value="">Choose state</option>
@if(!empty($data->country))
 @foreach(states($data->country) as $row)
  <option value="{{$row->id}}" @if($data->state == $row->id) selected @endif>{{$row->name}}</option>
 @endforeach
@endif
</select>
 @error('state')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12 mt-3">
<div class="alert alert-secondary rounded-0">
  <strong>Social Media Links & Map</strong>
</div>   
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('facebook') is-invalid @enderror" id="floatingInput" name="facebook" placeholder="Enter Facebook Link" @if(!empty($data->facebook)) value="{{$data->facebook}}" @else value="{{old('facebook')}}" @endif >
 <label for="floatingInput">Facebook Link</label>
 @error('facebook')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="floatingInput" name="twitter" placeholder="Enter Twitter Link" @if(!empty($data->twitter)) value="{{$data->twitter}}" @else value="{{old('twitter')}}" @endif >
 <label for="floatingInput">Twitter Link</label>
 @error('twitter')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="floatingInput" name="instagram" placeholder="Enter Instagram Link" @if(!empty($data->instagram)) value="{{$data->instagram}}" @else value="{{old('instagram')}}" @endif >
 <label for="floatingInput">Instagram Link</label>
 @error('instagram')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('linkedin') is-invalid @enderror" id="floatingInput" name="linkedin" placeholder="Enter Linkedin Link" @if(!empty($data->linkedin)) value="{{$data->linkedin}}" @else value="{{old('linkedin')}}" @endif >
 <label for="floatingInput">Linkedin Link</label>
 @error('linkedin')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <input type="text" class="form-control @error('youtube') is-invalid @enderror" id="floatingInput" name="youtube" placeholder="Enter Youtube Link" @if(!empty($data->youtube)) value="{{$data->youtube}}" @else value="{{old('youtube')}}" @endif >
 <label for="floatingInput">Youtube Link</label>
 @error('youtube')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-4">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="map" placeholder="Enter Map">{{$data->map}}</textarea>
 <label for="floatingInput">Map</label>
  @error('map')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-12">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="notification" placeholder="Enter Notification Content">{{$data->notification}}</textarea>
 <label for="floatingInput">Notification</label>
  @error('notification')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-2">
 <div class="form-floating mb-3">
 <select name="currency" id="currency" class="form-control">
 <option value="">Choose currency</option>
  <option value="₹" @if($data->currency == '₹') selected @endif>₹</option>
  <option value="$" @if($data->currency == '$') selected @endif>$</option>
  <option value="€" @if($data->currency == '€') selected @endif>€</option>
  <option value="£" @if($data->currency == '£') selected @endif>£</option>
  <option value="¥" @if($data->currency == '¥') selected @endif>¥</option>
  <option value="a$" @if($data->currency == 'a$') selected @endif>a$</option>
  <option value="c$" @if($data->currency == 'c$') selected @endif>c$</option>
  <option value="cn¥" @if($data->currency == 'cn¥') selected @endif>cn¥</option>
</select>
<label for="">Currency</label>
 </div>
</div>

<div class="col-sm-10">
 <div class="form-floating mb-3">
 <textarea type="text" class="form-control" id="floatingInput" rows="3" name="footer_content" placeholder="Enter Footer Content">{{$data->footer_content}}</textarea>
 <label for="floatingInput">Footer Content</label>
  @error('footer_content')
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
 </div>
</div>

<div class="col-sm-3 offset-sm-9">
  <button type="submit" class="btn btn-primary float-end">Submit</button>  
</div>

</div>
</div>


</form><!-- End General Form Elements -->

</div>
</div>

</div>

</div>
<!-- container-fluid -->
</div>

@endsection
