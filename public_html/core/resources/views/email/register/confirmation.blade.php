<!DOCTYPE html>
<html>
<head>
 <title>Successfully Registered on {{setting()->comp_name}}</title> 
</head>    
<body>
    
<h3>Hi {{$name}},</h3> 
<h4>We are happy to have you as the newest member of {{setting()->comp_name}}
This is a registration email as per the details submitted by you. You are now registered on {{setting()->comp_name}} with the following details:</h4>
    
<table border="0" cellpadding="10" style="width:50%">
<thead>
  <tr>
    <th valign="middle" align="left">Name :</th>
    <td>{{$name}}</td>
  </tr>
  <tr>
    <th valign="middle" align="left">Email :</th>
    <td>{{$email}}</td>
  </tr>
  <tr>
    <th valign="middle" align="left">Mobile No :</th>
    <td>{{$mobile}}</td>
  </tr>
  
</thead>

</table>

<p>Please feel free to contact us if you have any questions at all.</p>
<p>Thankyou.</p>
<p>{{setting()->comp_name}} Customer Service</p>
<p>Email: {{setting()->email}}</p>
    
</body>
</html>