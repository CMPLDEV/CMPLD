<?php

namespace App\Http\Controllers\Admin;

use Hash;
use Excel;
use App\Models\User;
use App\Imports\ImportUser;
use App\Exports\ExportUser;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller{
  
  protected $section_name;
  
  public function __construct(){
   $this->middleware('auth:admin');
   $this->section_name = "User";
  }

  public function index(){
   $data = User::latest()->paginate(setting()->user_per_page);
   $i = $data->perPage() * ( $data->currentPage() - 1);
   return view('admin.user',compact('data','i'));
  }

  public function updateStatus(Request $req){
   User::where('id', $req->id)->update(['status' => $req->status]);
   return back()->with('message','success|Status changed.');
  }

  public function add(Request $req){
   $id=0;
   if(!empty($req->id)){
    $id = $req->id;
    $edit = User::findOrFail($req->id);
    return view('admin.modal.user.addedit-user',compact('edit','id'));
   }
   return view('admin.modal.user.addedit-user',compact('id'));  
  }

  public function create(Request $req){
   $validator = Validator::make($req->all(), [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
    'mobile' => ['required', 'numeric', 'unique:users,mobile'],
    'password' => ['required'],
   ]);
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
    
   if(emailMobileValidation('email',$req->email,0)== false){ return response()->json(['success'=>"Email is already exist."],200); } 
   if(emailMobileValidation('mobile',$req->mobile,0)== false){ return response()->json(['success'=>"Mobile no is already exist."],200); }
        
   $data = new User();
   $data->name = $req->name;
   $data->email = $req->email;
   $data->mobile = $req->mobile;
   $data->password = Hash::make($req->password);
   $data->save(); 
   logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
   return response()->json(['success'=>"Created successfully"],200);
  }

  public function update(Request $req){
   $validator = Validator::make($req->all(), [
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$req->id],
    'mobile' => ['required', 'numeric', 'unique:users,mobile,'.$req->id],
   ]);
   if($validator->fails()){
    return response()->json(['error'=>$validator->errors()],201);     
   }
    
   if(emailMobileValidation('email',$req->email,0,$req->id)== false){ return response()->json(['success'=>"Email is already exist."],200); } 
   if(emailMobileValidation('mobile',$req->mobile,0,$req->id)== false){ return response()->json(['success'=>"Mobile no is already exist."],200); }
    
   $data = User::findOrFail($req->id); 
   $password = (!empty($req->password)) ? Hash::make($req->password) : $data->password; 
    
   $data->name = $req->name;
   $data->email = $req->email;
   $data->password = $password;
   $data->mobile = $req->mobile;
   $data->update(); 
   logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
   return response()->json(['success'=>"Updated successfully"],200);
  }

  public function delete(Request $request){
   $data = User::find($request->id);
   logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
   $data->delete(); 
  }

  public function search(Request $req){
   $req->validate(['search_keyword'=>'required']);
   $search_keyword = $req->search_keyword;
   $data = User::where('name','!=','');
   $data->where(function($q) use($search_keyword){
     $q->where('name','LIKE','%'.$search_keyword.'%')
       ->OrWhere('email','LIKE','%'.$search_keyword.'%')
       ->OrWhere('mobile','LIKE','%'.$search_keyword.'%');
   });
   $data = $data->paginate(setting()->user_per_page);
   $i = $data->perPage() * ( $data->currentPage() - 1);
   return view('admin.user',compact('data','search_keyword','i'));
  }

  public function bottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){
    foreach($ids as $id){
     $data = User::find($id);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
     $data->delete();
    }   
   }else if($action == "Active" || $action == "Inactive"){
    $status = ($action=="Active") ? 1 : 0;
    User::whereIn('id',$ids)->update(['status'=>$status]); 
   }
   return back()->with('message','success|Action completed.');
  }

  public function viewAddress(Request $req){
   $i = 1;
   $user = User::find($req->id);
   $data = UserAddress::where('user_id',$user->id)->get();
   return view('admin.modal.user.address',compact('data','user','i'));
  }

  public function addAddress(Request $req){
    $type = $req->type;
    $id = $req->id;
    $user_id = $req->user_id;
    if($type == "update"){
      $edit = UserAddress::findOrFail($id);
      return view('admin.modal.user.addedit-address',compact('edit','id','type','user_id'));
    }
    return view('admin.modal.user.addedit-address',compact('id','type','user_id')); 
  }

  public function createAddress(Request $req){
    $validator = Validator::make($req->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:user_addresses,email'],
      'mobile' => ['required', 'numeric', 'unique:user_addresses,mobile'],
      'city' => ['required', 'string'],
      'pincode' => ['required', 'numeric'],
      'country' => ['required'],
      'state' => ['required'],
      'address' => ['required'],
    ]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    
    if(emailMobileValidation('email',$req->email,1,$req->id)== false){ return response()->json(['success'=>"Email is already exist."],200); }
    if(emailMobileValidation('mobile',$req->mobile,1,$req->id)== false){ return response()->json(['success'=>"Mobile no is already exist."],200); }
  
    $data = new UserAddress();  
    $data->user_id = $req->id;
    $data->name = $req->name;
    $data->email = $req->email;
    $data->mobile = $req->mobile;
    $data->city = $req->city;
    $data->pincode = $req->pincode;
    $data->country = $req->country;
    $data->state = $req->state;
    $data->address = $req->address;
    $data->save(); 
    logHistory('ADD', admin()->id, admin()->name, "User Address", $data->name);
    return response()->json(['success'=>"Created successfully"],200);
  }

  public function updateAddress(Request $req){
    $validator = Validator::make($req->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:user_addresses,email,'.$req->id],
      'mobile' => ['required', 'numeric', 'unique:user_addresses,mobile,'.$req->id],
      'city' => ['required', 'string'],
      'pincode' => ['required', 'numeric'],
      'country' => ['required'],
      'state' => ['required'],
      'address' => ['required'],
    ]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    
    if(emailMobileValidation('email',$req->email,1,$req->user_id)== false){ return response()->json(['success'=>"Email is already exist."],200); }
    if(emailMobileValidation('mobile',$req->mobile,1,$req->user_id)== false){ return response()->json(['success'=>"Mobile no is already exist."],200); }
  
    $data = UserAddress::find($req->id);  
    $data->name = $req->name;
    $data->email = $req->email;
    $data->mobile = $req->mobile;
    $data->city = $req->city;
    $data->pincode = $req->pincode;
    $data->country = $req->country;
    $data->state = $req->state;
    $data->address = $req->address;
    $data->update(); 
    logHistory('UPDATE', admin()->id, admin()->name, "User Address", $data->name);
    return response()->json(['success'=>"Updated successfully"],200);
  }

  public function export(Request $req){
    return Excel::download(new ExportUser($req->user_ids), 'users.xlsx'); 
  }

  public function import(Request $req){
    $req->validate(['import_user'=>'required']); 
    $file = $req->file('import_user');
    $ext=$file->getClientOriginalExtension();
    if($ext=="csv"){
     Excel::import(new ImportUser(),request()->file('import_user'));
    return back()->with('message','success|Imported successfully.');
   }else{
    return back()->with('message','error|Please upload a csv file.');  
   } 
  }
  
  public function removeAddress(Request $req){
   UserAddress::where('id',$req->id)->delete();
   return back()->with('message','success|Removed successfully.');
  }

}
