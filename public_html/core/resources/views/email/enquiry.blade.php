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
<img src="{{setting()->website_url}}/uploaded_files/logo/{{setting()->logo}}" width="100px"/>
<h1>Inquiry Submission</h1>
</header>
<hr>
<div class="email_content">
<div class="email_inner_section">
  <h3>Hi Admin, you have a new inquiry submission from {{$name}}.</h3>
  <div class="enquiry_submission">
  <table>
    <tbody>
      <tr>
        <th>Client Name</th>
        <td>{{$name}}</td>
      </tr>
      <tr>
        <th>Client's Email Address</th>
        <td>{{$email}}</td>
      </tr>
      <tr>
        <th>Client's Contact Number</th>
        <td>{{$mobile}}</td>
      </tr>
      <tr>
        <th>Client's Message</th>
        <td>{{$msg}}</td>
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
   <h3>{{setting()->comp_name}}</h3>
   <p> <a href="#">{{domain()}}</a> </p>
   <p>{{setting()->address}} {{setting()->city}} - {{setting()->pincode}} {{state(setting()->state)}}, {{country(setting()->country)}} </p>
   <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> {{setting()->comp_name}} All Rights Reserved</p>
    </div>
</footer>
<!--   footer ends     -->
</div>
</body>
</html>