<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller{
    
    protected $file_path;
    protected $section_name;
    
    public function __construct(){
     $this->section_name = "Page";    
     $this->middleware('auth:admin');
     $this->file_path = "uploaded_files/page"; 
    }
  
    public function index(){
     $data = Page::orderBy('order_by')->paginate(50);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.page',compact('data','i'));  
    }
  
    public function add(){   
     return view('admin.addedit-page');   
    }
  
     public function create(Request $req){
      $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                     'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                     'name' => 'required|max:255',
                     'slug' => 'required|unique:pages,slug',
                     'meta_title' => 'nullable|max:255',
                     'meta_description' => 'nullable|max:255',
                     'meta_keywords' => 'nullable|max:255']);
      $data = new Page();
      $data->name = $req->name;
      $data->slug = Str::slug($req->slug);
      $data->default_heading = $req->default_heading;
      $data->location_heading = $req->location_heading;
      $data->content = $req->content;
      $data->meta_title = $req->meta_title;
      $data->meta_description = $req->meta_description;
      $data->meta_keywords = $req->meta_keywords;
      $data->m_content = $req->m_content;
      $data->m_title = $req->m_title;
      $data->m_description = $req->m_description;
      $data->m_keywords = $req->m_keywords;
      $data->status = $req->status;
      
      $image = "";
      $banner = "";
      if($req->hasFile('image')){
        $file = $req->file('image');
        $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
        $path = public_path('/'.$this->file_path);
        if(is_dir($path)==false){ mkdir($path); }  
        $file->move($path,$image);
        $data->image = $image;
      }
      if($req->hasFile('banner')){
        $file = $req->file('banner');
        $banner = rand(11111111,99999999).".".$file->getClientOriginalExtension();
        $path = public_path('/'.$this->file_path);
        if(is_dir($path)==false){ mkdir($path); }  
        $file->move($path,$banner);
        $data->banner = $banner;
      }
       $data->save();
       return back()->with('message','success|Created successfully.');
    }
  
    public function edit(Request $req){
     $edit = Page::find($req->id);
     return view('admin.addedit-page',compact('edit'));  
    }
  
    public function update(Request $req){
      $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                     'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                     'name' => 'required|max:255',
                     'slug' => 'required|unique:pages,slug,'.$req->id,
                     'meta_title' => 'nullable|max:255',
                     'meta_description' => 'nullable|max:255',
                     'meta_keywords' => 'nullable|max:255']);
        $data = Page::find($req->id);
        $data->name = $req->name;
        $data->slug = Str::slug($req->slug);
        $data->default_heading = $req->default_heading;
        $data->location_heading = $req->location_heading;
        $data->content = $req->content;
        $data->meta_title = $req->meta_title;
        $data->meta_description = $req->meta_description;
        $data->meta_keywords = $req->meta_keywords;
        $data->m_content = $req->m_content;
        $data->m_title = $req->m_title;
        $data->m_description = $req->m_description;
        $data->m_keywords = $req->m_keywords;
        $data->status = $req->status;
        
        $image = $data->image;
        $banner = $data->banner;
        if($req->hasFile('image')){
         @unlink($this->file_path."/".$image);  
         $file = $req->file('image');
         $image = rand(11111111,99999999).".".$file->getClientOriginalExtension();
         $path = public_path('/'.$this->file_path);
         if(is_dir($path)==false){ mkdir($path); }  
         $file->move($path,$image);
         $data->image = $image;
        }
        if($req->hasFile('banner')){
         @unlink($this->file_path."/".$banner);  
         $file = $req->file('banner');
         $banner = rand(11111111,99999999).".".$file->getClientOriginalExtension();
         $path = public_path('/'.$this->file_path);
         if(is_dir($path)==false){ mkdir($path); }  
         $file->move($path,$banner);
         $data->banner = $banner;
        }
         $data->update();
         logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
        return back()->with('message','success|Updated successfully.');
       }

      public function updateStatus(Request $req){
       Page::where('id', $req->id)->update(['status' => $req->status]);
       return back()->with('message','success|Status changed.');
      }
    
      public function removeImage(Request $req){
       $data = Page::find($req->id);
       $column = $req->column;
       @unlink($this->file_path."/".$data->$column);
       $data->$column = "";
       $data->update();
       return back()->with('message','success|Image removed.');
      }

      public function bottomAction(Request $req){
       $ids = $req->ids;
       $action = $req->req_for;
       if($action == "Delete"){  
        foreach($ids as $id) {
         $data = Page::find($id,['name','image','banner']);
         @unlink("uploaded_files/page/".$data->image);
         @unlink("uploaded_files/page/".$data->banner);
         logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
         $data->delete();   
        }   
       }else if($action == "Update Order"){
        $order_by_ids = $req->order_by_ids;
        $order_by = $req->order_by;
        for($i=0;$i<COUNT($order_by_ids);$i++){
         Page::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
        }
       }else if($action == "Active" || $action == "Inactive"){
        $status = ($action=="Active") ? 1 : 0;
        Page::whereIn('id',$ids)->update(['status'=>$status]);
       }else if($action == "Set For Header" || $action == "Remove From Header"){
        $status = ($action=="Set For Header") ? 1 : 0;
        Page::whereIn('id',$ids)->update(['for_header'=>$status]);
       }else if($action == "Set For Footer" || $action == "Remove From Footer"){
        $status = ($action=="Set For Footer") ? 1 : 0;
        Page::whereIn('id',$ids)->update(['for_footer'=>$status]);
       }
       return back()->with('message','success|Action completed.');
      }

}
