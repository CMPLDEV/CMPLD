<?php
namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller{
   
  protected $file_path;
  protected $section_name;
  
  public function __construct(){
   $this->middleware('auth:admin');
   $this->section_name = "Category";
   $this->file_path = "uploaded_files/category"; 
  }

   public function index(){
    $i = 1;   
    $data = adminCategories();
    return view('admin.category',compact('data','i'));
   }

   public function updateStatus(Request $req){
    Category::where('id', $req->id)->update(['status' => $req->status]);
    return back()->with('message','success|Status changed.');
   }

   public function add(Request $req){
    $id=0;
    $categories = Category::where('status',1)->where('type','CATEGORY');
    if(!empty($req->id)){
     $id = $req->id;
     $edit = Category::findOrFail($req->id);
     $categories = $categories->where('id','!=',$edit->id);
     $categories = $categories->get();
     return view('admin.modal.category.addedit-category',compact('edit','id','categories'));
    }
    $categories = $categories->get();
    return view('admin.modal.category.addedit-category',compact('id','categories'));  
   }

   public function create(Request $req){
    $validator = Validator::make($req->all(), [
     'parent_id' => ['required'],
     'name' => ['required', 'string', 'max:255'],
     'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:150'],
     'icon' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:150'],
     'banner' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:200']
    ]);
    
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
    $data->brand_ids = (isset($req->brand_ids)) ? implode(',', $req->brand_ids) : "";
    $data->type = "CATEGORY";
    $data->name = $req->name;
    $data->show_brand = (isset($req->show_brand)) ? 1 : 0;
    $data->slug = $parent_slug.Str::slug($req->name);
    $data->content = $req->content;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;
    
    $icon = "";
    $image = "";
    $banner = "";
    if($req->hasFile('icon')){
      $file = $req->file('icon');
      $icon = rand(11111111,99999999).".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$icon);
      $data->icon = $icon;
    }
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
    $data->save(); 
    logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
    return response()->json(['success'=>"Created successfully"],200);
  }

    public function update(Request $req){
     $validator = Validator::make($req->all(), [
       'parent_id' => ['required'],
       'name' => ['required', 'string', 'max:255'],
       'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:150'],
       'icon' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:150'],
       'banner' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:200']
      ]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
    
    $parent_slug=""; 
    if($req->parent_id!=0){
     $parent = Category::find($req->parent_id);
     $parent_slug = $parent->slug.'-';
    }
    
    $data = Category::findOrFail($req->id);
    $data->type = "CATEGORY";
    $data->parent_id = $req->parent_id;
    $data->brand_ids = (isset($req->brand_ids)) ? implode(',', $req->brand_ids) : "";
    $data->name = $req->name;
    $data->show_brand = (isset($req->show_brand)) ? 1 : 0;
    $data->slug = $parent_slug.Str::slug($req->name);
    $data->content = $req->content;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;
    
    $icon = $data->icon;
    $image = $data->image;
    $banner = $data->banner;
    if($req->hasFile('image')){
      @unlink($this->file_path."/".$image);
      $file = $req->file('image');
      $image = time().".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$image);
      $data->image = $image;
    }
    if($req->hasFile('icon')){
      @unlink($this->file_path."/".$icon);
      $file = $req->file('icon');
      $icon = time().".".$file->getClientOriginalExtension();
      $path = public_path("/".$this->file_path);
      if(is_dir($path)==false){ mkdir($path); }  
      $file->move($path,$icon);
      $data->icon = $icon;
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
    }else if(in_array($action, ['Make Best','Remove Best'])){
     $status = ($action=="Make Best") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['is_best'=>$status]);
    }else if(in_array($action, ['Show Header','Remove Header'])){
     $status = ($action=="Show Header") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['for_header'=>$status]);
    }else if(in_array($action, ['Show All','Remove All'])){
     $status = ($action=="Show All") ? 1 : 0;
     Category::whereIn('id',$ids)->update(['for_all'=>$status]);
    }
    return back()->with('message','success|Action completed.');
   }
   
   public function search(Request $req){
    $i = 1;
    $req->validate(['search_keyword'=>'required']);
    $search_keyword = $req->search_keyword;
    $data = Category::where('name','LIKE','%'.$search_keyword.'%')->get();
    return view('admin.category',compact('data','search_keyword','i'));    
   }
   
   public function attributes(Request $req){
    $category = Category::find($req->category_id);   
    $data = CategoryAttribute::where('category_id',$category->id)->get();
    return view('admin.category-attribute',compact('data','category'));
   }
   
   public function createAttribute(Request $req){
    $category_id = $req->category_id;   
    if(isset($req->key) && isset($req->value)){ 
    //CategoryAttribute::where('category_id',$category_id)->delete();    
    $arr_size = COUNT($req->key);
    if($arr_size > 0){ 
     for($i=0; $i<$arr_size; $i++){
      if($req->id[$i] == 0){
       if(!empty($req->key[$i]) && !empty($req->value[$i])){ 
        $data = new CategoryAttribute();
        $data->category_id = $category_id;
        $data->key = $req->key[$i];
        $data->value = $req->value[$i];
        $data->save();
      }   
      }else{
       if(!empty($req->key[$i]) && !empty($req->value[$i])){ 
       $data = CategoryAttribute::find($req->id[$i]);
       $data->key = $req->key[$i];
       $data->value = $req->value[$i];
       $data->update();
      }   
     }     
      
     }
    }}  
    return back()->with('message','success|Updated successfully.');
   }
   
   public function removeAttribute(Request $req){
    CategoryAttribute::where('id',$req->id)->delete();
    return true;
   }

}
