<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{setting()->comp_name}}</title>
</head>
<body>
<h4>This is a verification mail.</h4>
<p style="font-family:'helvetica',sans-serif;font-size:14px;color:#000">
To verify your email account please, <a href="{{route('subscription-verification',[base64_encode($email),base64_encode($token)])}}">Click Here</a>
</p>

</body>
</html>