<?php

namespace App\Http\Controllers\Admin;

use Excel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\IdentifyProduct;
use App\Http\Controllers\Controller;
use App\Exports\ExportIdentifyProduct;
use App\Imports\ImportIdentifyProduct;
use App\Models\IdentifyProductAttribute;

class IdentifyProductController extends Controller{
  
  protected $section_name;
  
  public function __construct(){
   $this->middleware('auth:admin');
   $this->section_name = "Product Warranty";
  }
  
  public function index(){
   $data = IdentifyProduct::latest()->paginate(50);
   $i = $data->perPage() * ($data->currentPage() - 1);
   return view('admin.identify-product',compact('data','i'));
  }
  
  public function add(){
   return view('admin.addedit-identify-product');      
  }
  
  public function create(Request $req){
   $req->validate(['product_name'=>'required', 'asin'=>'required', 
                   'serial_no'=>'required|max:255|unique:identify_products',
                   'quantity'=>'max:255']);  
   
   $data = new IdentifyProduct();
   $data->product_name = $req->product_name;
   $data->asin = $req->asin;
   $data->serial_no = $req->serial_no;
   $data->quantity = $req->quantity;
   $data->warranty_start_date = $req->warranty_start_date;
   $data->warranty_end_date = $req->warranty_end_date;
   $data->remark = $req->remark;
   $data->save();
   logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->serial_no);
   return back()->with('message','success|Created successfully.');
  }
  
  public function edit(Request $req){
   $edit = IdentifyProduct::find($req->id); 
   return view('admin.addedit-identify-product',compact('edit'));
  }
  
  public function update(Request $req){
   $req->validate(['product_name'=>'required', 'asin'=>'required', 
                'serial_no'=>'required|max:255|unique:identify_products,serial_no,'.$req->id, 'quantity'=>'max:255']);  
   
   $data = IdentifyProduct::find($req->id);
   $data->product_name = $req->product_name;
   $data->asin = $req->asin;
   $data->serial_no = $req->serial_no;
   $data->quantity = $req->quantity;
   $data->warranty_start_date = $req->warranty_start_date;
   $data->warranty_end_date = $req->warranty_end_date;
   $data->remark = $req->remark;
   $data->update();
   logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->serial_no);
   return back()->with('message','success|Updated successfully.');
  }
  
  public function bottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){
    foreach($ids as $id){
     $data = IdentifyProduct::find($id);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->serial_no);
     $data->delete();
    }   
   }
   return back()->with('message','success|Action completed.');
  }
  
  public function import(Request $req){
   $req->validate(['import'=>'required']); 
   $file = $req->file('import');
   $ext = $file->getClientOriginalExtension();
   if($ext == "csv"){
    Excel::import(new ImportIdentifyProduct(),request()->file('import'));
    return back()->with('message','success|Imported successfully.');
   }else{
    return back()->with('message','error|Please upload a csv file.');  
   }    
  }
  
  public function export(Request $req){
   $filename = "product-warranty-".time().".xlsx";
   return Excel::download(new ExportIdentifyProduct($req->ids), $filename);  
  }
  
  public function getProductData(Request $req){
   $data = Product::where('sku',$req->sku)->first();
   if(empty($data)){
    return response()->json(['success'=>false, 'message'=>'SKU code does not match with our records.'],200);   
   }
   $product = array('name'=>$data->name, 'asin'=>$data->asin);
   return response()->json(['success'=>true, 'data'=>$product],200);
  }

}
