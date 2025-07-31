<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller{
   
    protected $file_path;
    protected $section_name;
    
    public function __construct(){
     $this->middleware('auth:admin');
     $this->section_name = "Gallery";
     $this->file_path = "uploaded_files/gallery"; 
    }

    public function index(){
     $data = Gallery::orderBy('order_by')->paginate(50);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.gallery',compact('data','i'));  
    }

    public function add(){   
     return view('admin.addedit-gallery');   
    }

    public function create(Request $req){
     $req->validate(['image'=>'required|image|mimes:jpeg,jpg,png,webp|max:150',
                     'name'=>'nullable|max:200']);
     $data = new Gallery();
     $data->name = $req->name;
     $data->status = $req->status;
     $image = "";
     if($req->hasFile('image')){
      $file = $req->file('image');
      $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path('/'.$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
     }
     $data->save();
     logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
     return back()->with('message','success|Created successfully.');
    }
    
    public function edit(Request $req){
     $edit = Gallery::find($req->id);
     return view('admin.addedit-gallery',compact('edit'));  
    }

    public function update(Request $req){
     $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                     'name'=>'nullable|max:200']);
     $data = Gallery::find($req->id);
     $data->name = $req->name;
     $data->status = $req->status;
     $image = $data->image;
     if($req->hasFile('image')){
      @unlink($this->file_path."/".$image);  
      $file = $req->file('image');
      $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path('/'.$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
     }
     $data->update();
     logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
     return back()->with('message','success|Updated successfully.');
    }

    public function updateStatus(Request $req){
     $status = $req->status;
     Gallery::where('id', $req->id)->update(['status' => $status]);
     return back()->with('message','success|Status changed.');
    }

    public function bottomAction(Request $req){
     $ids = $req->ids;
     $action = $req->req_for;
     if($action == "Delete"){  
     foreach($ids as $id) {
      $data = Gallery::find($id,['name','image']);
      @unlink($this->file_path."/".$data->image);
      logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
      $data->delete();   
     }   
    }else if($action == "Update Order"){
      $order_by_ids = $req->order_by_ids;
      $order_by = $req->order_by;
     for($i=0;$i<COUNT($order_by_ids);$i++){
       Gallery::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
     }
    }else if($action == "Active" || $action == "Inactive"){
     $status = ($action=="Active") ? 1 : 0;
     Gallery::whereIn('id',$ids)->update(['status'=>$status]);
    }
    return back()->with('message','success|Action completed.');
  }

}
