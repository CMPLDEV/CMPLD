@extends('layouts.app')

@section('title',$meta_title)
@section('description',$meta_description)
@section('keywords',$meta_keywords)

@section('custom-css')
<style>
/* Container for the certificate */
.certificate-container {
background: #fff;
border-radius: 12px;
border: 2px solid #dcdcdc;
box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
padding: 25px;
font-family: 'Verdana', sans-serif;
margin: 22px auto;
text-align: center;
}

/* Header with border */
.certificate-header {
background: #f4f4f4;
padding: 15px;
border-radius: 8px;
margin-bottom: 15px;
border: 1px solid #e0e0e0;
}

.certificate-title {
font-size: 22px;
color: #333;
font-weight: bold;
text-transform: uppercase;
letter-spacing: 3px;
margin: 0;
}

/* Recipient's name */
.certificate-name {
font-size: 32px;
color: #2c3e50;
font-weight: 600;
margin-top: 20px;
font-family: 'Georgia', serif;
position: relative;
}

.certificate-name::after {
content: "";
position: absolute;
width: 50%;
height: 3px;
background-color: #3498db;
bottom: -8px;
left: 25%;
}

/* Description of achievement */
.certificate-description {
font-size: 18px;
color: #7f8c8d;
margin-top: 15px;
font-style: italic;
}

/* Date of issue */
.certificate-date {
font-size: 14px;
color: #95a5a6;
margin-top: 15px;
font-weight: bold;
text-transform: uppercase;
}

/* Hover effect */
.certificate-container:hover {
transform: translateY(-8px);
box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease, box-shadow 0.3s ease;
}

table {
    caption-side: bottom;
    border-collapse: collapse;
    width: 100%;
}
.table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > th, .table > caption + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > td, .table > thead:first-child > tr:first-child > td {
    border-top: 1px solid #dbdbdb;
    width: 100%;
}
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 6px 10px;
}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    border-bottom: 1px solid #ddd;
}

table > thead > tr > th, table > tbody > tr > th, table > tfoot > tr > th, table > thead > tr > td, table > tbody > tr > td, table > tfoot > tr > td {
    border-top: 1px solid #dbdbdb;
    border: 1px solid #dbdbdb;
    line-height: 2.5;
    padding-left: 3px;
    text-align: center;
    vertical-align: top;
}
</style>

@endsection

@section('content')

<main>
@if(!empty($page->banner))   
<img src="{{showImage($page->banner,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="w-100"> 
@endif
<section class="blog__area pt-100 pb-50">
<div class="container"> 
<div class="row">
<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-12">

@if(!empty($page->image))    
<img src="{{showImage($page->image,'uploaded_files/page')}}" alt="{{setting()->comp_name}}" title="{{setting()->comp_name}}" class="float-start mb-3" style="max-width: 400px;width: 100%;padding: 0;border: 5px solid #fff;
    border-radius: 10px;margin: 10px;">
@endif


<div class="ked">
{!! $page->content !!}
<a href="about-us.html#certificates_section" class="s-btn s-btn-2 buy-confidence"> <i class="fa fa-shield-alt" id="blink-icon"></i> Buy with confidence</a>
</div>
</div>

</div>
</div>

@if(certificates()->isNotEmpty())
<div class="container" id="certificates_section"> 
<div class="row">
@foreach(certificates() as $row)
 <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-12">
  <div class="certificate-container">
   <a href="{{url('buy-with-confidence/'.$row->slug)}}" target="_blank">    
   <div class="certificate-header">
   <h2 class="certificate-title">{{$row->name}}</h2>
   </div>
   <div class="certificate-body">
   <h3 class="certificate-name">CMPL</h3>
  <p class="certificate-description"><i class="fad fa-shield-alt fa-2x"></i></p>
  <p class="certificate-date">Issued: {{date('d M, Y', strtotime($row->issued_on))}}</p>
  </div>
  </a>
 </div>
</div>
@endforeach
</div>
</div>
@endif
</section>
<!-- blog area end -->
</main>

@endsection