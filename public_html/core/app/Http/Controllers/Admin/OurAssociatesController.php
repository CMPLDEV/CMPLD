<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OurAssociates;
use App\Http\Controllers\Controller;

class OurAssociatesController extends Controller{
 
 protected $file_path;
 protected $section_name;
 
 public function __construct(){
  $this->middleware('auth:admin');
  $this->section_name = "Our Associates";
  $this->file_path = "uploaded_files/our_associates";
 }
 
 public function index(){
  $data = OurAssociates::latest()->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.our_associates.index', compact('data','i'));
 }
 
 public function add(){
  return view('admin.our_associates.addedit');     
 }
 
 public function create(Request $req){ 
  $req->validate(['image'=>'required|image|mimes:jpeg,jpg,png,webp|max:150',
                  'title'=>'nullable|max:200']);
  $data = new OurAssociates();
  $data->title = $req->title;
  $data->status = $req->status;
  $file = $req->file('image');
  $image = time().'.'.$file->getClientOriginalExtension();
  $path = public_path('/'.$this->file_path);
  if(is_dir($path) == false){mkdir($path);}
  $file->move($path,$image);
  $data->image = $image;
  $data->save();
  logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->title);
  return back()->with('message','success|Created successfully.');
 }
 
 public function edit(Request $req){
  $edit = OurAssociates::find($req->id);
  return view('admin.our_associates.addedit', compact('edit'));
 }
 
 public function update(Request $req){
  $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                  'title'=>'nullable|max:200']);
  $data = OurAssociates::find($req->id);
  $data->title = $req->title;
  $data->status = $req->status;
  if($req->hasFile('image')){
   @unlink($this->file_path.'/'.$data->image);      
   $file = $req->file('image');
   $image = time().'.'.$file->getClientOriginalExtension();
   $path = public_path('/'.$this->file_path);
   if(is_dir($path) == false){mkdir($path);}
   $file->move($path,$image);
   $data->image = $image;
  }
  $data->update();
  logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->title);
  return back()->with('message','success|Updated successfully.');   
 }
 
 public function bottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   $data = OurAssociates::whereIn('id', $ids)->get();
   foreach($data as $row){
    @unlink($this->file_path.'/'.$row->image);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $row->title);
    OurAssociates::where('id',$row->id)->delete();
   }
  }else if(in_array($action, ['Active','Inactive'])){
   $status = ($action == "Active") ? 1 : 0;
   OurAssociates::whereIn('id', $ids)->update(['status'=>$status]);
  }
  return back()->with('message','success|Action completed.');
 }
     
}