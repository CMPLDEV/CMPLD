<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{setting()->comp_name}}</title>
</head>
<body>
    <h3>{{$bulk_data->subject}}</h3> 
   @if(!empty($bulk_data->image))
    <img src="{{asset('uploaded_files/subscription/'.$bulk_data->image)}}" width="100%">
   @endif
   {!! $bulk_data->content !!}

   <p>If you don't want to get our newsletter anymore please click here to 
    <a href="{{route('subscription.unsubscribe',base64_encode($email))}}" style="color:red;">Unsubscribe</a></p>
</body>
</html>