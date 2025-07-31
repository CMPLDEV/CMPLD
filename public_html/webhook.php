<?php

$data = file_get_contents('php://input');
$headers = getallheaders();
$en_headers = json_encode($headers);
//file_put_contents('body.json',$data);
//file_put_contents('header.json',$en_headers);

$calculated = hash_hmac('sha256', $data, 'cmpl_secret');
$recieved = $headers['X-Razorpay-Signature'];
$data = json_decode($data);

if($calculated == $recieved){
 $order_id = $data->payload->payment->entity->order_id;
 $payment_id = $data->payload->payment->entity->id;
 $post = [
    'order_id' => $order_id,
    'payment_id' => $payment_id,
 ];
 $ch = curl_init('https://www.computronicsmultivision.com/api/webhook');
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 $response = curl_exec($ch);
 curl_close($ch);
    
}

?>