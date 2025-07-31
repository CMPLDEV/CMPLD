<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title><?php echo e(setting()->comp_name); ?> | Payment</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div id="app">
<main class="py-4">
<div class="container">
<div class="row">
<div class="col-md-6 offset-3 col-md-offset-6">

   <form action="<?php echo e($url); ?>" method="post" name="payuForm" id="payuForm" style="display: none">
    <input type="hidden" name="key" value="<?=$data['key']?>" />
    <input type="hidden" name="hash" value="<?=$data['hash']?>"/>
    <input type="hidden" name="txnid" value="<?=$data['txnid']?>" />
    <input type="hidden" name="amount" value="<?=$data['amount']?>" />
    <input type="hidden" name="firstname" value="<?=$data['firstname']?>" />
    <input type="hidden" name="email" value="<?=$data['email']?>" />
    <input type="hidden" name="phone" value="<?=$data['phone']?>" />
    <input type="hidden" name="productinfo" value="<?=$data['productinfo']?>">
    <input type="hidden" name="surl" value="<?=$data['surl']?>" />
    <input type="hidden" name="furl" value="<?=$data['furl']?>"/>
    <input type="hidden" name="service_provider" value="payu_paisa"/>
    <input type="hidden" name="udf1" value="" />
    <input type="hidden" name="udf2" value="" />
    <input type="hidden" name="udf3" value="" />
    <input type="hidden" name="udf4" value="" />
    <input type="hidden" name="udf5" value="" />
   </form>

</div>
</div>
</div>
</main>
</div>

<script>
 $(document).ready(function(){ $('#payuForm').submit(); });
</script>

</body>
</html><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/payment/payu.blade.php ENDPATH**/ ?>