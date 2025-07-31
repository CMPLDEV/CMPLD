<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductNegotiation;
use App\Http\Controllers\Controller;

class ProductNegotiationController extends Controller{

 public $email;
 public $mobile;
 public $product_found_on;
 public $price;
 public $product_id;
 
 protected $section_name;
 
 public function __construct(){
  $this->section_name = "Product Negotiation";     
  $this->middleware('auth:admin')->except(['create']);     
 }
 
 public function index(){
  $data = ProductNegotiation::join('products','products.id','=','product_negotiations.product_id')->latest()
     ->select('product_negotiations.*','products.name')->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.product-negotiation', compact('data','i'));
 }
 
 public function create(){
  $data = new ProductNegotiation();
  $data->product_id = $this->product_id;
  $data->email = $this->email;
  $data->mobile = $this->mobile;
  $data->product_found_on = $this->product_found_on;
  $data->price = $this->price;
  $data->save();
 }
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   foreach($ids as $id){
    $data = ProductNegotiation::find($id);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->email);
    $data->delete();
   }      
  }
  return back()->with('message','success|Action completed.');
 }

}
