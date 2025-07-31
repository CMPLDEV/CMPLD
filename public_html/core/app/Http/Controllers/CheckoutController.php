<?php

namespace App\Http\Controllers;

use Str;
use Auth;
use Session;
use Exception;
use App\Models\User;
use App\Models\Cart;
use Razorpay\Api\Api;
use App\Models\Order;
use App\Models\Product;
use App\Models\UserCoupon;
use App\Models\UserAddress;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OrderController;

class CheckoutController extends Controller{
   protected $session_id;
   public function __construct(){
    $this->middleware('auth');   
    $this->middleware(function ($request, $next){
     $this->session_id = cartSession();
     return $next($request);
    });
   }

  public function index(){
   if(cartTotal() == 0){
     return redirect()->route('home')
                      ->with('message','error|Your cart is empty.');    
   }   
   $carts = cartData();
   $meta_title = "Checkout";
   $meta_description = "Checkout";
   $meta_keywords = "Checkout";
   $shipping_address = (Auth::check()) ? shippingAddress(user()->id) : "";
   return view('checkout',compact('carts','meta_title','meta_description','meta_keywords','shipping_address'));
  }

  public function generateOrder(Request $req){   
    if(cartTotal() == 0){
     return redirect()->route('home')
                      ->with('message','error|Your cart is empty.');    
    }
     
     $user_id = 0; 
     $discount = 0;  
     $order_coupon = 0;  
     $coupon_code = "";
     $amount = cartTotal();
     $net_amount = cartTotal();
     $type = $req->type;
     $sub_type = $req->sub_type;
     $is_shipping = (isset($req->is_shipping)) ? 1 : 0;
     $transaction_id = "";
     
     if(in_array($sub_type, ["UPI","DIRECT_BANK_TRANSFER"])){
      if($req->transaction_id == ""){
       return back()->with('message','error|Please provide Transaction ID.');   
      }else{
       $transaction_id = $req->transaction_id;   
      }     
     }
      
    if(Auth::check()){
     $req->validate(['name'=>'required|max:150','address'=>'required',
               'email'=>'required|email|max:255|unique:users,email,'.user()->id,
               'pincode'=>'required|max:10','country'=>'required',
               'state'=>'required','city'=>'required',
               'mobile'=>'required|numeric|digits:10|unique:users,mobile,'.user()->id,
               'gst_no'=>'nullable|min:15',
               'company_name'=>'nullable|max:100|regex:/^[a-zA-Z\s]*$/'
              ]);    
    }else{
     $req->validate(['name'=>'required|max:150','address'=>'required',
                    'email'=>'required|email|max:255',
                    'pincode'=>'required|max:10','country'=>'required',
                    'state'=>'required','city'=>'required',
                    'mobile'=>'required|numeric|digits:10',
                    'gst_no'=>'nullable|min:15',
                    'company_name'=>'nullable|max:100|regex:/^[a-zA-Z\s]*$/'
                  ]);   
    }  
          
     $name = $req->name;
     $email = $req->email;
     $mobile = $req->mobile;
     $pincode = $req->pincode;
     $city = $req->city;
     $address = $req->address;
     $country = $req->country;
     $state = $req->state; 
     $gst_no = $req->gst_no;
     $company_name = $req->company_name;
     
    //ASSIGN DEFAULT SHIPPING ADDRESS AS BILLING 
     $shipping_name = $req->name;
     $shipping_email = $req->email;
     $shipping_mobile = $req->mobile;
     $shipping_pincode = $req->pincode;
     $shipping_city = $req->city;
     $shipping_address = $req->address;
     $shipping_country = $req->country;
     $shipping_state = $req->state; 
     
    //SHIPPING ADDRESS FORM HANDLING 
    if($is_shipping){
     $req->validate(['shipping_name'=>'required|max:150',
                     'shipping_address'=>'required',
                     'shipping_email'=>'required|email|max:255',
                     'shipping_pincode'=>'required|max:10',
                     'shipping_country'=>'required',
                     'shipping_state'=>'required','shipping_city'=>'required',
                     'shipping_mobile'=>'required|numeric|digits:10',
                   ]); 
     $shipping_name = $req->shipping_name;
     $shipping_email = $req->shipping_email;
     $shipping_mobile = $req->shipping_mobile;
     $shipping_pincode = $req->shipping_pincode;
     $shipping_city = $req->shipping_city;
     $shipping_address = $req->shipping_address;
     $shipping_country = $req->shipping_country;
     $shipping_state = $req->shipping_state; 
    } 
    
    if(Auth::check()){
     $user = User::find(user()->id);
    //UPDATE USER DETAILS 
     $user->name = $name;
     $user->email = $email;
     $user->mobile = $mobile;
     $user->address = $address;
     $user->city = $city;
     $user->pincode = $pincode;
     $user->country = $country;
     $user->state = $state;
     $user->gst_no = $gst_no;
     $user->company_name = $company_name;
     $user->is_shipping = $is_shipping;
     $user->update();
     
     $user_address = (!empty(shippingAddress(user()->id))) ? shippingAddress(user()->id) : new UserAddress();
     $user_address->user_id = $user->id;
     $user_address->name = $shipping_name;
     $user_address->email = $shipping_email;
     $user_address->mobile = $shipping_mobile;
     $user_address->address = $shipping_address;
     $user_address->city = $shipping_city;
     $user_address->pincode = $shipping_pincode;
     $user_address->country = $shipping_country;
     $user_address->state = $shipping_state;
     (!empty(shippingAddress(user()->id))) ? $user_address->update() : $user_address->save();
     
     $user_id = $user->id;

     if($coupon = couponCondition()){
      $order_coupon = $coupon->coupon_id;	
      $coupon_code = (!empty(coupon($order_coupon))) ? coupon($order_coupon)->code : "";
      $discount = couponAmount($order_coupon);
      UserCoupon::where('coupon_id',$order_coupon)
                ->where('user_id',Auth::user()->id)
                ->update(['status'=>'USED']);
     }   
    }
    
    $discount += paymentMethodDiscount($sub_type);
    $net_amount = round($amount - $discount);
    
    //exit;
    
    $order = new OrderController();
    $order->user_id = $user_id;
    $order->type = $type;
    $order->sub_type = $sub_type;
    $order->amount = $amount;
    $order->gst_no = $gst_no;
    $order->net_amount = $net_amount;
    $order->payment_status = ($sub_type == "GATEWAY") ? "UNPAID" : "PENDING";
    $order->delivery_status = "PENDING";
    $order->company_name = $company_name;
    $order->gateway_payment_id = $transaction_id;
    $order->coupon = $coupon_code;
    $order->discount = $discount;
    $order->name = $name;
    $order->email = $email;
    $order->mobile = $mobile;
    $order->pincode = $pincode;
    $order->city = $city;
    $order->address = $address;
    $order->country = $country;
    $order->state = $state;
    $order->shipping_name = $shipping_name;
    $order->shipping_email = $shipping_email;
    $order->shipping_mobile = $shipping_mobile;
    $order->shipping_pincode = $shipping_pincode;
    $order->shipping_city = $shipping_city;
    $order->shipping_address = $shipping_address;
    $order->shipping_country = $shipping_country;
    $order->shipping_state = $shipping_state;
    $order_id = $order->saveOrder();

    $carts = cartData();
    if($carts->isNotEmpty()){
     foreach($carts as $row){
      $product = Product::find($row->product_id); 
      $warranty_start = date('Y-m-d');
      $warranty_end = date('Y-m-d',strtotime('+'.$product->warranty_period.' month'));
      
      $order->order_id = $order_id;
      $order->item_id = $row->product_id;
      $order->item_name = $row->name;
      $order->item_sku = $row->sku;
      $order->item_qty = $row->quantity;
      $order->warranty_start = $warranty_start;
      $order->warranty_end = $warranty_end;
      $order->item_unit_price = $row->price;
      $order->item_net_price = $row->price * $row->quantity;
      $order->saveOrderDetail();
      $product->decrement('stock', $row->quantity);
      $product->update();
      updateCart($product->id);
      
     }
    }
    // NOW EMPTY CART
    if(Auth::check()){ Cart::where('user_id',user()->id)->delete(); }else{ Cart::where('session_id',$this->session_id)->delete(); } 
    
    Session::put('order_id',$order_id);
    if($sub_type=="GATEWAY"){
     if($req->payment_gateway == "Razorpay"){
      return redirect()->route('checkout.razorpay');    
     }else if($req->payment_gateway == "Payumony"){
      return redirect()->route('checkout.payu');     
     }    
     
    }
    $order->mail_subject = "Order placed from ".setting()->comp_name;
    $order->mail_msg = "Your order will soon be on it's way to you ! Thank You, you're awesome !";
    $order->sendMail();
    return redirect()->route('checkout.success'); 
  }

  public function requestRazorpay(){
    if(!Session::has('order_id')){
      return redirect()->route('home');
    }
    $order = Order::find(Session::get('order_id'));
    $amount = $order->net_amount * 100;

    $receiptid = Str::random(20);
    $api = new Api(config('app.razorpay')['key_id'], config('app.razorpay')['key_secret']);
    $razorpay_order  = $api->order->create([
            'receipt' => $receiptid,
            'amount' => $amount,
            'currency' => 'INR',
        ]);
    $razorpay_order_id = $razorpay_order['id']; 
    Order::where('id',$order->id)->update(['gateway_order_id'=>$razorpay_order_id]);  
    return view('payment.razorpay',compact('order','amount','razorpay_order_id'));
  }

  public function responseRazorpay(Request $request){
    $input = $request->all();
    $api = new Api(config('app.razorpay')['key_id'], config('app.razorpay')['key_secret']);
    //$payment = $api->payment->fetch($input['razorpay_payment_id']);
    if(count($input) && !empty($input['razorpay_payment_id'])) {
     try {
        //$response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount'])); 
         $razorpay_payment_id = $input['razorpay_payment_id'];
         $razorpay_order_id = $input['razorpay_order_id'];
         $razorpay_signature = $input['razorpay_signature'];
         $razorpay_secret = config('app.razorpay')['key_secret'];
         $calculated = hash_hmac("sha256",$razorpay_order_id."|".$razorpay_payment_id, $razorpay_secret);
         if($calculated == $razorpay_signature){
          $order = Order::find(Session::get('order_id'));
          $order->gateway_payment_id = $razorpay_payment_id;
          $order->payment_status = "PAID";
          $order->update();

          $order_mail = new OrderController(); 
          $order_mail->order_id = $order->id;  
          $order_mail->mail_subject = "Order paid from ".setting()->comp_name;
          $order_mail->mail_msg = "Your order has been paid ! Thank You, you're awesome !";
          $order_mail->sendMail();
         }
        } catch (Exception $e) {
          //return $e->getMessage();
          return redirect()->route('home');
         }
       }  
      return redirect()->route('checkout.success');
  }
  
  public function requestPayu(){
   if(!Session::has('order_id')){
    return redirect()->route('home');
   }
   $order = Order::find(Session::get('order_id'));
   
   $MERCHANT_KEY = config('app.payu')['key']; 
   $SALT = config('app.payu')['salt']; 

    $PAYU_BASE_URL = "https://secure.payu.in"; 
    $name = $order->name;
    $successURL = route('checkout.payu.proceed');
    $failURL = route('payu.cancel');
    $email = $order->email;
    $phone = $order->mobile;
    $amount = $order->net_amount;
    $productinfo = 'Website Order';

    $action = '';
    $txnid = $order->id;
    $posted = array();
    $posted = array(
        'key' => $MERCHANT_KEY,
        'txnid' => $txnid,
        'amount' => $amount,
        'firstname' => $name,
        'email' => $email,
        'productinfo' => $productinfo,
        'surl' => $successURL,
        'furl' => $failURL,
        'service_provider' => 'payu_paisa',
    );

    if(empty($posted['txnid'])) {
     $txnid = $order->id;
    }else{
     $txnid = $posted['txnid'];
    }

    $hash = '';
    $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    
    if(empty($posted['hash']) && sizeof($posted) > 0) {
      $hashVarsSeq = explode('|', $hashSequence);
      $hash_string = '';  
      foreach($hashVarsSeq as $hash_var) {
        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
        $hash_string .= '|';
      }
        $hash_string .= $SALT;

        $hash = strtolower(hash('sha512', $hash_string));
        $action = $PAYU_BASE_URL . '/_payment';
    } 
    elseif(!empty($posted['hash'])) {
      $hash = $posted['hash'];
      $action = $PAYU_BASE_URL . '/_payment';
    }

    return view('payment.pay-u',compact('action','hash','MERCHANT_KEY','txnid','successURL','failURL','name','email','phone','amount','productinfo'));   
  }
  
  public function responsePayu(Request $request){ 
   $paymentId = $request->encryptedPaymentId;      
   $status = $request->status;
   $firstname = $request->firstname;
   $amount = $request->amount;
   $txnid = $request->txnid;
   $posted_hash = $request->hash;
   $key = $request->key;
   $productinfo = $request->productinfo;
   $email = $request->email;
   $salt = config('app.payu')['salt'];

   if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
    }else {	  
      $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

     }
	  $hash = hash("sha512", $retHashSeq);
		 
      if ($hash != $posted_hash) {
	   echo "Invalid Transaction. Please try again";
	  }else {
	    
       $order = Order::find($txnid);
       $order->gateway_payment_id = $paymentId;
       $order->payment_status = "PAID";
       $order->update();

       $order_mail = new OrderController(); 
       $order_mail->order_id = $order->id;  
       $order_mail->mail_subject = "Order paid from ".setting()->comp_name;
       $order_mail->mail_msg = "Your order has been paid ! Thank You, you're awesome !";
       $order_mail->sendMail();
       return redirect()->route('checkout.success');
	 }
   
  }
  
  public function payuCancel(Request $request){ 
    $status = $request->status;
    $firstname = $request->firstname;
    $amount = $request->amount;
    $txnid = $request->txnid;
    
    $posted_hash = $request->hash;
    $key = $request->key;
    $productinfo = $request->productinfo;
    $email = $request->email;
    $salt = config('app.payu')['salt'];
    
    if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        
    }else {	  
    
     $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
    
     }
  	 $hash = hash("sha512", $retHashSeq);
    
     if ($hash != $posted_hash) {
      echo "Invalid Transaction. Please try again";
     }
     else {
      echo "<h3>Your order status is ". $status .".</h3>";
      echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";
      echo "<p><a href='".url(
          '/')."'> Try Again</a></p>";
          
     }    
  }
  

  public function success(){
    if(!Session::has('order_id')){
      return redirect()->route('home');
    }
    $order = Order::find(Session::get('order_id'));
    if(empty($order)){
     return redirect()->route('home');    
    }
    $order_detail = OrderDetail::where('order_id',$order->id)->get();
    $meta_title = setting()->comp_name." | Payment Confirmation";
    $meta_description = setting()->comp_name." | Payment Confirmation";
    $meta_keywords = setting()->comp_name." | Payment Confirmation";
    return view('payment.success',compact('meta_title','meta_description','meta_keywords','order','order_detail'));
  }
  
  public function razorpayWebhook(Request $req){
    Order::where('gateway_order_id',$req->order_id)
         ->update(['gateway_payment_id'=>$req->payment_id,
                   'payment_status'=>'PAID']);
                    
    $order = Order::where('gateway_order_id',$req->order_id)->first(); 
    if(empty($order->gateway_payment_id)){
     $order_mail = new OrderController(); 
     $order_mail->order_id = $order->id;  
     $order_mail->mail_subject = "Order paid from ".setting()->comp_name;
     $order_mail->mail_msg = "Your order has been paid ! Thank You, you're awesome !";
     $order_mail->sendMail();
    }
  }

}
