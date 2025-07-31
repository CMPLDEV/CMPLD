<?php

$data = file_get_contents('php://input');
$headers = getallheaders();
$en_headers = json_encode($headers);
//file_put_contents('body.json',$data);
//file_put_contents('header.json',$en_headers);