<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Marketplace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MarketplaceController extends Controller{
   
   protected $section_name;
   
   public function __construct(){
    $this->middleware('auth:admin');
    $this->section_name = "Marketplace";
   }

   public function index(){
    $data = Marketplace::where('parent_id',0)->get();
    $i = 1;
    return view('admin.marketplace',compact('data','i'));
   }

   public function updateStatus(Request $req){
    $status = $req->status;
    Marketplace::where('id', $req->id)->update(['status' => $status]);
    return back()->with('message','success|Status changed.');
   }

   public function add(Request $req){
    $id=0;
    if(!empty($req->id)){
     $id = $req->id;
     $edit = Marketplace::findOrFail($req->id);
     return view('admin.modal.marketplace.addedit-marketplace',compact('edit','id'));
    }
    return view('admin.modal.marketplace.addedit-marketplace',compact('id'));  
   }

   public function create(Request $req){
    $validator = Validator::make($req->all(), [
        'parent_id' => ['required'],
        'name' => ['required', 'string', 'max:255','unique:marketplaces,name'],
      ],['parent_id.required' => 'please choose category']);
    
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
      
    $data = new Marketplace();
    $data->parent_id = $req->parent_id;
    $data->name = $req->name;
    $data->slug = Str::slug($req->name);
    $data->save(); 
    logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Created successfully"],200);
   }

   public function update(Request $req){
    $validator = Validator::make($req->all(), [
       'parent_id' => ['required'],
       'name' => ['required', 'string', 'max:255', 'unique:marketplaces,name,'.$req->id],
    ],['parent_id.required' => 'please choose category']);
    
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
        
    $data = Marketplace::findOrFail($req->id);
    $data->parent_id = $req->parent_id;
    $data->name = $req->name;
    $data->slug = Str::slug($req->name);
    $data->update(); 
    logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Updated successfully"],200);
   }

   public function delete(Request $request){
    $data = Marketplace::findOrFail($request->id);
    Marketplace::where('parent_id',$data->id)->update(['parent_id'=>0]);
    logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
    $data->delete();    
    return back()->with('message','success|Deleted successfully.');
   }

}
