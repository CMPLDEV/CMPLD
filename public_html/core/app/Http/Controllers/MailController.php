<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use PDF;

class MailController extends Controller
{
    public $template;
    public $sender_email;
    public $sender_name;
    public $receiver_email;
    public $receiver_name;
    public $subject;
    public $data;

    public function __construct(){
      $this->sender_email = setting()->email;
      $this->sender_name = setting()->comp_name;  
    }

    public function send(){
     try{ 
      Mail::send($this->template, $this->data, function($message){
         $message->to($this->receiver_email, $this->receiver_name)
          ->subject($this->subject)
          ->from($this->sender_email,$this->sender_name);
      });
    }catch(\Exception $e){} 
        
    }

}
