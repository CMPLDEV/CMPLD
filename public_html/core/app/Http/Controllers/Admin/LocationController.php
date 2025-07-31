<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller{
 
  protected $del_ids;
  protected $section_name;
 
  public function __construct(){
   $this->del_ids = array();
   $this->middleware('auth:admin');
   $this->section_name = "Location";
  }
 
/* ####################### STATES METHODS START ########################### */  
  
  public function states(){
   $data = Location::where('parent_id',0)->orderBy('name')->paginate(150);
   $i =  $data->perPage() * ($data->currentPage() - 1);
   return view('admin.location.state',compact('data','i'));
  }
  
  public function addState(Request $req){
   $id=0;
   if(!empty($req->id)){
    $id = $req->id;
    $edit = Location::find($req->id);
    return view('admin.modal.location.addedit-state',compact('edit','id'));
   }
   return view('admin.modal.location.addedit-state',compact('id'));  
  }
  
  public function createState(Request $req){
   $validator = Validator::make($req->all(), [
      'name' => ['required', 'string', 'max:255','unique:locations,name']]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    $data = new Location();
    $data->name = $req->name;
    $data->save(); 
    logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Created successfully"],200);
   }
   
   public function updateState(Request $req){
    $validator = Validator::make($req->all(), [
      'name' => ['required', 'string', 'max:255','unique:locations,name,'.$req->id]]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    $data = Location::find($req->id);
    $data->name = $req->name;
    $data->update(); 
    logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Updated successfully"],200);
   }
   
   public function bottomActionState(Request $req){
    $ids = $req->ids;
    $action = $req->req_for;
    if($action == "Delete"){
     foreach($ids as $id){
      $this->getChilds($id);
      $this->deleteChilds();
      $data = Location::find($id);
      logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
      $data->delete();
     } 
    }
    return back()->with('message','success|Action completed.');
   }
   
   public function searchState(Request $req){
    $req->validate(['search_keyword'=>'required']);
    $search_keyword = $req->search_keyword;
    $data = Location::where('name','LIKE','%'.$search_keyword.'%')
                    ->where('parent_id',0)->latest()->paginate(150);
    $i =  $data->perPage() * ($data->currentPage() - 1);
    return view('admin.location.state',compact('data','i','search_keyword'));
   }
 
/* ####################### STATES METHODS END ########################### */   
  
/* ###################### DISTRICTS METHODS START ########################## */

  public function districts(Request $req){
   $state = Location::find($req->state_id); 
   $data = Location::where('parent_id',$state->id)->orderBy('pincode')
                                                  ->paginate(150);
   $i = $data->perPage() * ($data->currentPage() - 1);
   return view('admin.location.district',compact('data','i','state'));
  }
  
  public function addDistrict(Request $req){
   $id=0;
   $state_id = $req->state_id;
   if(!empty($req->id)){
    $id = $req->id;
    $edit = Location::find($req->id);
    return view('admin.modal.location.addedit-district',compact('edit','id','state_id'));
   }
   return view('admin.modal.location.addedit-district',compact('id','state_id'));   
  }
  
  public function createDistrict(Request $req){
   $validator = Validator::make($req->all(), [
      'pincode' => ['required', 'digits:6','unique:locations,pincode']]);
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
   $data = new Location();
   $data->pincode = $req->pincode;
   $data->parent_id = $req->state_id;
   $data->save(); 
   return response()->json(['success'=>"Created successfully"],200);      
  }
  
  public function updateDistrict(Request $req){
   $validator = Validator::make($req->all(), [
      'pincode' => ['required', 'digits:6','unique:locations,pincode,'.$req->id]]);
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
   $data = Location::find($req->id);
   $data->pincode = $req->pincode;
   $data->parent_id = $req->state_id;
   $data->update(); 
   return response()->json(['success'=>"Updated successfully"],200);      
  }
  
  public function searchDistrict(Request $req){
   $req->validate(['search_keyword'=>'required']);
   $search_keyword = $req->search_keyword;      
   $state = Location::find($req->state_id); 
   $data = Location::where('pincode','LIKE','%'.$search_keyword.'%')
                   ->where('parent_id',$state->id)->paginate(150);
   $i = $data->perPage() * ($data->currentPage() - 1);
   return view('admin.location.district',compact('data','i','state','search_keyword'));   
  }
  
  public function bottomActionDistrict(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){
    Location::whereIn('id',$ids)->delete();   
   }else if(in_array($action,['Active','Inactive'])){
    $status = ($action == "Active") ? 1 : 0;
    Location::whereIn('id',$ids)->update(['status'=>$status]);
   }
   return back()->with('message','success|Action completed.');
  }
  
/* ###################### DISTRICTS METHODS END ########################## */  


  public function getChilds($id){
   $data = Location::where('parent_id',$id)->get(); 
   if($data->isNotEmpty()){
   foreach($data as $row){
    $this->del_ids[] = $row->id;   
    $this->getChilds($row->id);
   }}
  }
  
  public function deleteChilds(){
   if(COUNT($this->del_ids)){
    Location::whereIn('id',$this->del_ids)->delete();   
   }      
  }

}
