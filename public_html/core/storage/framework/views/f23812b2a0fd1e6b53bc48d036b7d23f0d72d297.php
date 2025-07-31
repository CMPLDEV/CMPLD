<html lang="en">
<head>
<!--  HEAD  -->
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Inquiry Received</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>
body {
  font-family: Poppins, sans-serif;
  padding:20px;
  background: #f1f1f1;
}

.container {
  background-color: #000000;
  width:80%;
  max-width:600px;
  margin-left:auto;
  margin-right:auto;
}

.inner_container {
  background-color:#ffffff;
  padding:20px;
}

header, footer {
  text-align:center;
}

.email_inner_section {
    padding: 20px 0 0px 0;
}

.email_inner_section h3 {
    font-size: 16px;
    line-height: 28px;
}

hr {
  height:5px;
  background-color: brown;
  border-color: brown;
}

h1 {
  color:brown;
}

.enquiry_submission table {
  text-align:left;
  margin-top:50px;
}

.enquiry_submission table tbody tr th {
    width: 40%;
    vertical-align: top;
}

.enquiry_submission th, .enquiry_submission td {
  padding: 10px;
  margin:0;
}

.enquiry_submission th {
    color: brown;
    font-weight: 600;
    line-height: 22px;
    font-size: 14px;
}


.enquiry_submission td, th {
    border: 1px solid #ccc;
}

.enquiry_submission td {
    font-weight:400;
    font-size: 15px;
    line-height: 21px;
    text-align: justify;
}

.email_footer {
    color: #ffffff;
    padding: 20px;
}

.email_footer a {
  color: #ffffff;
  text-decoration:none;
}

.email_footer h3 {
    font-size: 24px;
    color: #ffffff;
    text-transform: capitalize;
    line-height: 35px;
    margin: 10px 0;
}

.email_footer p{
    font-size:13px;
}

@media only screen and (max-width:500px){
  .enquiry_submission th, .enquiry_submission td {
    display: block;
    width: 100% !important;
}
}    
</style>

</head>
<!-- BODY   -->
<body>
<div class="container">
<div class="inner_container">
<header>
<img src="<?php echo e(setting()->website_url); ?>/uploaded_files/logo/<?php echo e(setting()->logo); ?>" width="100px"/>
<h1>Inquiry Submission</h1>
</header>
<hr>
<div class="email_content">
<div class="email_inner_section">
  <h3>Hi Admin, you have a new inquiry submission from <?php echo e($name); ?>.</h3>
  <div class="enquiry_submission">
  <table>
    <tbody>
      <tr>
        <th>Client Name</th>
        <td><?php echo e($name); ?></td>
      </tr>
      <tr>
        <th>Client's Email Address</th>
        <td><?php echo e($email); ?></td>
      </tr>
      <tr>
        <th>Client's Contact Number</th>
        <td><?php echo e($mobile); ?></td>
      </tr>
      <tr>
        <th>Client's Message</th>
        <td><?php echo e($msg); ?></td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</div>
</div>
<!--   Footer     -->
<footer>
  <div class="email_footer">
   <h3><?php echo e(setting()->comp_name); ?></h3>
   <p> <a href="#"><?php echo e(domain()); ?></a> </p>
   <p><?php echo e(setting()->address); ?> <?php echo e(setting()->city); ?> - <?php echo e(setting()->pincode); ?> <?php echo e(state(setting()->state)); ?>, <?php echo e(country(setting()->country)); ?> </p>
   <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> <?php echo e(setting()->comp_name); ?> All Rights Reserved</p>
    </div>
</footer>
<!--   footer ends     -->
</div>
</body>
</html><?php /**PATH /home/u336648322/domains/computronicsmultivision.com/public_html/core/resources/views/email/enquiry.blade.php ENDPATH**/ ?>