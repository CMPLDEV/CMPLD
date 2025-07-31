<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CurlController;

 class ShippingController extends Controller{
   
   protected $token;
   protected $client_id;
   protected $client_secret;
   protected $login_id;
   protected $license_key;
   protected $base_url;
   public $pincode;
   
   protected $shipper_email;
   protected $shipper_password;
   protected $httpstatus;
   protected $result;
   
   public $origin;
   public $destination;
   public $payment_type;
   public $order_amount;
   public $weight;
   public $length;
   public $breadth;
   public $height;
   
   public $order_number;
   public $order_date;
   public $pickup_address;
   public $consignee_name;
   public $consignee_last_name;
   public $consignee_address;
   public $consignee_city;
   public $consignee_pincode;
   public $consignee_state;
   public $consignee_country;
   public $consignee_phone;
   public $consignee_email;
   public $order_items;
   public $courier_id;
   public $shipping_is_billing;
   public $shipping_charges;
   public $discount;
   public $shipment_id;
   public $cummulativePrice;
   public $ewaybill;
   
   public function __construct(){
    $this->client_id = config('app.bluedart')['client_id'];
    $this->client_secret = config('app.bluedart')['client_secret'];
    $this->login_id = config('app.bluedart')['login_id'];
    $this->license_key = config('app.bluedart')['license_key'];
    $this->base_url = config('app.bluedart')['base_url'];
    
    $this->shipper_email = config('app.shipway')['email'];
    $this->shipper_password = config('app.shipway')['password'];
   }
   
   public function authenticate(){
    $headers = array('Accept: application/json', 
                     'Content-type: application/json', 
                     'ClientID: '.$this->client_id,
                     'clientSecret: '.$this->client_secret); 
                     
    $curl = new CurlController();
    $curl->url = $this->base_url."token/v1/login";
    $curl->data = "";
    $curl->headers = $headers;
    return $curl->get();
   }
   
   public function checkPincodeAvailability(){
    $response = json_decode($this->authenticate(), true);  
    $result = json_decode($response['result'],true);
    $this->token = $result['JWTToken'];
    
    $data = array("pinCode"=>$this->pincode, "ProductCode"=>"A", "SubProductCode"=>"P", "PackType"=>"L", "Feature"=>"R", "profile"=>array("Api_type"=>"S", "LicenceKey"=>$this->license_key, "LoginID"=>$this->login_id));
    $headers = array('content-type: application/json', 
                     'JWTToken: '.$this->token);
              
    $curl = new CurlController();
    $curl->url = $this->base_url."finder/v1/GetServicesforPincodeAndProduct";
    $curl->data = $data;
    $curl->headers = $headers;  
    return $curl->post();
   }
   
 /* SHIPWAY INTEGRATION METHODS START */  
    
   public function authenticateShipway(){
    $this->token = base64_encode($this->shipper_email.":".$this->shipper_password);
   }   
   
   public function courierList(){
    $this->authenticateShipway();
    $data = "";
    $headers = array('Accept: application/json', 
                     'Content-type: application/json', 
                     'Authorization: Basic '.$this->token);
    $api = new CurlController();
    $api->url = "https://app.shipway.com/api/getshipwaycarrierrates?fromPincode=".$this->origin."&toPincode=".$this->destination."&paymentType=".$this->payment_type."&Length=".$this->length."&Breadth=".$this->breadth."&Height=".$this->height."&Weight=".$this->weight."&cummulativePrice=".$this->cummulativePrice;
    $api->data = $data;
    $api->headers = $headers;
    return $api->get();
   }

   public function createShipment(){
    $this->authenticateShipway();
    $data = array(
            'order_id' => $this->order_number,
            'ewaybill' => $this->ewaybill,
            'products' => $this->order_items,
            'discount' => $this->discount,
            'shipping' => $this->shipping_charges,
            'order_total' => $this->order_amount,
            'payment_type' => $this->payment_type,
            'email' => $this->consignee_email,
            'billing_address' => $this->consignee_address,
            'billing_city' => $this->consignee_city,
            'billing_state' => $this->consignee_state,
            'billing_country' => $this->consignee_country,
            'billing_firstname' => $this->consignee_name,
            'billing_lastname' => $this->consignee_last_name,
            'billing_phone' => $this->consignee_phone,
            'billing_zipcode' => $this->consignee_pincode,
            'shipping_address' => $this->consignee_address,
            'shipping_city' => $this->consignee_city,
            'shipping_state' => $this->consignee_state,
            'shipping_firstname' => $this->consignee_name,
            'shipping_lastname' => $this->consignee_last_name,
            'shipping_phone' => $this->consignee_phone,
            'shipping_zipcode' => $this->consignee_pincode,
            'shipping_country' => $this->consignee_country,
            'order_weight' => $this->weight,
            'box_length' => $this->length,
            'box_breadth' => $this->breadth,
            'box_height' => $this->height,
            'order_date' => $this->order_date,
           );
     $headers = array('Accept: application/json', 
                     'Content-type: application/json', 
                     'Authorization: Basic '.$this->token);
     $api = new CurlController();
     $api->url = "https://app.shipway.com/api/v2orders";
     $api->data = $data;
     $api->headers = $headers;
     return $api->post(); 
    }
    
}