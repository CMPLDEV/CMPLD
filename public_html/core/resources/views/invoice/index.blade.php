<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>{{setting()->comp_name}}</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
*{ font-family: DejaVu Sans !important;}
.invoice-box {
position: relative;
max-width: 900px;
margin: auto;
padding: 20px;
padding-top:0px;
border: 1px solid #eee;
background-color: #fff;
box-shadow: 0 0 10px rgba(0, 0, 0, .15);
font-size: 12px;
line-height: 20px;
font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
color: #555;
}

.invoice-box table {
width: 100%;
line-height: inherit;
text-align: left;
}

.invoice-box table td {
padding: 5px;
vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
text-align: right;
}

.invoice-box table tr.top table td {
padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
font-size: 45px;
line-height: 45px;
color: #333;
}

.invoice-box table tr.information table td {
padding-bottom: 20px;
}

.invoice-box table tr.heading td {
background: #f7f7f7;
border-bottom: 1px solid #ddd;
font-weight: bold;
}

.invoice-box table tr.details td {
padding-bottom: 20px;
}

.invoice-box table tr.item td{
border-bottom: 1px solid #eee;
}

.invoice-box table tr.item.last td {
border-bottom: none;
}

.invoice-box table tr.total td:nth-child(2) {
/*border-top: 2px solid #eee;*/
font-weight: bold;
}

@media only screen and (max-width: 600px) {
.invoice-box table tr.top table td {
    width: 100%;
    display: block;
    text-align: center;
}

.invoice-box table tr.information table td {
    width: 100%;
    display: block;
    text-align: center;
}
}

/** RTL **/
.rtl {
direction: rtl;
font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
}

.rtl table {
text-align: right;
}

.rtl table tr td:nth-child(2) {
text-align: left;
}
.custm{
    border: 1px solid #f7f7f7;
  border-collapse: collapse;
}

</style>
</head>

<body>
<div class="invoice-box">
<table cellpadding="0" cellspacing="0">
<tr class="top">
<td colspan="4">
<table>
<tr>
<td>
<img src="{{setting()->website_url}}/uploaded_files/logo/{{setting()->logo}}" style="width:50%; max-width:100px;">
</td>

<td>
<span style="color: #5265a7; font-size: 32px; line-height: 38px; font-weight: 700">INVOICE</span><br>
    <span style="line-height: 14px; display: block;">{{date('d-M-Y h:i A',strtotime($invoice->created_at))}}</span> Invoice No. - {{$invoice->invoice_no}}
</td>
</tr>

</table>
</td>
</tr>
    
<tr class="information">
<td colspan="4">
<table>

<tr>
<td><b>Billing Address:</b><br>
    {{$order->name}}<br>
    {{$order->email}}<br>
    {{$order->address}}<br>
    {{$order->city}}, 
    {{state($order->state)}} - {{$order->pincode}}
    {{country($order->country)}}<br>

<td><b>Company Detail :</b><br>
    {{setting()->comp_name}}<br>
    {{setting()->email}}<br>
    {{setting()->mobile}}<br>
    {{setting()->city}}<br> {{state(setting()->state)}} - {{setting()->pincode}}
    {{country(setting()->country)}}
</td>
</tr>
<tr>
<td><b>Shipping Address:</b><br>
    {{$order->shipping_name}}<br>
    {{$order->shipping_email}}<br>
    {{$order->shipping_address}}<br>
    {{$order->shipping_city}}, 
    {{state($order->shipping_state)}} - {{$order->shipping_pincode}}
    {{country($order->shipping_country)}}<br>
    </td>
</tr>
</table>
</td>
</tr>

  <tr class="heading" style="border: 1px solid #eee">
   <td style="border: 1px solid #eee"> Product Description </td>
   <td style="border: 1px solid #eee"> Price </td>
   <td style="border: 1px solid #eee"> Qty </td>
   <td style="border: 1px solid #eee"> Net Price </td>
  </tr>
    
 @foreach($order_detail as $row)

    <tr class="item" style="border: 1px solid #eee">
     <td> {{$row->item_name}} </td>
     
     <td> {{setting()->currency.$row->item_unit_price}} </td>
        
     <td> {{$row->item_qty}} </td>
        
     <td> {{setting()->currency.$row->item_net_price}} </td>
    </tr>

 @endforeach      

       <tr class="total">
        <td></td>   
        <td colspan="3"> Subtotal: {{setting()->currency.$order->amount}} </td>
       </tr>    
        @if($order->discount > 0)
        <tr class="total">
        <td></td>    
        <td colspan="3"> Discount: {{setting()->currency.$order->discount}} </td>
        </tr>
        @endif
        @if($order->wholesaler_discount > 0)
        <tr class="total">
        <td></td>    
        <td colspan="3"> Whole Saler Discount: {{setting()->currency.$order->wholesaler_discount}} </td>
        </tr>
        @endif
        @if($order->shipping_charges > 0)
        <tr class="total">
        <td></td>    
        <td colspan="3"> Shipping: + {{setting()->currency.$order->shipping_charges}} </td>
        </tr>
        @endif
        <tr class="total end-total">
        <td></td>
        <td colspan="3"> Total: {{setting()->currency.$order->net_amount}} </td>
        </tr>

    <tr class="custm" style="background-color: #f7f7f7; border: 1px solid #eee">
        <td style="font-weight: 700; border: 1px solid #eee">Mode Of Payment</td>
       @if(!empty($order->gst_no)) <td style="font-weight: 700; border: 1px solid #eee">GST No.</td> @endif
        <td style="font-weight: 700; border: 1px solid #eee">Invoice Value</td>
        <td style="font-weight: 700; border: 1px solid #eee">Date</td>
    </tr>
    <tr class="custm">
        <td> {{$order->type}} </td>
        <td>@if(!empty($order->gst_no)) {{$order->gst_no}} @endif</td>
        <td>{{setting()->currency.$order->net_amount}}</td>
        <td>{{date('d-M-y',strtotime($invoice->created_at))}}</td>
  </tr>

</table>
<div>
   <b style="display: block; background-color: #f7f7f7;margin-top: 14px;padding: 10px;">Terms & Conditions</b>
    <p style="font-size: 12px;color:grey"> This is a computer generated invoice by using which you agree to be bound by the terms and conditions.<br>
    We accept payment through the methods specified on the invoice. All applicable taxes and duties will be clearly indicated on the invoice. If you have any query, please contact us at the contact below.
    <br>
    <i> Support No. -  {{setting()->mobile}} & Email On - {{setting()->email}} </i>
 
</p>
    
</div>
  
</div>
</body>
</html>