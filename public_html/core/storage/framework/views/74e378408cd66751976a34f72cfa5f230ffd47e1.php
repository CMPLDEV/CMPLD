<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1" name="viewport">
<meta name="x-apple-disable-message-reformatting">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="telephone=no" name="format-detection">
<title>Order Confirmation</title>
<center>
<table  style="table-layout:fixed;max-width:100%!important;width:100%!important;min-width:100%!important" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr><td valign="top" align="center">
<table style="padding-bottom:13px;background-color:#fff;border:1px solid #dfdfdf" width="600" cellspacing="0" cellpadding="20" border="0">
<tbody>
<tr>
<td style="padding:0" valign="top" align="center">
<table style="padding-bottom:20px" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr><td style="padding:0px 0 10px" valign="top" align="center"><div>
<a href="#" target="_blank">
<img src="<?php echo e(setting()->website_url); ?>/assets/img/email.jpg" style="width:600px" class="CToWUd" data-bit="iit">
</a>
</div></td>
</tr></tbody>
</table>
<table style="padding:0 30px 10px" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr><td align="center">
<h2 style="color:#000;font-family:'arial',sans-serif;font-size:32px"><?php echo e($order->delivery_status); ?></h2></td></tr>
<tr><td style="text-align:left;font-family:'arial',sans-serif;font-size:14px;padding:0 0 10px;border-bottom:solid 1px #e5e5e5" valign="top">
Hi <span style="text-transform:capitalize"><?php echo e($order->name); ?></span><span></span>,
<p style="font-family:'helvetica',sans-serif;font-size:14px;color:#000"><?php echo e($content); ?>.</p>
<?php if($order->delivery_status == "CANCELLED"): ?>
<p style="font-family:'helvetica',sans-serif;font-size:14px;color:#000">  
<b>Cancel Note: </b> <?php echo e($order->cancel_note); ?>

</p>
<?php endif; ?>
<?php if(!empty($order->tracking_no)): ?>
<p style="font-family:'helvetica',sans-serif;font-size:14px;color:#000">  
<b>Tracking No: </b> <?php echo e($order->tracking_no); ?> <br>
<b>Tracking URL: </b> <?php echo e($order->tracking_link); ?>

</p>
<?php endif; ?>
</td></tr></tbody></table>
<table style="padding:10px 30px;font-family:'arial',sans-serif;font-size:12px" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
<th style="padding:5px 0" width="33%" align="left">
<strong style="font-family:'arial',sans-serif;color:#000;font-size:12px">Shipping to</strong></th>
<th width="20%" align="left"><strong style="font-family:'arial',sans-serif;color:#000;font-size:12px">Order ID</strong></th>
<th width="20%" align="left"><strong style="font-family:'arial',sans-serif;color:#000;font-size:12px">Placed on</strong></th>
<th width="27%" align="left"><strong style="font-family:'arial',sans-serif;color:#000;font-size:12px">Order Total</strong></th>
</tr>
<tr>
<td><div style="width:190px"><strong><?php echo e($order->name); ?></strong><br>
<div style="font-size:11px;color:#5f5f5f;width:170px;padding-top:5px"><?php echo e($order->address); ?>, <?php echo e($order->city); ?>

<?php echo e(state($order->state)); ?> <?php echo e(country($order->country)); ?> - <?php echo e($order->pincode); ?></div></div></td>
<td style="padding:0 10px 0 0" valign="top"><?php echo e($order->id); ?></td>
<td valign="top"><?php echo e(date('d-M-Y',strtotime($order->created_at))); ?></td>
<td valign="top"><?php echo e(setting()->currency); ?><?php echo e($order->net_amount); ?></td></tr>
</tbody></table>

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr><td style="padding:20px 30px 0;text-transform:uppercase;font-family:'arial',sans-serif;font-size:14px" valign="top">
<strong style="color:#000;font-family:'arial',sans-serif;font-size:14px">ORDER SUMMARY</strong></td>
</tr></tbody></table><table style="padding:10px 30px 0px" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody>

<?php $__currentLoopData = $order_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php $product = \App\Models\Product::find($row->item_id); ?>     
<tr>
<td style="border-bottom:solid 1px #e5e5e5;border-top:solid 1px #e5e5e5;padding:10px 20px 10px 0;font-family:'arial',sans-serif" width="25%">
<img src="<?php echo e(asset(showImage($product->image,'uploaded_files/product'))); ?>" title="<?php echo e($row->name); ?>" width="95" class="CToWUd" data-bit="iit"></td>
<td style="border-top:solid 1px #e5e5e5;border-bottom:solid 1px #e5e5e5;font-family:'arial',sans-serif;padding-top:30px" width="75%" valign="top">
<strong style="font-size:14px;text-transform:uppercase;padding-right:10px;color:#000"> <?php echo e($row->item_name); ?> </strong> 
<div style="padding:10px 0 0"><span style="padding-right:40px;font-size:12px;color:#000"><?php echo e(setting()->currency); ?><?php echo e($row->item_unit_price); ?></span><span style="font-size:12px;color:#000">Qty:<?php echo e($row->item_qty); ?> pcs</span></div>
 </td>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                                  
</tbody></table>
<table style="padding:10px 30px 10px;font-family:'arial',sans-serif" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>

<tr>

<td style="border-bottom:solid 1px #e5e5e5;padding:10px 30px 20px 10px;font-family:'arial',sans-serif;font-size:12px;text-align:right" width="25%">
<strong style="color:#000;font-size:12px;padding-right:10px">Payment </strong> 
<strong style="font-size:16px;color:#000"><?php echo e($order->payment_status); ?></strong>
</td>

<td style="border-bottom:solid 1px #e5e5e5;padding:10px 30px 20px 10px;font-family:'arial',sans-serif;font-size:12px;text-align:right" width="25%">
<strong style="color:#000;font-size:12px;padding-right:10px">Subtotal (<?php echo e(COUNT($order_detail)); ?> items):</strong> 
<strong style="font-size:16px;color:#000"><?php echo e(setting()->currency); ?><?php echo e($order->amount); ?></strong>
</td>

<td style="border-bottom:solid 1px #e5e5e5;padding:10px 30px 20px 10px;font-family:'arial',sans-serif;font-size:12px;text-align:right" width="25%">
<strong style="color:#000;font-size:12px;padding-right:10px">Amount</strong> 
<strong style="font-size:16px;color:#000"><?php echo e(setting()->currency); ?><?php echo e($order->net_amount); ?></strong>
</td>

</tr>


</tbody>
</table>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr><td style="padding-left:30px">
<strong style="font-size:14px;font-family:'arial',sans-serif;color:#000">Status: <?php echo e($order->delivery_status); ?></strong></td>
<td style="padding:0 30px 0 130px">
<strong style="font-size:14px;font-family:'arial',sans-serif;color:#000">Payment Mode: <?php echo e($order->type); ?> - <?php echo e($order->sub_type); ?></strong></td></tr>
<tr><td colspan="2" style="padding:15px 30px 10px">
<p style="font-size:12px;font-family:'arial',sans-serif;text-align:center;color:#000">If you did not authorize this, please contact us at <strong><a href="tel:<?php echo e(setting()->mobile); ?>" style="font-size:12px;font-family:'arial',sans-serif;color:#000;text-decoration:none" target="_blank"><?php echo e(setting()->mobile); ?></a></strong>
<br> or <strong><a href="mailto:<?php echo e(setting()->email); ?>" style="font-size:12px;font-family:'arial',sans-serif;color:#000;text-decoration:none" target="_blank"><?php echo e(setting()->email); ?></a></strong></p></td></tr></tbody>
</table>
<table style="padding:10px 30px 0;font-family:'arial',sans-serif" width="100%" cellspacing="0" cellpadding="0" border="0"></table>
<center>
<table style="table-layout:fixed;max-width:100%!important;width:100%!important;min-width:100%!important" width="100%" height="100%" cellspacing="0" cellpadding="0" border="0"><tbody>
<tr><td  valign="top" align="center">
<table style="padding:0px;background:#ffffff;height:75px;width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr style="height:46px"><td style="height:46px">
<table style="padding:0px 35px;height:18px;width:100%" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody>
<tr style="height:18px"><td style="padding:27px 0px 0px;border-top:1px solid #e4e4e4;height:18px" align="center">
<span style="color:#000">Shop now at </span>
<a href="<?php echo e(setting()->website_url); ?>" target="_blank" style="text-decoration: none;color: #ca0909;"><?php echo e(domain()); ?></a></td></tr></tbody>
</table></td></tr>
<tr style="height:29px">
<td style="padding:15px 0px 43px;height:29px" valign="top"><div style="text-align:center">
<div style="vertical-align:top;display:inline-block"><span style="display:inline-block;font-size: 12px;
        margin-top: 4px;">CONNECT WITH US</span></div>

<?php if(!empty(setting()->facebook)): ?>    
<a href="<?php echo e(setting()->facebook); ?>" target="_blank" style="text-decoration: none;color: #ca0909;"> 
Facebook
 </a>
<?php endif; ?>
<?php if(!empty(setting()->instagram)): ?>
<a href="<?php echo e(setting()->instagram); ?>" target="_blank" style="text-decoration: none;color: #ca0909;">
Instagram
</a>
<?php endif; ?>
<?php if(!empty(setting()->twitter)): ?>
<a href="<?php echo e(setting()->twitter); ?>" style="text-decoration: none;color: #ca0909;"  target="_blank">
Twitter
</a>
<?php endif; ?>
<?php if(!empty(setting()->linkedin)): ?>
<a href="<?php echo e(setting()->linkedin); ?>" style="text-decoration: none;color: #ca0909;"  target="_blank">
Linkedin
</a>
<?php endif; ?>
<?php if(!empty(setting()->youtube)): ?>
<a href="<?php echo e(setting()->youtube); ?>" style="text-decoration: none;color: #ca0909;" target="_blank">
Youtube
</a>
<?php endif; ?>
</div></td></tr>
</tbody></table>
<table style="padding:0 0;background:#fff" width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td>
<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr>
<td style="color:#babbbe;font-size:12px;text-align:center">© 2022 <a href="<?php echo e(setting()->website_url); ?>" target="_blank" style="text-decoration: none;color: #ca0909;" > <?php echo e(domain()); ?></a>. All rights reserved.</td></tr>
</tbody></table></td></tr></tbody></table></td></tr></tbody>
</table></center></td></tr></tbody></table></td></tr></tbody></table></center><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/email/order.blade.php ENDPATH**/ ?>