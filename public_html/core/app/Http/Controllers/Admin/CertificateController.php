<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CertificateController extends Controller{
 
 private $file_path;
 protected $section_name;
 
 public function __construct(){
  $this->section_name = "Certificate";     
  $this->file_path = "uploaded_files/certificate";     
  $this->middleware('auth:admin');     
 }
 
 public function index(){
  $data = Certificate::orderBy('order_by')->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.certificate.index', compact('data','i'));
 }
 
 public function add(){
  return view('admin.certificate.addedit');     
 }
 
 public function create(Request $req){
  $req->validate(['pdf'=>'required|mimes:pdf|max:6000', 
                  'name'=>'required|max:200'],
                 ['pdf.required'=>'Certificate is required',
                  'pdf.mimes'=>'The Certificate must be a file of type: pdf.']);
  if($req->hasFile('pdf')){
   $file = $req->file('pdf');
   $pdf = time().'.'.$file->getClientOriginalExtension();
   $path = public_path('/'.$this->file_path);
   if(is_dir($path) == false){mkdir($path);}
   $file->move($path, $pdf);
   $data = new Certificate();
   $data->pdf = $pdf;
   $data->name = $req->name;
   $data->slug = Str::slug($req->name);
   $data->issued_on = $req->issued_on;
   $data->save();
   logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
   return back()->with('message','success|Created successfully.');
  }
 }
 
 public function edit(Request $req){
  $edit = Certificate::find($req->id);
  return view('admin.certificate.addedit', compact('edit'));
 }
 
 public function update(Request $req){
  $req->validate(['pdf'=>'nullable|mimes:pdf|max:5000', 
                  'name'=>'required|max:200'],
                 ['pdf.required'=>'Certificate is required',
                  'pdf.mimes'=>'The Certificate must be a file of type: pdf.']);
  $data = Certificate::find($req->id);
  if($req->hasFile('pdf')){
   @unlink($this->file_path."/".$data->pdf);      
   $file = $req->file('pdf');
   $pdf = time().'.'.$file->getClientOriginalExtension();
   $path = public_path('/'.$this->file_path);
   if(is_dir($path) == false){mkdir($path);}
   $file->move($path, $pdf);
   $data->pdf = $pdf;
  }
  $data->name = $req->name;
  $data->slug = Str::slug($req->name);
  $data->issued_on = $req->issued_on;
  $data->update();
  logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
  return back()->with('message','success|Updated successfully.');
 } 
 
 public function updateStatus(Request $req){
  Certificate::where('id', $req->id)->update(['status'=>$req->status]);
  return back()->with('message','success|Status changed.');
 }
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   $data = Certificate::whereIn('id', $ids)->get();
   foreach($data as $row){
    @unlink($this->file_path."/".$row->pdf);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $row->name);
    $row->delete();
   }
  }else if(in_array($action, ['Active','Inactive'])){
   $status = ($action == "Active") ? 1 : 0;
   Certificate::whereIn('id', $ids)->update(['status'=>$status]);
  }else if($action == "Update Order"){
   $order_by_ids = $req->order_by_ids;
   $order_by = $req->order_by;
   for($i=0; $i < COUNT($order_by_ids); $i++){
    Certificate::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
   }
  }
  return back()->with('message','success|Action completed.'); 
 }
 

}
