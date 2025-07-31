<?php

namespace App\Http\Controllers\Admin;

use DB;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionMailing;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class SubscriptionController extends Controller{
    
    public $email;
    public $bulk_subscription_id;
    protected $section_name;

    public function __construct(){
     $this->section_name = "Subscriber";    
     $this->middleware('auth:admin')->except('saveSubscription','sendVerificationRequest');
    }

    public function index(){
     $data = Subscription::latest()->paginate(50);
     $i = $data->perPage() * ($data->currentPage()-1);
     return view('admin.subscription',compact('data','i'));  
    }

    public function bottomAction(Request $req){
     $ids = $req->ids;
     $action = $req->req_for;
     if($action == "Delete"){
      foreach($ids as $id){
       $data = Subscription::find($id);
       logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->email);
       $data->delete();
      }
     }
     return back()->with('message','success|Action completed.');
    } 

    public function bulk(){
     $data = SubscriptionMailing::latest()->paginate(50);
     $i = $data->perPage() * ($data->currentPage() -1);
     return view('admin.subscription-bulk',compact('data','i'));
    }

    public function addBulk(){
     return view('admin.addedit-subscription-bulk');
    }

    public function bulkBottomAction(Request $req){
     $ids = $req->ids;
     $action = $req->req_for;
     if($action == "Delete"){
      foreach($ids as $id){
       $data = SubscriptionMailing::find($id);
       @unlink("uploaded_files/subscription/".$data->image);
       SubscriptionMailing::where('id',$data->id)->delete();
      }
     }
     return back()->with('message','success|Action completed.');
    } 

    public function createBulk(Request $req){
     $req->validate(['subject'=>'required|max:255','image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150','content'=>'required']);
     $create = new SubscriptionMailing();
     $image = "";  
     if($req->hasFile('image')){
      $file = $req->file('image');
      $image = time().'.'.$file->getClientOriginalExtension();
      $path = public_path("/uploaded_files/subscription");
      if(is_dir($path)==false){mkdir($path);}
      $file->move($path,$image);
      $create->image = $image;
     }

     $create->subject = $req->subject;
     $create->content = $req->content;
     $create->save();

     $this->bulk_subscription_id = $create->id;
     $this->sendBulkMail();
    }

    public function sendBulkMail(){
     $bulk_data = SubscriptionMailing::find($this->bulk_subscription_id);
     $data_array = ['bulk_data' => $bulk_data];
     $job = (new \App\Jobs\SendSubsciptionEmail($data_array))->delay(now()->addSeconds(2)); 
     dispatch($job);
     $redirect = setting()->website_url."/admin/subscription/bulk"; 
     echo "<script>window.location.href='$redirect';</script>";
    }

    public function saveSubscription(){
     $data = new Subscription();
     $data->email = $this->email;
     $data->save();
    }

    public function sendMail(){
     $data = array('email'=>$this->email);
     $mail = new MailController();
     $mail->template = "email.subscription";
     $mail->receiver_email = setting()->email;
     $mail->receiver_name = setting()->comp_name;
     $mail->subject = "Subscribed successfully from ".setting()->comp_name;
     $mail->data = $data;
     $mail->send();

     $mail2 = new MailController();
     $mail2->template = "email.subscription";
     $mail2->receiver_email = $this->email;
     $mail2->receiver_name = "";
     $mail2->subject = "Subscribed successfully from ".setting()->comp_name;
     $mail2->data = $data;
     $mail2->send();
    }

    public function sendVerificationRequest(){
     $token = time();
     $data = array('token'=>$token,'email'=>$this->email);
     $mail = new MailController();
     $mail->template = "email.subscription-verification";
     $mail->receiver_email = $this->email;
     $mail->receiver_name = "";
     $mail->subject = "Verification request from ".setting()->comp_name;
     $mail->data = $data;
     $mail->send();
     DB::table('password_resets')->insert(['email'=>$this->email,'token'=>$token]);
    }

}
