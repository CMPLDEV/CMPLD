<?php

namespace App\Http\Controllers\Admin;

use App\Models\Showcase;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ShowcaseProduct;
use App\Http\Controllers\Controller;

class ShowcaseController extends Controller{
   
  protected $file_path;
  protected $section_name;
  
  public function __construct(){
   $this->middleware('auth:admin');
   $this->section_name = "Showcase";
   $this->file_path = "uploaded_files/showcase"; 
  }  

  public function index(){
   $data = Showcase::latest()->paginate(50);
   $i = $data->perPage() * ($data->currentPage() - 1);
   return view('admin.showcase.index', compact('data','i'));
  }

  public function add(){
   return view('admin.showcase.addedit'); 
  }

  public function create(Request $req){
   $req->validate(['name'=>'required|max:300|unique:showcases,name', 
                   'url'=>'nullable|url',
                   'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:300']);
   $data = new Showcase();
   $data->name = $req->name;
   $data->url = $req->url;
   $data->status = $req->status;
   if($req->hasFile('banner')){
    $file = $req->file('banner');
    $banner = time().'.'.$file->getClientOriginalExtension();
    $path = public_path('/'.$this->file_path);
    if(is_dir($path) == false){mkdir($path);}
    $data->banner = $banner;
    $file->move($path, $banner); 
   }
   $data->save();
   logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
   return back()->with('message','success|Created successfully.'); 
  }

  public function edit(Request $req){
   $edit = Showcase::find($req->id);
   return view('admin.showcase.addedit', compact('edit')); 
  }

  public function update(Request $req){
   $req->validate(['name'=>'required|max:300|unique:showcases,name,'.$req->id,
                   'url'=>'nullable|url',
                   'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:300']);
   $data = Showcase::find($req->id);
   $data->name = $req->name;
   $data->url = $req->url;
   $data->status = $req->status;
   if($req->hasFile('banner')){
    @unlink($this->file_path."/".$data->banner);
    $file = $req->file('banner');
    $banner = time().'.'.$file->getClientOriginalExtension();
    $path = public_path('/'.$this->file_path);
    if(is_dir($path) == false){mkdir($path);}
    $data->banner = $banner;
    $file->move($path, $banner); 
   }
   $data->update();
   logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
   return back()->with('message','success|Created successfully.'); 
  }

  public function bottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){
    foreach($ids as $id){
     $data = Showcase::find($id);
     logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
     $data->delete();
    }   
   }else if(in_array($action, ['Active','Inactive'])){
    $status = ($action == 'Active') ? 1 : 0;
    Showcase::whereIn('id',$ids)->update(['status'=>$status]);
   }else if($action == "Update Order"){
    $order_by_ids = $req->order_by_ids;
    $order_by = $req->order_by;
    for($i=0;$i<COUNT($order_by_ids);$i++){
     Showcase::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
    }
   } 
   return back()->with('message','success|Action completed.'); 
  }
  
   public function removeImage(Request $req){
    $data = Showcase::find($req->id);
    $column = $req->column;
    @unlink($this->file_path."/".$data->$column);
    $data->$column = "";
    $data->update();
    return back()->with('message','success|Image removed.');
   }

  public function updateStatus(Request $req){
   Showcase::where('id',$req->id)->update(['status'=>$req->status]); 
   return back()->with('message','success|Status changed.'); 
  }

  // **************#############################################****************

  public function showcaseProducts(Request $req){
   $showcase = Showcase::find($req->showcase_id); 
   $data = ShowcaseProduct::join('products','products.id','=','showcase_products.product_id')
          ->select('showcase_products.*','products.name')
          ->where('showcase_products.showcase_id',$showcase->id)->paginate(50);
   $i = $data->perPage() * ($data->currentPage() - 1);
   return view('admin.showcase.showcase-product', compact('showcase','data','i')); 
  }

  public function addShowcaseProduct(Request $req){
   $showcase = Showcase::find($req->showcase_id); 
   $all_products = [];
   // Process data in chunks
    Product::chunk(100, function ($products) use (&$all_products) {
     foreach ($products as $product) {
      $all_products[] = $product; 
     }
    });
   return view('admin.showcase.addedit-showcase-product', compact('showcase','all_products'));
  }

  public function createShowcaseProduct(Request $req){
   $req->validate(['product_id'=>'required']);
   $data = new ShowcaseProduct();
   $data->showcase_id = $req->showcase_id;
   $data->product_id = $req->product_id;
   $data->status = $req->status;
   $data->save();
   return back()->with('message','success|Created successfully.'); 
  }

  public function updateShowcaseProductStatus(Request $req){
   ShowcaseProduct::where('id',$req->id)->update(['status'=>$req->status]); 
   return back()->with('message','success|Status changed.');
  }

  public function bottomActionShowcaseProduct(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
   if($action == "Delete"){
    ShowcaseProduct::whereIn('id',$ids)->delete();
   }else if(in_array($action, ['Active','Inactive'])){
    $status = ($action == 'Active') ? 1 : 0;
    ShowcaseProduct::whereIn('id',$ids)->update(['status'=>$status]);
   }else if($action == "Update Order"){
    $order_by_ids = $req->order_by_ids;
    $order_by = $req->order_by;
    for($i=0;$i<COUNT($order_by_ids);$i++){
     ShowcaseProduct::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
    }
   } 
   return back()->with('message','success|Action completed.');
  }

}
