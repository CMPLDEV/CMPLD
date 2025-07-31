<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller{
  
  protected $file_path;
  protected $section_name;
  
  public function __construct(){
   $this->section_name = "Slider";
   $this->middleware('auth:admin');
   $this->file_path = "uploaded_files/slider"; 
  }

  public function index(){
   $data = Slider::orderBy('order_by')->get();
   $i = 1;
   return view('admin.slider',compact('data','i'));
  }

  public function updateStatus(Request $req){
   Slider::where('id', $req->id)->update(['status' => $req->status]);
   return back()->with('message','success|Status changed.');
  }

  public function add(Request $req){
   $id=0;
   if(!empty($req->id)){
    $id = $req->id;
    $edit = Slider::findOrFail($req->id);
    return view('admin.modal.slider.addedit-slider',compact('edit','id'));
   }
   return view('admin.modal.slider.addedit-slider',compact('id'));  
  }

  public function create(Request $req){
   $validator = Validator::make($req->all(), ['image' => ['required', 'image', 'mimes:jpeg,jpg,png,webp', 'max:1000'],'link' => ['nullable', 'url'] ]);
    
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
      
   $data = new Slider();
   $data->title = $req->title;
   $data->link = $req->link;
   $data->description = $req->description;
    
    $image = "";
    if($req->hasFile('image')){
      $file = $req->file('image');
      $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
    }
   $data->save(); 
   logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->title);        
   return response()->json(['success'=>"Created successfully"],200);
  }

  public function update(Request $req){
   $validator = Validator::make($req->all(), [
     'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:1000'],
     'link' => ['nullable', 'url'] ]);
    
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
        
    $data = Slider::findOrFail($req->id);
    $data->title = $req->title;
    $data->link = $req->link;
    $data->description = $req->description;
    
    $image = $data->image;
    if($req->hasFile('image')){
      @unlink($this->file_path."/".$image);
      $file = $req->file('image');
      $image = time().".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
    }
    $data->update(); 
    logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->title);  
    return response()->json(['success'=>"Updated successfully"],200);
  }

  public function removeImage(Request $req){
   $column = $req->column;
   $data = Slider::findOrFail($req->id);
   @unlink($this->file_path."/".$data->$column);
   $data->$column = "";
   $data->update();
   return back()->with('message','success|File removed.');
  }

  public function delete(Request $request){
   $data = Slider::findOrFail($request->id);
   @unlink($this->file_path."/".$data->image);
   logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->title);  
   $data->delete();    
   return back()->with('message','success|Deleted successfully.');
  }

  public function bottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){  
    foreach($ids as $id) {
     $data = Slider::find($id,['title','image']);
     @unlink($this->file_path."/".$data->image);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->title);  
     Slider::where('id',$id)->delete();   
    }   
   }else if($action == "Update Order"){
    $order_by_ids = $req->order_by_ids;
    $order_by = $req->order_by;
     for($i=0;$i<COUNT($order_by_ids);$i++){
       Slider::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
     }
    }else if($action == "Active" || $action == "Inactive"){
     $status = ($action=="Active") ? 1 : 0;
     Slider::whereIn('id',$ids)->update(['status'=>$status]);
    }
    return back()->with('message','success|Action completed.');
  }

}
