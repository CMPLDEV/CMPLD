<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Category;
use App\Models\Software;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller{
   
  protected $file_path;
  protected $section_name;
  
  public function __construct(){
   $this->middleware('auth:admin');
   $this->section_name = "Brand";
   $this->file_path = "uploaded_files/category"; 
  }

   public function index(){
    $data = adminBrands();
    $i = 1;
    return view('admin.brand',compact('data','i'));
   }

   public function updateStatus(Request $req){
    Category::where('id', $req->id)->update(['status' => $req->status]);
    return back()->with('message','success|Status changed.');
   }

  public function add(Request $req){
    $id=0;
    $categories = Category::where('status',1)->where('type','BRAND');
    if(!empty($req->id)){
     $id = $req->id;
     $edit = Category::findOrFail($req->id);
     $categories = $categories->where('id','!=',$edit->id);
     $categories = $categories->get();
     return view('admin.modal.brand.addedit-brand',compact('edit','id','categories'));
    }
    $categories = $categories->get();
    return view('admin.modal.brand.addedit-brand',compact('id','categories'));  
  }

  public function create(Request $req){
    $parent_id = $req->parent_id;
    if($parent_id == 0){
      $validator = Validator::make($req->all(), [
        'parent_id' => ['required'],
        'catalog' => ['nullable','mimes:pdf','max:500'],
        'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
        'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
      ]);
    }else{
      $validator = Validator::make($req->all(), [
        'parent_id' => ['required'],
        'name' => ['required', 'string', 'max:255'],
        'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
      ]);
    }
    
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    
    $parent_slug=""; 
    if($req->parent_id!=0){
     $parent = Category::find($req->parent_id);
     $parent_slug = $parent->slug.'-';
    }
    
    $data = new Category();
    $data->parent_id = $req->parent_id;
    $data->type = "BRAND";
    $data->name = $req->name;
    $data->slug = $parent_slug.Str::slug($req->name);
    $data->content = $req->content;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;
    
    $image = "";
    $banner = "";
    $catalog = "";
    if($req->hasFile('image')){
      $file = $req->file('image');
      $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
    }
    if($req->hasFile('banner')){
      $file = $req->file('banner');
      $banner = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$banner);
      $data->banner = $banner;
    }
    if($parent_id == 0){
     if($req->hasFile('catalog')){
      $file = $req->file('catalog');
      $catalog = rand(11111111,99999999).'.'.$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$catalog);
      $data->catalog = $catalog;
     } 
    }
    $data->save(); 
    logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Created successfully"],200);
  }

  public function update(Request $req){
    $parent_id = $req->parent_id;
    if($parent_id == 0){
      $validator = Validator::make($req->all(), [
        'parent_id' => ['required'],
        'catalog' => ['nullable','mimes:pdf','max:500'],
        'name' => ['required', 'string', 'max:255', 'unique:categories,name,'.$req->id],
        'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
      ]);
    }else{
      $validator = Validator::make($req->all(), [
        'parent_id' => ['required'],
        'name' => ['required', 'string', 'max:255'],
        'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp'],
      ]);
    }
    if($validator->fails()){
      return response()->json(['error'=>$validator->errors()],201);     
    }
    
    $parent_slug=""; 
    if($req->parent_id!=0){
      $parent = Category::find($req->parent_id);
      $parent_slug = $parent->slug.'-';
    }
    
    $data = Category::findOrFail($req->id);
    $data->type = "BRAND";
    $data->parent_id = $req->parent_id;
    $data->name = $req->name;
    $data->slug = $parent_slug.Str::slug($req->name);
    $data->content = $req->content;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;
    
    $image = $data->image;
    $banner = $data->banner;
    $catalog = $data->catalog;
    if($req->hasFile('image')){
      @unlink($this->file_path."/".$image);
      $file = $req->file('image');
      $image = time().".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
    }
    if($req->hasFile('banner')){
      @unlink($this->file_path."/".$banner);
      $file = $req->file('banner');
      $banner = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$banner);
      $data->banner = $banner;
    }
    if($parent_id == 0){
      if($req->hasFile('catalog')){
       @unlink($this->file_path."/".$catalog); 
       $file = $req->file('catalog');
       $catalog = rand(11111111,99999999).'.'.$file->getClientOriginalExtension();
       $path = public_path("/".$this->file_path);
       if(is_dir($path)==false){ mkdir($path); }  
       $file->move($path,$catalog);
       $data->catalog = $catalog;
      } 
     }
    $data->update(); 
    logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Updated successfully"],200);
  }

  public function removeImage(Request $req){
   $column = $req->column;
   $data = Category::findOrFail($req->id);
   @unlink($this->file_path."/".$data->$column);
   $data->$column = "";
   $data->update();
   return back()->with('message','success|File removed.');
  }

  public function delete(Request $request){
   $data = Category::findOrFail($request->id);
   Category::where('parent_id',$data->id)->update(['parent_id'=>0]);
   @unlink($this->file_path."/".$data->image);
   @unlink($this->file_path."/".$data->banner);
   @unlink($this->file_path."/".$data->catalog);
   logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
   $data->delete();    
   return back()->with('message','success|Deleted successfully.');
  }

  public function bottomAction(Request $req){
    $ids = $req->ids;
    $action = $req->req_for;
    if($action == "Delete"){  
     foreach($ids as $id) {
      $data = Category::find($id,['name','image','banner']);
      @unlink($this->file_path."/".$data->image);
      @unlink($this->file_path."/".$data->banner);
      @unlink($this->file_path."/".$data->catalog);
      logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
      $data->delete();   
     }   
    }else if($action == "Update Order"){
      $order_by_ids = $req->order_by_ids;
      $order_by = $req->order_by;
     for($i=0;$i<COUNT($order_by_ids);$i++){
      Category::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
     }
    }else if($action == "Active" || $action == "Inactive"){
     $status = ($action=="Active") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['status'=>$status]);
    }else if($action == "Show Home" || $action == "Remove Home"){
      $status = ($action=="Show Home") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['for_home'=>$status]);
    }else if($action == "Show Support" || $action == "Remove Support"){
      $status = ($action=="Show Support") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['show_support'=>$status]);
    }
    return back()->with('message','success|Action completed.');
  }
  
  /*########################## BRAND SOFTWARES ################################*/ 

 public function software(Request $req){
  $brand = Category::find($req->brand_id);     
  $data = Software::where('brand_id',$brand->id)->latest()->paginate(50);
  $i = $data->perPage() * ($data->currentPage() - 1);
  return view('admin.software',compact('data','i','brand'));
 }
 
 public function addSoftware(Request $req){
  $brand = Category::find($req->brand_id);
  return view('admin.addedit-software',compact('brand'));
 }
 
 public function createSoftware(Request $req){
  $req->validate(['name'=>'required|max:200', 'link'=>'required|url']);   
  $data = new Software();
  $data->brand_id = $req->brand_id;
  $data->name = $req->name;
  $data->link = $req->link;
  $data->status = $req->status;
  $data->save();
  return back()->with('message','success|Created successfully.');
 }
 
  public function updateSoftwareStatus(Request $req){
   $status = $req->status;
   Software::where('id', $req->id)->update(['status' => $status]);
   return back()->with('message','success|Status changed.');
  }
  
  public function editSoftware(Request $req){
   $brand = Category::find($req->brand_id);
   $edit = Software::find($req->id);
   return view('admin.addedit-software',compact('brand','edit'));
  }
  
 public function updateSoftware(Request $req){
  $req->validate(['name'=>'required|max:200', 'link'=>'required|url']);   
  $data = Software::find($req->id);
  $data->brand_id = $req->brand_id;
  $data->name = $req->name;
  $data->link = $req->link;
  $data->status = $req->status;
  $data->update();
  return back()->with('message','success|Updated successfully.');
 }
 
 public function softwareBottomAction(Request $req){
  $ids = $req->ids;
  $action = $req->req_for;
  if($action == "Delete"){
   Software::whereIn('id',$ids)->delete();      
  }else if($action == "Active" || $action == "Inactive"){
   $status = ($action == "Active") ? 1 : 0;
   Software::whereIn('id',$ids)->update(['status'=>$status]);
  }
  return back()->with('message','success|Action completed.');
 }

}
