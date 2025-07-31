<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller{

 protected $section_name;
 
 public function __construct(){
  $this->section_name = "FAQ";     
  $this->middleware('auth:admin');     
 }    
 
 public function index(){
  $data = Faq::orderBy('order_by')->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.faq.index', compact('data','i'));
 }
 
 public function add(){
  return view('admin.faq.addedit');     
 }
 
 public function create(Request $req){
  $req->validate(['question'=>'required|max:200', 'answer'=>'required']);
  $data = new Faq();
  $data->question = $req->question;
  $data->answer = $req->answer;
  $data->status = $req->status;
  $data->save();
  logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->question);
  return back()->with('message','success|Created successfully.');
 }
 
 public function edit(Request $req){
  $edit = Faq::find($req->id);
  return view('admin.faq.addedit', compact('edit'));
 }
 
 public function update(Request $req){
  $req->validate(['question'=>'required|max:200', 'answer'=>'required']);
  $data = Faq::find($req->id);
  $data->question = $req->question;
  $data->answer = $req->answer;
  $data->status = $req->status;
  $data->update();
  logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->question);
  return back()->with('message','success|Updated successfully.');
 }
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   foreach($ids as $id){
    $data = Faq::find($id);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->question);
    $data->delete();
   }      
  }else if($action == "Update Order"){
   $order_by_ids = $req->order_by_ids;
   $order_by = $req->order_by;
   for($i=0; $i < COUNT($order_by_ids); $i++){
    Faq::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
   }
  }else if(in_array($action, ['Active','Inactive'])){
   $status = ($action == "Active") ? 1 : 0;
   Faq::whereIn('id', $ids)->update(['status'=>$status]);
  }
  return back()->with('message','success|Action completed.');
 }
 
 public function updateStatus(Request $req){
  Faq::where('id', $req->id)->update(['status'=>$req->status]);  
  return back()->with('message','success|Updated successfully.');
 }
    
}
