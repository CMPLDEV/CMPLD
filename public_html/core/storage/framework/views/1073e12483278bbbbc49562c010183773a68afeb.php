<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo e(setting()->comp_name); ?></title>
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
<img src="<?php echo e(setting()->website_url); ?>/uploaded_files/logo/<?php echo e(setting()->logo); ?>" style="width:50%; max-width:100px;">
</td>

<td>
<span style="color: #5265a7; font-size: 32px; line-height: 38px; font-weight: 700">INVOICE</span><br>
    <span style="line-height: 14px; display: block;"><?php echo e(date('d-M-Y h:i A',strtotime($invoice->created_at))); ?></span> Invoice No. - <?php echo e($invoice->invoice_no); ?>

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
    <?php echo e($order->name); ?><br>
    <?php echo e($order->email); ?><br>
    <?php echo e($order->address); ?><br>
    <?php echo e($order->city); ?>, 
    <?php echo e(state($order->state)); ?> - <?php echo e($order->pincode); ?>

    <?php echo e(country($order->country)); ?><br>

<td><b>Company Detail :</b><br>
    <?php echo e(setting()->comp_name); ?><br>
    <?php echo e(setting()->email); ?><br>
    <?php echo e(setting()->mobile); ?><br>
    <?php echo e(setting()->city); ?><br> <?php echo e(state(setting()->state)); ?> - <?php echo e(setting()->pincode); ?>

    <?php echo e(country(setting()->country)); ?>

</td>
</tr>
<tr>
<td><b>Shipping Address:</b><br>
    <?php echo e($order->shipping_name); ?><br>
    <?php echo e($order->shipping_email); ?><br>
    <?php echo e($order->shipping_address); ?><br>
    <?php echo e($order->shipping_city); ?>, 
    <?php echo e(state($order->shipping_state)); ?> - <?php echo e($order->shipping_pincode); ?>

    <?php echo e(country($order->shipping_country)); ?><br>
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
    
 <?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <tr class="item" style="border: 1px solid #eee">
     <td> <?php echo e($row->item_name); ?> </td>
     
     <td> <?php echo e(setting()->currency.$row->item_unit_price); ?> </td>
        
     <td> <?php echo e($row->item_qty); ?> </td>
        
     <td> <?php echo e(setting()->currency.$row->item_net_price); ?> </td>
    </tr>

 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>      

       <tr class="total">
        <td></td>   
        <td colspan="3"> Subtotal: <?php echo e(setting()->currency.$order->amount); ?> </td>
       </tr>    
        <?php if($order->discount > 0): ?>
        <tr class="total">
        <td></td>    
        <td colspan="3"> Discount: <?php echo e(setting()->currency.$order->discount); ?> </td>
        </tr>
        <?php endif; ?>
        <?php if($order->wholesaler_discount > 0): ?>
        <tr class="total">
        <td></td>    
        <td colspan="3"> Whole Saler Discount: <?php echo e(setting()->currency.$order->wholesaler_discount); ?> </td>
        </tr>
        <?php endif; ?>
        <?php if($order->shipping_charges > 0): ?>
        <tr class="total">
        <td></td>    
        <td colspan="3"> Shipping: + <?php echo e(setting()->currency.$order->shipping_charges); ?> </td>
        </tr>
        <?php endif; ?>
        <tr class="total end-total">
        <td></td>
        <td colspan="3"> Total: <?php echo e(setting()->currency.$order->net_amount); ?> </td>
        </tr>

    <tr class="custm" style="background-color: #f7f7f7; border: 1px solid #eee">
        <td style="font-weight: 700; border: 1px solid #eee">Mode Of Payment</td>
       <?php if(!empty($order->gst_no)): ?> <td style="font-weight: 700; border: 1px solid #eee">GST No.</td> <?php endif; ?>
        <td style="font-weight: 700; border: 1px solid #eee">Invoice Value</td>
        <td style="font-weight: 700; border: 1px solid #eee">Date</td>
    </tr>
    <tr class="custm">
        <td> <?php echo e($order->type); ?> </td>
        <td><?php if(!empty($order->gst_no)): ?> <?php echo e($order->gst_no); ?> <?php endif; ?></td>
        <td><?php echo e(setting()->currency.$order->net_amount); ?></td>
        <td><?php echo e(date('d-M-y',strtotime($invoice->created_at))); ?></td>
  </tr>

</table>
<div>
   <b style="display: block; background-color: #f7f7f7;margin-top: 14px;padding: 10px;">Terms & Conditions</b>
    <p style="font-size: 12px;color:grey"> This is a computer generated invoice by using which you agree to be bound by the terms and conditions.<br>
    We accept payment through the methods specified on the invoice. All applicable taxes and duties will be clearly indicated on the invoice. If you have any query, please contact us at the contact below.
    <br>
    <i> Support No. -  <?php echo e(setting()->mobile); ?> & Email On - <?php echo e(setting()->email); ?> </i>
 
</p>
    
</div>
  
</div>
</body>
</html><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/invoice/index.blade.php ENDPATH**/ ?>