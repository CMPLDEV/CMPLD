<!DOCTYPE html>
<html>
<head>
 <title>OTP Received from <?php echo e(setting()->comp_name); ?></title> 
</head>    
<body>
 <h5>Your OTP is <?php echo e($otp); ?></h5>    
    
 <p>Please feel free to contact us if you have any questions at all.</p>
 <p>Thank you.</p>
 <p><?php echo e(setting()->comp_name); ?> Customer Service</p>
 <p>Email: <?php echo e(setting()->email); ?></p>
    
</body>
</html><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/email/register/otp.blade.php ENDPATH**/ ?>