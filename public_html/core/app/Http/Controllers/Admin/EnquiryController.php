<?php

namespace App\Http\Controllers\Admin;

use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class EnquiryController extends Controller{
    
    public $name;
    public $email;
    public $mobile;
    public $subject;
    public $source;
    public $message;
    public $is_mail;
    
    protected $section_name;

    public function __construct(){
     $this->section_name = "Inquiry";  
     $this->middleware('auth:admin')->except('saveEnquiry');
    }

    public function index(){
     $data = Enquiry::latest()->paginate(50);
     $i = $data->perPage() * ($data->currentPage()-1);
     return view('admin.enquiry',compact('data','i'));  
    }

    public function saveEnquiry(){
      $data = new Enquiry();
      $data->name = $this->name;
      $data->email = $this->email;
      $data->mobile = $this->mobile;
      $data->subject = $this->subject;
      $data->source = $this->source;
      $data->message = $this->message;  
      $data->save();

      if($this->is_mail){
        $this->sendMail();
      }
    }

    public function sendMail(){
      $data = array('name'=>$this->name,'email'=>$this->email,'mobile'=>$this->mobile,'msg'=>$this->message);
      $mail = new MailController();
      $mail->template = "email.enquiry";
      $mail->receiver_email = setting()->email;
      $mail->receiver_name = setting()->comp_name;
      $mail->subject = "Enquiry received from ".setting()->comp_name;
      $mail->data = $data;
      $mail->send();
    }

    public function bottomAction(Request $req){
     $ids = $req->ids;
     $action = $req->req_for;
     if($action == "Delete"){
      foreach($ids as $id){
       $data = Enquiry::find($id);
       logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
       $data->delete();
      }     
     }
     return back()->with('message','success|Action completed.');
    }

}
