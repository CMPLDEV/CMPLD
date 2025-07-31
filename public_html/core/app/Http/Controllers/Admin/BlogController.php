<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller{
    
    protected $file_path;
    protected $section_name;
    
    public function __construct(){
     $this->middleware('auth:admin');
     $this->section_name = "Blog";
     $this->file_path = "uploaded_files/blog"; 
    }

    public function index(){
     $data = Blog::orderBy('order_by')->paginate(50);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.blog',compact('data','i'));  
    }

    public function add(){   
     return view('admin.addedit-blog');   
    }

    public function create(Request $req){
     $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                     'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                     'name'=>'required|max:255|unique:blogs,name']);
     $data = new Blog();
     $data->name = $req->name;
     $data->slug = Str::slug($req->name);
     $data->is_news = (isset($req->is_news)) ? 1 : 0;
     $data->content = $req->content;
     $data->alt = $req->alt;
     $data->title = $req->title;
     $data->meta_title = $req->meta_title;
     $data->meta_description = $req->meta_description;
     $data->meta_keywords = $req->meta_keywords;
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
     logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
     return back()->with('message','success|Created successfully.');
    }
    
    public function edit(Request $req){
     $edit = Blog::find($req->id);
     return view('admin.addedit-blog',compact('edit'));  
    }

    public function update(Request $req){
     $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
                     'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
                     'name' => 'required|max:255|unique:blogs,name,'.$req->id]);
     $data = Blog::find($req->id);
     $data->name = $req->name;
     $data->slug = Str::slug($req->name);
     $data->is_news = (isset($req->is_news)) ? 1 : 0;
     $data->content = $req->content;
     $data->alt = $req->alt;
     $data->title = $req->title;
     $data->meta_title = $req->meta_title;
     $data->meta_description = $req->meta_description;
     $data->meta_keywords = $req->meta_keywords;
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
     Blog::where('id', $req->id)->update(['status' => $req->status]);
     return back()->with('message','success|Status changed.');
    }
    
    public function removeImage(Request $req){
     $data = Blog::find($req->id);
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
       $data = Blog::find($id,['name','image','banner']);
       @unlink($this->file_path."/".$data->image);
       @unlink($this->file_path."/".$data->banner);
       logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
       $data->delete();   
      }   
     }else if($action == "Update Order"){
      $order_by_ids = $req->order_by_ids;
      $order_by = $req->order_by;
      for($i=0;$i<COUNT($order_by_ids);$i++){
       Blog::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
      }
     }else if($action == "Active" || $action == "Inactive"){
      $status = ($action=="Active") ? 1 : 0;
      Blog::whereIn('id',$ids)->update(['status'=>$status]);
     }
     return back()->with('message','success|Action completed.');
    }

}
