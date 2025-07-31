<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Ticket;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\TicketComment;
use App\Models\IdentifyProduct;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;

class TicketController extends Controller{
    
 public $subject;
 public $content;
 public $user_id;
 public $mail_data;
 public $ticket_id;
 public $attachment;
 public $serial_no;
 
 protected $section_name;
 
 public function __construct(){
  $this->section_name = "Ticket";     
  $this->middleware('auth:admin')->except(['initiateTicket']);     
 }
 
 public function initiateTicket(){
  $data = IdentifyProduct::where('serial_no',$this->serial_no)->first();
  return view('user.raise-ticket',compact('data'));
 }
 
 public function submitTicket(){
  $data = new Ticket(); 
  $data->serial_no = $this->serial_no;
  $data->subject = $this->subject;
  $data->content = $this->content;
  $data->user_id = $this->user_id;
  $data->attachment = $this->attachment;
  $data->save();
  $status = "OPENED";
  $message = "Thank you for contacting us. Your ticket has been received and will be answered shortly";
  $user = user($data->user_id);
  $this->mail_data = array('ticket'=>$data, 'status'=>$status, 'user'=>$user, 'msg'=>$message);
  $this->sendMail();
  $this->sendMailToAdmin();
  return response()->json(['status'=>true, 'message'=>'Created successfully.']);
 }
 
 public function viewTicketHistory(){
  $data = Ticket::find($this->ticket_id);
  $warranty = IdentifyProduct::where('serial_no',$data->serial_no)->first();
  $comments = TicketComment::where('ticket_id',$data->id)->get();
  return view('user.view-ticket',compact('data','comments','warranty'));
 }
 
 public function index(){
  $data = Ticket::orderBy('is_seen');
  if(admin()->type == "SUB_ADMIN"){
   $data->where('admin_id',admin()->id);      
  }
  $data = $data->paginate(30); 
  $i = $data->perPage() * ($data->currentPage() -1);
  $admins = Admin::where('type','SUB_ADMIN')->where('status',1)->get();
  return view('admin.ticket',compact('data','i','admins'));     
 }
 
 public function detail(Request $req){
  $ticket = Ticket::join('users','users.id','=','tickets.user_id')
              ->select('tickets.*','users.name','users.mobile','users.email')
              ->where('tickets.id',$req->id);
  if(admin()->type == "SUB_ADMIN"){
   $ticket->where('tickets.admin_id','=',\Auth::guard('admin')->user()->id);  
  }          
   $ticket = $ticket->first();
   $warranty = IdentifyProduct::where('serial_no',$ticket->serial_no)
                              ->first();
  if(empty($ticket)){
   return redirect()->route('admin');      
  }               
  $comments = TicketComment::where('ticket_id',$ticket->id)->get();
  Ticket::where('id',$ticket->id)->update(['is_seen' => 1]);
  return view('admin.ticket-detail',compact('ticket','comments','warranty'));
 }
 
 public function updateComment(Request $req){
  $req->validate(['message'=>'required|max:1000', 
                 'attachment'=>'nullable|mimes:jpeg,jpg,png,webp,pdf|max:100']); 
  $data = Ticket::find($req->ticket_id);
  $comment = new TicketComment();
  $comment->status = $req->status;
  $comment->ticket_id = $req->ticket_id;
  $comment->message = $req->message;
 if($req->hasFile('attachment')){
  $file = $req->file('attachment');
  $attachment = md5(time()).'.'.$file->getClientOriginalExtension();
  $path = public_path("/uploaded_files/ticket");
  if(is_dir($path) == false){mkdir($path);}
  $file->move($path,$attachment);
  $comment->attachment = $attachment;
 } 
  $comment->save();
  
  $data->status = $req->status;
  $data->update();
  
  $status = $data->status;
  $message = "Thank you for contacting us. Your ticket status has been updated and will be update next shortly.";
  $this->user_id = $data->user_id;
  $user = user($data->user_id);
  $this->mail_data = array('ticket'=>$data, 'status'=>$status, 'user'=>$user, 'msg'=>$message);
  $this->sendMail();
  return back()->with('message','success|Comment updated.');
 }
 
 /*public function resolved(Request $req){
  $data = Ticket::find($req->id);
  $data->status = "RESOLVED";
  $data->update();
  $status = $data->status;
  $message = "Thank you for contacting us. Your ticket status has been updated and will be update next shortly";
  $this->user_id = $data->user_id;
  $user = user($data->user_id);
  $this->mail_data = array('ticket'=>$data, 'status'=>$status, 'user'=>$user, 'msg'=>$message);
  $this->sendMail();
  return back()->with('message','success|Ticket resolved.'); 
 }*/
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   $comments = TicketComment::whereIn('ticket_id',$ids)->get();
   foreach($comments as $comment){
    @unlink("uploaded_files/ticket/".$comment->attachment);
    TicketComment::where('id',$comment->id)->delete();
   }
   $tickets = Ticket::whereIn('id',$ids)->get();
   foreach($tickets as $ticket){
    @unlink("uploaded_files/ticket/".$ticket->attachment);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $ticket->serial_no);
    Ticket::where('id',$ticket->id)->delete();
   }
  }
  return back()->with('message','success|Action completed.');
 }
 
 public function search(Request $req){
  $status = $req->status; 
  $admin_id = $req->admin_id;
  $search_keyword = $req->search_keyword;
  $data = Ticket::join('users','users.id','=','tickets.user_id')
                ->select('tickets.*')->orderBy('tickets.is_seen');
  if(admin()->type == "SUB_ADMIN"){
   $data->where('admin_id',admin()->id);      
  }                
  if(!empty($search_keyword)){    
   if(strpos($search_keyword,'#') !== false){
    $data->where('tickets.id',str_replace('#','',$search_keyword));
   }else{      
   $data->where(function($q) use($search_keyword){
    $q->where('users.name','LIKE','%'.$search_keyword.'%')
      ->orWhere('users.email','LIKE','%'.$search_keyword.'%')
      ->orWhere('users.mobile','LIKE','%'.$search_keyword.'%');                 
   });
  }}
  if(!empty($status)){
   $data->where('tickets.status',$status);      
  }
  if($admin_id !=""){
   $data->where('admin_id',$admin_id); 
  }

  $data = $data->paginate(30);
  $i = $data->perPage() * ($data->currentPage() -1);
  $admins = Admin::where('type','SUB_ADMIN')->where('status',1)->get();
  return view('admin.ticket',compact('data','i','search_keyword','status','admin_id','admins'));
 }
 
 public function closeTicket(){
  $data = Ticket::find($this->ticket_id);
  $data->status = "CLOSED";
  $data->update();
  $status = $data->status;
  $message = "Thank you for contacting us. Your ticket status has been updated";
  $this->user_id = $data->user_id;
  $user = user($data->user_id);
  $this->mail_data = array('ticket'=>$data, 'status'=>$status, 'user'=>$user, 'msg'=>$message);
  $this->sendMail();
  return back()->with('message','success|Ticket closed.');     
 }
 
  public function assign(Request $req){
   $ids = explode(',',$req->ids);
   $admin_id = $req->admin_id;
   $admin = Admin::find($admin_id);
   if(!empty($ids)){
    foreach($ids as $id){
     $data = Ticket::find($id);
     if($data->admin_id != $admin_id){ 
      $data->admin_id = $admin_id; 
      $data->update();
      //SEND MAIL NOTIFICATION
      $mail = new MailController();
      $mail->template = "email.ticket-admin";
      $mail->receiver_email = $admin->email;
      $mail->receiver_name = $admin->name;
      $mail->subject = "Ticket update from ".setting()->comp_name;
      $mail->data = array('ticket'=>$data, 'status'=>$data->status, 'msg'=>'This ticket has been assigned to you');
      $mail->send();
     }}  
    }
    return true;
   }
 
   public function sendMail(){
    $mail = new MailController();
    $mail->template = "email.ticket";
    $mail->receiver_email = user($this->user_id)->email;
    $mail->receiver_name = user($this->user_id)->name;
    $mail->subject = "Ticket update from ".setting()->comp_name;
    $mail->data = $this->mail_data;
    $mail->send();
   }
   
   public function sendMailToAdmin(){
    $mail = new MailController();
    $mail->template = "email.ticket";
    $mail->receiver_email = setting()->email;
    $mail->receiver_name = setting()->comp_name;
    $mail->subject = "Ticket update from ".setting()->comp_name;
    $mail->data = $this->mail_data;
    $mail->send();
   }

}
