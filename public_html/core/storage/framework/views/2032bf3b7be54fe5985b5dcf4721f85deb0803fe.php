

<?php $__env->startSection('custom-css'); ?>
<style>
.title {
max-width: 400px;
margin: auto;
text-align: center;
font-family: "Poppins", sans-serif;
}
.title h3 {
font-weight: bold;
}
.title p {
font-size: 12px;
color: #118a44;
}
.title p.msg {
color: initial;
text-align: initial;
font-weight: bold;
}

.otp-input-fields {
margin: auto;
background-color: white;
box-shadow: 0px 0px 3px 0px #02025044;
max-width: 400px;
width: auto;
display: flex;
justify-content: center;
gap: 10px;
padding: 40px;
}
.otp-input-fields input {
height: 40px;
width: 40px;
background-color: transparent;
border-radius: 4px;
border: 1px solid #2f8f1f;
text-align: center;
outline: none;
font-size: 16px;
/* Firefox */
}
.otp-input-fields input::-webkit-outer-spin-button, .otp-input-fields input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
.otp-input-fields input[type=number] {
-moz-appearance: textfield;
}
.otp-input-fields input:focus {
border-width: 2px;
border-color: #287a1a;
font-size: 20px;
}

.result {
max-width: 400px;
margin: auto;
padding: 24px;
text-align: center;
}
.result p {
font-size: 24px;
font-family: "Antonio", sans-serif;
opacity: 1;
transition: color 0.5s ease;
}
.result p._ok {
color: green;
}
.result p._notok {
color: red;
border-radius: 3px;
}   
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="main-container">
<div class="container">
<div class="row">
<div class="col-sm-5 login-box" style="display: flex;
    justify-content: center; width: 100%;
    flex-direction: column; align-items: center;">
<div class="card card-default" style="width:50%;">
<div class="card-body">
<form action="<?php echo e(route('register.otp.verify')); ?>" class="otp-form" name="otp-form" method="POST">
<?php echo csrf_field(); ?> 
<div class="title">
<h3><span style="color: red;">OTP </span>VERIFICATION</h3>
<p class="info">An otp has been sent to: <?php echo e(Session::get('reg_data')['email']); ?></p>
<p class="msg">Please enter OTP to verify</p>
</div>
<div class="otp-input-fields">
<input type="number" class="otp__digit otp__field__1">
<input type="number" class="otp__digit otp__field__2">
<input type="number" class="otp__digit otp__field__3">
<input type="number" class="otp__digit otp__field__4">
</div>
<input type="hidden" name="otp" id="otp">

<center></center>

</form>
</div>
<div class="card-footer">

<p> <a href="<?php echo e(route('register.otp.resend')); ?>">Resend verification mail</a> </p>

<div style=" clear:both"></div>
</div>
</div>
<div class="login-box-btm text-center">
<p> Don't have an account? <br>
<a href="<?php echo e(route('register')); ?>"><strong>Sign Up !</strong> </a></p>
</div>
</div>
</div>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-script'); ?>
<script>
var otp_inputs = document.querySelectorAll(".otp__digit")
var mykey = "0123456789".split("")
otp_inputs.forEach((_)=>{
_.addEventListener("keyup", handle_next_input)
})
function handle_next_input(event){
let current = event.target
let index = parseInt(current.classList[1].split("__")[2])
current.value = event.key

if(event.keyCode == 8 && index > 1){
current.previousElementSibling.focus()
}
if(index < 4 && mykey.indexOf(""+event.key+"") != -1){
var next = current.nextElementSibling;
next.focus()
}
var _finalKey = ""
for(let {value} of otp_inputs){
_finalKey += value
}
if(_finalKey.length == 4){
let verify_btn = document.createElement("button");
verify_btn.setAttribute('type','submit');
verify_btn.setAttribute('id','verify-btn');
verify_btn.setAttribute('class','btn btn-info btn-sm verify_btn');
verify_btn.textContent = "Verify Now";
$('center').html(verify_btn);
$('#otp').val(_finalKey);
}else{
$('#verify-btn').remove();
}
}    
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/laravel/website/computronicsmultivision.com/core/resources/views/auth/otp-form.blade.php ENDPATH**/ ?>