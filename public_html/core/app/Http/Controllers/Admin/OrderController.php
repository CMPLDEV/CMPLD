<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Excel;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Exports\ExportOrder;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Admin\ShippingController;

class OrderController extends Controller{

   public $gateway_order_id;
   public $gateway_payment_id;
   public $amount;
   public $net_amount;
   public $type;
   public $sub_type;
   public $payment_status;
   public $delivery_status;
   public $coupon;
   public $discount;
   public $user_id;
   public $name;
   public $email;
   public $mobile;
   public $pincode;
   public $country;
   public $state;
   public $city;
   public $gst_no;
   public $company_name;
   public $address;
   
   public $shipping_name;
   public $shipping_email;
   public $shipping_mobile;
   public $shipping_pincode;
   public $shipping_country;
   public $shipping_state;
   public $shipping_city;
   public $shipping_address;

   public $order_id;
   public $item_id;
   public $item_name;
   public $item_sku;
   public $item_qty;
   public $warranty_start;
   public $warranty_end;
   public $item_unit_price;
   public $item_net_price;

   public $mail_msg;
   public $mail_subject;
   
   protected $section_name;
   
   public function __construct(){
    $this->section_name = "Order";   
    $this->middleware('auth:admin')->except('saveOrder','saveOrderDetail');
   } 

   public function saveOrder(){
    $data = new Order();
    $data->amount = $this->amount;
    $data->net_amount = $this->net_amount;
    $data->type = $this->type;
    $data->sub_type = $this->sub_type;
    $data->payment_status = $this->payment_status;
    $data->delivery_status = $this->delivery_status;
    $data->gateway_payment_id = $this->gateway_payment_id;
    $data->coupon = $this->coupon;
    $data->discount = $this->discount;
    $data->user_id = $this->user_id;
    $data->name = $this->name;
    $data->email = $this->email;
    $data->mobile = $this->mobile;
    $data->gst_no = $this->gst_no;
    $data->pincode = $this->pincode;
    $data->country = $this->country;
    $data->state = $this->state;
    $data->city = $this->city;
    $data->address = $this->address;
    $data->company_name = $this->company_name;
    $data->shipping_name = $this->shipping_name;
    $data->shipping_email = $this->shipping_email;
    $data->shipping_mobile = $this->shipping_mobile;
    $data->shipping_pincode = $this->shipping_pincode;
    $data->shipping_country = $this->shipping_country;
    $data->shipping_state = $this->shipping_state;
    $data->shipping_city = $this->shipping_city;
    $data->shipping_address = $this->shipping_address;
    $data->save();
    return $data->id;
   }

    public function saveOrderDetail(){
     $detail = new OrderDetail();
     $detail->order_id = $this->order_id;
     $detail->item_id = $this->item_id;
     $detail->item_name = $this->item_name;
     $detail->item_sku = $this->item_sku;
     $detail->item_qty = $this->item_qty;
     $detail->warranty_start = $this->warranty_start;
     $detail->warranty_end = $this->warranty_end;
     $detail->item_unit_price = $this->item_unit_price;
     $detail->item_net_price = $this->item_net_price;
     $detail->save();
    }

   public function sendMail(){
    $order = Order::find($this->order_id);
    $order_detail = OrderDetail::where('order_id',$order->id)->get();
    $data = array('order'=>$order,'order_detail'=>$order_detail,'content'=>$this->mail_msg);
   
   //SEND TO USER 
    $mail = new MailController();
    $mail->template = "email.order";
    $mail->receiver_email = $order->email;
    $mail->receiver_name = $order->name;
    $mail->subject = $this->mail_subject;
    $mail->data = $data;
    $mail->send();

   //SEND TO ADMIN 
    $mail = new MailController();
    $mail->template = "email.order";
    $mail->receiver_email = setting()->email;
    $mail->receiver_name = setting()->comp_name;
    $mail->subject = $this->mail_subject;
    $mail->data = $data;
    $mail->send();
  }

   public function index(){
    $data = Order::latest()->paginate(setting()->order_per_page);
    $i = $data->perPage() * ($data->currentPage() - 1);
    $order_sum = orderSum();
    return view('admin.order',compact('data','i','order_sum'));   
   }

   public function orderDetail(Request $req){
    $i=1;
    $order = Order::find($req->id);
    $order_detail = OrderDetail::where('order_id',$order->id)->get();
    return view('admin.order-detail',compact('order','order_detail','i'));
   }

   public function generateInvoice(Request $req){
    $data = new Invoice();
    $data->invoice_no = generateInvoiceNo();
    $data->order_id = $req->id;
    $data->save();
    return back()->with('message','success|Invoice generated.');
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

   public function removeInvoice(Request $req){
    $invoice = Invoice::where('order_id',$req->id)->delete();
    return back()->with('message','success|Invoice removed.');
   }

   public function bottomAction(Request $req){
    $ids = $req->ids;
    $return_applicable_date = "";
    $action = $req->req_for;
    if($action == "Delete"){
     foreach($ids as $id){
      logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $id);
      Order::where('id', $id)->delete();
     }    
    }else if($action == "PAID" || $action == "UNPAID"){
     foreach($ids as $id){
      $data = Order::find($id);
      $data->payment_status = $action;
      $data->update();
      logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $id." - ".$action);
     }   
    }else{
      $msg = "We are inform you that your order with ".setting()->comp_name." has been successfully ".strtoupper($action);
      foreach($ids as $id){
        // UPDATE DELIVERY STATUS
        Order::where('id',$id)->update(['delivery_status'=>$action]);
      
       if($action == "DELIVERED"){
        $return_applicable_date = date('Y-m-d',strtotime('+7 days'));
        Order::where('id',$id)
             ->update(['return_applicable_date'=>$return_applicable_date]);
       }
       logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $id." - ".$action);
        // SEND MAIL
        $this->order_id = $id;
        $this->mail_subject = "Order ".$action." from ".setting()->comp_name;
        $this->mail_msg = $msg;
        $this->sendMail();
      }
    }
    return back()->with('message','success|Action completed.');
   }

   public function cancelNoteSubmit(Request $req){
    $order = Order::find($req->order_id);
    $order->delivery_status = "CANCELLED";
    $order->cancel_note = $req->cancel_note;
    $order->cancelled_by = "ADMIN";
    $order->update();
    // SEND MAIL
    $this->order_id = $order->id;
    $this->mail_subject = "Order CANCELLED from ".setting()->comp_name;
    $this->mail_msg = "We are inform you that your order with ".setting()->comp_name." has been successfully CANCELLED";
    $this->sendMail();
    return true;
   }

   public function search(Request $req){
    $search_keyword = $req->search_keyword;
    $type = $req->type;
    $status = $req->status;
    $from = $req->from;
    $to = $req->to;
    
    $data = Order::latest();
    if(!empty($search_keyword)){
     if(strpos($search_keyword,'#') !== false){
      $data->where('id',str_replace('#','',$search_keyword));
     }else{ 
      $data->where(function($q) use($search_keyword){
        $q->where('name','LIKE','%'.$search_keyword.'%')
          ->orWhere('email','LIKE','%'.$search_keyword.'%')
          ->orWhere('mobile','LIKE','%'.$search_keyword.'%');
      });
     }
    }
    if(!empty($from) && !empty($to)){
      $data->whereRaw('DATE(created_at) >= '."'$from'")
           ->whereRaw('DATE(created_at) <= '."'$to'");
    }
    if(!empty($type)){
      $data->where('type',$type);
    }
    if(!empty($status)){
      if(in_array($status,['PAID','UNPAID'])){
        $data->where('payment_status',$status);
      }else{
        $data->where('delivery_status',$status);
      }
    }

    $data = $data->paginate(setting()->order_per_page);
    $i = $data->perPage() * ($data->currentPage() - 1);
    $order_sum = orderSum($search_keyword,$type,$status,$from,$to);
    return view('admin.order',compact('data','i','search_keyword','from','to','type','status','order_sum'));
   }
  
  public function dimension(Request $req){
    $order = Order::find($req->order_id);
    $order_detail = OrderDetail::join('products','products.id','=','order_details.item_id')
                          ->select('order_details.item_qty')
                          ->where('order_details.order_id',$order->id)->get();
    $origin = setting()->pincode;
    $destination = $order->pincode;
    $payment_type = ($order->type=="COD") ? "cod" : "prepaid";
    $order_amount = $order->net_amount;
    $weight = 1;
    $length = 0.5;
    $breadth = 0.5;
    $height = 0.5;
    foreach($order_detail as $row){
     $weight += $row->weight * $row->item_qty;
    }
     
   return view('admin.modal.shipping.dimension',compact('order','origin','destination','payment_type','order_amount','weight','length','breadth','height'));
  }
  
  public function courierPartners(Request $req){
    $order_id = $req->order_id; 
    $payment_mode = $req->payment_mode;
    $pickup_postcode = $req->pickup_postcode;
    $delivery_postcode = $req->delivery_postcode;
    $order_amount = $req->order_amount;
    $cummulativePrice = ($payment_mode == "COD") ? $order_amount : 0;
    $weight = $req->weight;
    $length = $req->length;
    $breadth = $req->breadth;
    $height = $req->height;
    
    $courier = new ShippingController();
    $courier->origin = $pickup_postcode;
    $courier->destination = $delivery_postcode;
    $courier->payment_type = $payment_mode;
    $courier->order_amount = ceil($order_amount);
    $courier->cummulativePrice = $cummulativePrice;
    $courier->weight = kg($req->weight);
    $courier->length = $length;
    $courier->breadth = $breadth;
    $courier->height = $height;
    $response = json_decode($courier->courierList(),true);
    $httpstatus = $response['status'];
    if($httpstatus != 200){
     echo $response[0];
     exit;
    }
    
    $result = json_decode($response['result'],true);
    $key = array_column($result['rate_card'],'delivery_charge');
    array_multisort($key, SORT_ASC, $result['rate_card']);
     
    return view('admin.modal.shipping.shipment',compact('result','order_id','weight','length','length','breadth','height'));     
  }

  public function createShipment(Request $req){
   $weight = $req->weight;
   $length = $req->length;
   $breadth = $req->breadth;
   $height = $req->height;
   $ewaybill = $req->ewaybill;

   if(empty($weight)){
    return back()->with('message','error|Please provide weight.');   
   }if(empty($length)){
    return back()->with('message','error|Please provide length.');   
   }if(empty($breadth)){
    return back()->with('message','error|Please provide breadth.');   
   }if(empty($height)){
    return back()->with('message','error|Please provide height.');   
   }

   $order = Order::find($req->order_id);
   if(empty($order)){
    return back()->with('message','error|Something went wrong.');    
   }
   //GET ITEMS  
   $order_items = OrderDetail::where('order_id',$order->id)->get();
   foreach($order_items as $data){
    $items[] = array('product' => $data->item_name, 'price' => $data->item_unit_price, 'product_code' => $data->item_sku, 'amount' => $data->item_qty, 'discount' => "0", 'tax_rate' => "0", "tax_title" => ""); 
   }

   $order_id = $order->id;
   $order_date = $order->created_at;
    
   $billing_customer_name = $order->name;
   $billing_last_name = "";
   $billing_address = $order->address;
   $billing_city = $order->city;
   $billing_pincode = $order->pincode;
   $billing_state = $order->state;
   $billing_country = $order->country;
   $billing_phone = $order->mobile;
   $billing_email = $order->email;
   $shipping_is_billing = 1;
   $payment_method = ($order->type=="COD") ? "C" : "P";
   $sub_total = $order->net_amount;
   $total_discount = $order->discount;
   
  //CREATE SHIPMENT
   $shipment = new ShippingController();
   $shipment->order_number = $order->id;
   $shipment->order_date = $order_date;
   $shipment->consignee_name = $billing_customer_name;
   $shipment->consignee_last_name = $billing_last_name;
   $shipment->consignee_address = $billing_address;
   $shipment->consignee_city = $billing_city;
   $shipment->consignee_pincode = $billing_pincode;
   $shipment->consignee_state = state($billing_state);
   $shipment->consignee_country = country($billing_country);
   $shipment->consignee_phone = $billing_phone;
   $shipment->consignee_email = $billing_email;
   $shipment->order_items = $items;
   $shipment->weight = $weight;
   $shipment->length = $length;
   $shipment->breadth = $breadth;
   $shipment->height = $height;
   $shipment->ewaybill = $ewaybill;
   $shipment->payment_type = $payment_method;
   $shipment->order_amount = $sub_total;
   $shipment->shipping_charges = $order->shipping_charges;
   $shipment->discount = round($total_discount);
   $response = json_decode($shipment->createShipment(),true);
  
   $httpstatus = $response['status'];
   $result = json_decode($response['result'],true);
   if($httpstatus != 201){
    print_r($result['message']);
    exit;
   }
   
   //UPDATE ORDER IF ORDER CREATED IN SHIPWAY
   $this->updateShippingInfo($order->id);
   return back()->with('message','success|'.$result['message']);    
  }
  
  public function updateShippingInfo($order_id){
   Order::where('id',$order_id)->update(['is_shipway'=>1]);      
  }
  
  public function updateTrackingForm(Request $req){
   $order = Order::find($req->order_id);
   return view('admin.modal.shipping.update-tracking',compact('order'));
  }

  public function updateTracking(Request $req){
   $order = Order::find($req->order_id); 
   $order->tracking_no = $req->tracking_no;
   $order->tracking_link = $req->tracking_link;
   $order->update();
   return back()->with('message','success|Updated successfully.');
  }
  
  public function export(Request $req){
   $filename = "order-export.xlsx";
   return Excel::download(new ExportOrder(json_decode($req->ids, true)), $filename);
  }

}
