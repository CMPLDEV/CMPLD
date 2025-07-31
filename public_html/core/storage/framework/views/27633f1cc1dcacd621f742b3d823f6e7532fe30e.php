<html>
<head>
</head>
<body onload="submitPayuForm()">
Processing Payment.....
<form action="<?php echo e($action); ?>" method="post" name="payuForm"><br />
    <input type="hidden" name="key" value="<?php echo e($MERCHANT_KEY); ?>" /><br />
    <input type="hidden" name="hash" value="<?php echo e($hash); ?>"/><br />
    <input type="hidden" name="txnid" value="<?php echo e($txnid); ?>" /><br />
    <input type="hidden" name="amount" value="<?php echo e($amount); ?>" /><br />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo e($name); ?>" /><br />
    <input type="hidden" name="phone" id="phone" value="<?php echo e($phone); ?>" /><br />
    <input type="hidden" name="email" id="email" value="<?php echo e($email); ?>" /><br />
    <input type="hidden" name="productinfo" value="<?php echo e($productinfo); ?>"><br />
    <input type="hidden" name="surl" value="<?php echo e($successURL); ?>" /><br />
    <input type="hidden" name="furl" value="<?php echo e($failURL); ?>" /><br />
    <input type="hidden" name="service_provider" value="payu_paisa"  /><br />
    <?php
    if(!$hash) { ?>
        <input type="submit" value="Submit" />
    <?php } ?>
</form>
<script>
var payuForm = document.forms.payuForm;
payuForm.submit();
</script>
</body>
</html><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/payment/pay-u.blade.php ENDPATH**/ ?>