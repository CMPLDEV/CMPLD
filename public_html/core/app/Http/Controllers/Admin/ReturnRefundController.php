<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ReturnRefund;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class ReturnRefundController extends Controller{
 
 public $image;
 public $reason;
 public $description;
 
 public $item_id;
 public $user_id;
 public $order_id;
 public $order_detail_id;
 
 public $file_path;
 protected $section_name;
 
 public function __construct(){
  $this->middleware('auth:admin')->except(['create','mailToAdmin']);
  $this->file_path = "uploaded_files/return_refund";
  $this->section_name = "Return-Refund";
 }
 
 public function index(){
  $data = ReturnRefund::join('order_details','order_details.id','=','return_refunds.order_detail_id')
         ->select('return_refunds.*','order_details.item_name')
         ->orderBy('status')->paginate(30);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.return-refund', compact('data','i'));
 }
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   $data = ReturnRefund::whereIn('id',$ids)->get();      
    foreach($data as $row){
     @unlink($this->file_path."/".$row->image);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $row->order_id);
     ReturnRefund::where('id',$row->id)->delete();
    }
  }else if(in_array($action, ['IN_PROCESS','APPROVED','REJECTED'])){
   //UPDATE STATUS    
   $status = 1;
   if($action == "IN_PROCESS"){
    $status = 2;   
   }else if($action == "APPROVED"){
    $status = 3;   
   }else if($action == "REJECTED"){
    $status = 4;   
   }
    
   //SEND MAIL TO USER
   foreach($ids as $id){
    $return_refund = ReturnRefund::find($id);
    if($return_refund->refund_status != "REFUNDED"){
     ReturnRefund::where('id',$return_refund->id)
                 ->update(['status'=>$status]);    
     $this->user_id = $return_refund->user_id;
     $this->reason = $return_refund->reason;
     $this->order_detail_id = $return_refund->order_detail_id;
     $this->mailToUser($status);    
     logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $id." - ".$action);
    }
   }
   
  }
  return back()->with('message','success|Action completed.');
 }
 
 public function mailToUser($status){
  $user = Order::where('user_id',$this->user_id)->first();  
  $order_detail = OrderDetail::find($this->order_detail_id);
  $data = array('title'=>"Hi ".$user->name, 'content'=>"Order return status has been updated. The details of the request are as follows:", 'user'=>$user, 'order_id'=>"#".$order_detail->order_id, 'product'=>$order_detail->item_name, 'reason'=>$this->reason, 'status'=>$status);     
  $mail = new MailController();
  $mail->template = "email.return-refund";
  $mail->receiver_email = $user->email;
  $mail->receiver_name = $user->name;
  $mail->subject = setting()->comp_name." - Order Return Status Update.";
  $mail->data = $data;
  $mail->send();       
 }
 
 public function updateRefundStatus(Request $req){
  ReturnRefund::where('id',$req->id)->update(['refund_status'=>$req->status]); 
  return true;
 }
 
 public function isExist(){
  return ReturnRefund::where('user_id',$this->user_id)->where('order_detail_id',$this->order_detail_id)->count();     
 }
 
 public function create(){
  if($this->isExist() == 0){     
  $data = new ReturnRefund();
  $data->user_id = $this->user_id;
  $data->order_id = $this->order_id;
  $data->order_detail_id = $this->order_detail_id;
  $data->item_id = $this->item_id;
  $data->status = 1;
  $data->refund_status = "PENDING";
  $data->reason = $this->reason;
  $data->description = $this->description;
 if($this->image){
  $file = $this->image;
  $image = time().'.'.$file->getClientOriginalExtension();
  $path = public_path("/".$this->file_path);
  if(is_dir($path) == false){mkdir($path);}
  $file->move($path,$image);
  $data->image = $image;
 }
  $data->save();
  $this->mailToAdmin();
  }
 }
 
 public function mailToAdmin(){
  $user = User::find($this->user_id);  
  $order_detail = OrderDetail::find($this->order_detail_id);
  $data = array('title'=>"Hi Admin", 'content'=>"A user has submitted a refund request through our website. The details of the request are as follows:", 'user'=>$user, 'order_id'=>"#".$this->order_id, 'product'=>$order_detail->item_name, 'reason'=>$this->reason, 'status'=>1);     
  $mail = new MailController();
  $mail->template = "email.return-refund";
  $mail->receiver_email = setting()->email;
  $mail->receiver_name = setting()->comp_name;
  $mail->subject = setting()->comp_name." - Order Return Request Received.";
  $mail->data = $data;
  $mail->send();
 }
     
}