<!DOCTYPE html>
<html>
<head>
 <title>Successfully Registered on <?php echo e(setting()->comp_name); ?></title> 
</head>    
<body>
    
<h3>Hi <?php echo e($name); ?>,</h3> 
<h4>We are happy to have you as the newest member of <?php echo e(setting()->comp_name); ?>

This is a registration email as per the details submitted by you. You are now registered on <?php echo e(setting()->comp_name); ?> with the following details:</h4>
    
<table border="0" cellpadding="10" style="width:50%">
<thead>
  <tr>
    <th valign="middle" align="left">Email :</th>
    <td><?php echo e($email); ?></td>
  </tr>

  <tr>
    <th valign="middle" align="left">Password :</th>
    <td><?php echo e($password); ?></td>
  </tr>
  
</thead>

</table>

<p>Please feel free to contact us if you have any questions at all.</p>
<p>Thankyou.</p>
<p><?php echo e(setting()->comp_name); ?> Customer Service</p>
<p>Email: <?php echo e(setting()->email); ?></p>
    
</body>
</html><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/email/registration.blade.php ENDPATH**/ ?>