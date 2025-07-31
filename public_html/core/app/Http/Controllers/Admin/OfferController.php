<?php

namespace App\Http\Controllers\Admin;

use App\Models\Offer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfferController extends Controller{
 
 protected $file_path;
 protected $section_name;
 
 public function __construct(){
  $this->middleware('auth:admin'); 
  $this->section_name = "Offer";
  $this->file_path = "uploaded_files/offer";
 }
 
 public function index(){
  $data = Offer::orderBy('order_by')->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.offer', compact('data','i'));
 }
 
 public function add(){
  return view('admin.addedit-offer');     
 }
 
 public function create(Request $req){
  $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:800',
                  'name'=>'required|max:200', 'link'=>'required|url']);  
  $data = new Offer();
  $data->name = $req->name;
  $data->status = $req->status;
  $data->link = $req->link;
  if($req->hasFile('image')){
   $file = $req->file('image');
   $image = time().'.'.$file->getClientOriginalExtension();
   $path = public_path('/'.$this->file_path);
   if(is_dir($path) == false){mkdir($path);}
   $data->image = $image;
   $file->move($path, $image);
  }
  $data->save();
  logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
  return back()->with('message','success|Created successfully.');
 }
 
 public function edit(Request $req){
  $edit = Offer::find($req->id);
  return view('admin.addedit-offer', compact('edit'));
 }
 
 public function update(Request $req){
  $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp,gif|max:800',
                  'name'=>'required|max:200', 'link'=>'required|url']);  
  $data = Offer::find($req->id);
  $data->name = $req->name;
  $data->status = $req->status;
  $data->link = $req->link;
  if($req->hasFile('image')){
   @unlink($this->file_path."/".$data->image);      
   $file = $req->file('image');
   $image = time().'.'.$file->getClientOriginalExtension();
   $path = public_path('/'.$this->file_path);
   if(is_dir($path) == false){mkdir($path);}
   $data->image = $image;
   $file->move($path, $image);
  }
  $data->update();
  logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
  return back()->with('message','success|Created successfully.');
 }
 
 public function updateStatus(Request $req){
  Offer::where('id',$req->id)->update(['status'=>$req->status]);
  return back()->with('message','success|Status changed.');
 }
 
  public function bottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){  
    foreach($ids as $id) {
     $data = Offer::find($id,['name','image']);
     @unlink($this->file_path."/".$data->image);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
     Offer::where('id',$id)->delete();   
    }   
   }else if($action == "Update Order"){
    $order_by_ids = $req->order_by_ids;
    $order_by = $req->order_by;
    for($i=0;$i<COUNT($order_by_ids);$i++){
     Offer::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
     }
    }else if(in_array($action, ['Active','Inactive'])){
     $status = ($action=="Active") ? 1 : 0;
     Offer::whereIn('id',$ids)->update(['status'=>$status]);
    }
    return back()->with('message','success|Action completed.');
  }
     
}
