<?php

namespace App\Http\Controllers;

use PDF;
use Auth;
use Hash;
use Session;
use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\UserAddress;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\ReturnRefund;
use App\Models\IdentifyProduct;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TicketController;
use App\Http\Controllers\Admin\ReturnRefundController;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
     $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
     $user = user();
     return view('user.index');
    }

    public function profile(){
     return view('user.profile');
    }

    public function updateProfile(Request $req){
      $req->validate(['name'=>'required|max:255','email'=>'required|email|max:255|unique:users,email,'.user()->id,
        'mobile'=>'required|numeric|digits:10|unique:users,mobile,'.user()->id,
        'address'=>'required|max:200',
        'city'=>'required|max:100',
        'pincode'=>'required|max:15',
        'state'=>'required',
        'country'=>'required',
        'gst_no'=>'nullable|min:15|max:15',
        'aadhar_no'=>'nullable|min:12|max:12',
        'pan_no'=>'nullable|min:10|max:10']);
        
      if(emailMobileValidation('email',$req->email,0,user()->id)== false){ return back()->with('message','error|Email address is already exist.'); } 
      if(emailMobileValidation('mobile',$req->mobile,0,user()->id)== false){ return back()->with('message','error|Mobile no is already exist.'); } 
      
      $data = User::find(user()->id);
      $data->name = $req->name;
      $data->email = $req->email;
      $data->mobile = $req->mobile;
      $data->gst_no = $req->gst_no;
      $data->aadhar_no = $req->aadhar_no;
      $data->pan_no = $req->pan_no;
      $data->address = $req->address;
      $data->city = $req->city;
      $data->pincode = $req->pincode;
      $data->state = $req->state;
      $data->country = $req->country;
      $data->update();
      return back()->with('message','success|Profile updated.');
    }

    public function changePassword(){
     return view('user.change-password'); 
    }  

    public function updateChangePassword(Request $req){
     $old_pass_req = (empty(user()->password)) ? "nullable" : "required";       
      $req->validate(['old_password'=>$old_pass_req,'new_password'=>'required|min:6','confirm_password'=>'required|same:new_password']);
     if($old_pass_req == "required"){ 
      if(!Hash::check($req->old_password,user()->password)){
       return back()->with('message','error|Invalid old password.');
      }
     } 
      User::where("id",user()->id)->update(['password' => Hash::make($req->new_password)]);
      return back()->with('message','success|Password updated.');
      
    }

    public function address(){
     $data = addresses(user()->id);
     return view('user.address',compact('data'));
    }

    public function addAddress(){
     return view('user.addedit-address');
    }

    public function createAddress(Request $req){
     if(COUNT(addresses(user()->id)) >= 5){
      return back()->with('message','error|You cannot add more than 5 address.');
     }
      $req->validate(['name'=>'required|max:255','email'=>'required|email|max:255|unique:user_addresses,email',
                      'mobile'=>'required|numeric|digits:10|unique:user_addresses,mobile',
                      'address'=>'required|max:255','city'=>'required','pincode'=>'required','country'=>'required','state'=>'required']);           
     if(emailMobileValidation('email',$req->email,1,user()->id)== false){ return back()->with('message','error|Email address is already exist.'); }
     if(emailMobileValidation('mobile',$req->mobile,1,user()->id)== false){ return back()->with('message','error|Mobile no is already exist.'); }            

      $data = new UserAddress();
      $data->user_id = user()->id;
      $data->name = $req->name;
      $data->email = $req->email;
      $data->mobile = $req->mobile;
      $data->address = $req->address;
      $data->city = $req->city;
      $data->pincode = $req->pincode;
      $data->country = $req->country;
      $data->state = $req->state;
      $data->save();
      return back()->with('message','success|Created successfully.');               
    }

    public function editAddress(Request $req){
     $edit = UserAddress::find($req->id);
     return view('user.addedit-address',compact('edit'));
    } 
    
    public function updateAddress(Request $req){
      $req->validate(['name'=>'required|max:255','mobile'=>'required|numeric|digits:10|unique:user_addresses,mobile,'.$req->id,
        'email'=>'required|email|max:255|unique:user_addresses,email,'.$req->id,
        'address'=>'required|max:255','city'=>'required','pincode'=>'required',
        'country'=>'required','state'=>'required']);
      if(emailMobileValidation('email',$req->email,1,user()->id)== false){ return back()->with('message','error|Email address is already exist.'); }
      if(emailMobileValidation('mobile',$req->mobile,1,user()->id)== false){ return back()->with('message','error|Mobile no is already exist.'); }
      
      $data = UserAddress::find($req->id);
      $data->user_id = user()->id;
      $data->name = $req->name;
      $data->email = $req->email;
      $data->mobile = $req->mobile;
      $data->address = $req->address;
      $data->city = $req->city;
      $data->pincode = $req->pincode;
      $data->country = $req->country;
      $data->state = $req->state;
      $data->update();
      return back()->with('message','success|Updated successfully.');               
    }

    public function removeAddress(Request $req){
     UserAddress::where('id',$req->id)->delete();
     return back()->with('message','success|Removed successfully.');
    }

    public function setDefaultAddress(Request $req){
     $data = User::find(user()->id);
     $data->default_address = $req->address_id;
     $data->update();
     //SET ALL ADDRESS DEFAULT 0
     UserAddress::where('user_id',$data->id)->update(['is_default'=>0]);

     $address = UserAddress::find($req->address_id);
     $address->is_default = 1;
     $address->update();
     return true;
    }

    public function orders(){
     $data = Order::latest()->where('user_id',user()->id)->paginate(20);
     $i = $data->perPage() * ($data->currentPage() -1);
     return view('user.order',compact('data','i'));
    }

    public function orderDetail(Request $req){
     $i=1;
     $order = Order::find($req->id);
     if(empty($order)){
      return redirect()->route('userpanel');     
     }
     $order_detail = OrderDetail::where('order_id',$order->id)->get();
     $invoice = Invoice::where('order_id', $order->id)->first();
     return view('user.order-detail',compact('order','order_detail','i','invoice'));
    }

    public function orderCancelModal(Request $req){
     $order = Order::find($req->id);
     return view('user.cancel-order',compact('order'));
    }

    public function orderCancel(Request $req){
     $cancel_note = $req->cancel_note;
     if(empty($cancel_note)){
      return back()->with('message','error|Please provide cancel note.');     
     }
     $order = Order::find($req->id);
     $order->delivery_status = "CANCELLED";
     $order->cancel_note = $req->cancel_note;
     $order->cancelled_by = "USER";
     $order->update();
     // SEND MAIL
     $order_mail = new OrderController();
     $order_mail->order_id = $order->id;
     $order_mail->mail_subject = "Order CANCELLED from ".setting()->comp_name;
     $order_mail->mail_msg = "We are inform you that your order with ".setting()->comp_name." has been successfully CANCELLED by you.";
     $order_mail->sendMail();
     return back()->with('message','success|Cancelled successfully.');
    }
    
    public function viewInvoice(Request $req){
     $order = Order::find($req->id);
     $order_detail = OrderDetail::where('order_id',$req->id)->get();
     $invoice = Invoice::where('order_id',$req->id)->first();
    
     $info['order'] = $order;
     $info['order_detail'] = $order_detail;
     $info['invoice'] = $invoice;
     $pdf = PDF::loadView('invoice.index',$info);
     $pdf->setOptions(['isHtml5ParserEnabled' => true,'isPhpEnabled' => true,'isRemoteEnabled' => true]);
     return $pdf->stream();
    }
    
    public function tickets(){
     $data = Ticket::where('user_id',user()->id)->latest()->paginate(10);
     $i = $data->perPage() * ($data->currentPage() - 1);
     
     $products = Order::join('order_details','order_details.order_id','orders.id')->where('order_details.warranty_end','>=',date('Y-m-d'))
              ->select('orders.id as order_id','order_details.id as order_detail_id','order_details.item_id','order_details.item_name')
              ->where('orders.user_id','=',user()->id)
              ->get();
     return view('user.ticket',compact('data','i','products'));
    }
    
    public function searchTicket(Request $req){
     $status = $req->status;    
     $search_keyword = $req->search_keyword;
        
     $data = Ticket::where('user_id',user()->id)->latest();
     if(!empty($search_keyword)){
      if(strpos($search_keyword,'#') !== false){
       $data->where('id',str_replace('#','',$search_keyword));
      }else{ 
       $data->where('subject','LIKE','%'.$search_keyword.'%');
      }   
     }
     if(!empty($status)){
      $data->where('status',$status);     
     }
     $data = $data->paginate(10);
     $i = $data->perPage() * ($data->currentPage() - 1);
     
     $products = Order::join('order_details','order_details.order_id','orders.id')->where('order_details.warranty_end','>=',date('Y-m-d'))
              ->select('orders.id as order_id','order_details.id as order_detail_id','order_details.item_id','order_details.item_name')
              ->get();
     return view('user.ticket',compact('data','i','products','search_keyword','status'));
    }
    
    public function isSerialNoExist($serial_no){
     return IdentifyProduct::where('serial_no',$serial_no)->count();   
    }
    
    public function raiseTicket(Request $req){ 
     if($this->isSerialNoExist($req->serial_no) == 0){
      return response()->json(['msg'=>'Please provide valid serial no.'],201);
     }    
     $data = new TicketController();
     $data->serial_no = $req->serial_no;
     return $data->initiateTicket();
    }
    
    public function submitTicket(Request $req){
     $validator = Validator::make($req->all(), [
        'attachment' => ['nullable', 'mimes:jpeg,jpg,png,webp,pdf', 'max:200'],
        'serial_no' => ['required'],
        'subject' => ['required', 'max:200'],
        'content' => ['required', 'max:255'],
    ]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
     $attachment = "";
     $data = new TicketController();
     $data->user_id = user()->id;
     $data->serial_no = $req->serial_no;
     $data->subject = $req->subject;
     $data->content = $req->content;
    if($req->hasFile('attachment')){
     $file = $req->file('attachment');   
     $attachment = md5(time()).'.'.$file->getClientOriginalExtension();
     $path = public_path("/uploaded_files/ticket");
     if(is_dir($path) == false){mkdir($path);}
     $file->move($path,$attachment);
    } 
     $data->attachment = $attachment;
     return $data->submitTicket();
    }
    
    public function viewTicket(Request $req){
     $data = new TicketController();
     $data->user_id = user()->id;
     $data->ticket_id = $req->ticket_id;    
     return $data->viewTicketHistory();
    }
    
    public function closeTicket(Request $req){
     $data = new TicketController();
     $data->ticket_id = $req->ticket_id;
     return $data->closeTicket();    
    }
    
    public function returnRefund(){
     $returnable_products = Order::join('order_details','order_details.order_id','=','orders.id')->where('orders.return_applicable_date','>=',date('Y-m-d'))->whereNotIn('order_details.id', function($q){
              $q->select('order_detail_id')
                ->from('return_refunds')
                ->where('user_id',user()->id);
        })->select('orders.return_applicable_date','order_details.*')
        ->where('orders.user_id',user()->id)->get();
     $data = ReturnRefund::join('order_details','order_details.id','=','return_refunds.order_detail_id')->where('return_refunds.user_id',user()->id)->select('return_refunds.*','order_details.item_name')
                ->paginate(30);        
     return view('user.return_refund.index', compact('returnable_products','data')); 
    }
    
    public function returnRefundRequestPopup(Request $req){
     $order_detail = OrderDetail::find($req->order_detail_id);
     $product = Product::find($order_detail->item_id);
     return view('user.return_refund.request', compact('order_detail','product'));
    }
    
    public function returnRefundRequest(Request $req){
     $validator = Validator::make($req->all(),[
       'image' => ['nullable','image','mimes:jpeg,jpg,png,webp','max:150'],     
       'reason' => ['required'],
       'description' => ['required','max:1500']
     ]);
     if($validator->fails()){
      return response()->json(['error'=>$validator->errors()],201);     
     }
     
     $order_detail = OrderDetail::find($req->order_detail_id);
     
     $data = new ReturnRefundController();
     $data->user_id = user()->id;
     $data->order_id = $order_detail->order_id;
     $data->order_detail_id = $order_detail->id;
     $data->item_id = $order_detail->item_id;
     $data->reason = $req->reason;
     $data->description = $req->description;
     $data->image = $req->file('image');
     $data->create();
     return response()->json(['success'=>"Request submitted successfully."],200);
    }
   
}
