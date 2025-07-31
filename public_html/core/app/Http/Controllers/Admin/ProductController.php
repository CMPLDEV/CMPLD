<?php

namespace App\Http\Controllers\Admin;

use Str;
use Excel;
use App\Models\Product;
use App\Models\Category;
use App\Models\MoreImage;
use App\Models\MoreBanner;
use Illuminate\Http\Request;
use App\Models\ProductOffer;
use App\Imports\ImportProduct;
use App\Exports\ExportProduct;
use App\Models\ProductAttribute;
use App\Models\CategoryAttribute;
use App\Http\Controllers\Controller;

class ProductController extends Controller{
    
   protected $file_path;
   protected $section_name;
   
   public function __construct(){
    $this->middleware('auth:admin');
    $this->section_name = "Product";
    $this->file_path = "uploaded_files/product"; 
   }
   
   public function ifSubAdminLoggedIn(){
    $flag = 0;
    if(admin()->type == "SUB_ADMIN"){
     if(!empty(admin()->category_ids)){
      $flag = 1;        
     }
     if(!empty(admin()->brand_ids)){
      $flag = 1;        
     }
    }   
    return $flag;
   }

   public function index(){
    $data = Product::orderBy('status','desc');
    if($this->ifSubAdminLoggedIn()){
     $data->whereIn('category_id', explode(',', admin()->category_ids));
     $data->whereIn('brand_id', explode(',', admin()->brand_ids));
    }
    $data = $data->paginate(setting()->product_per_page);
    $i = $data->perPage() * ($data->currentPage() - 1);
    return view('admin.product',compact('data','i'));  
   }

   public function add(){   
    $categories = Category::where('parent_id', 0)->where('type','CATEGORY');
    $brands = Category::where('parent_id', 0)->where('type','BRAND');
    if($this->ifSubAdminLoggedIn()){
     $categories->whereIn('id', explode(',', admin()->category_ids));
     $brands->whereIn('id', explode(',', admin()->brand_ids));
    }
    $categories = $categories->get();
    $brands = $brands->get();
    return view('admin.addedit-product', compact('categories','brands'));   
   }

   public function create(Request $req){
      $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
        'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
        'name'=>'required|max:255|unique:products,name',
        'brand_id'=>'required',
        'sku'=>'nullable',
        'mrp'=>'required|numeric|gt:0',
        'price'=>'required|numeric|gt:0',
        'stock'=>'required|numeric|gt:-1',
        'keywords'=>'nullable',
        'video'=>'nullable|min:11',
        'replacement'=>'nullable|max:200',
        'delivery'=>'nullable|max:200',
        'warranty'=>'nullable|max:200',
        'brand'=>'nullable|max:200',
        'bluedart'=>'nullable|max:200',
        'secure'=>'nullable|max:200',
        'warranty_period'=>'required',
        'variant1_title'=>'nullable|max:100', 
        'variant1_image'=>'nullable|max:255', 
        'variant1_url'=>'nullable|url|max:500',
        'variant2_title'=>'nullable|max:100', 
        'variant2_image'=>'nullable|max:255', 
        'variant2_url'=>'nullable|url|max:500',
        'variant3_title'=>'nullable|max:100', 
        'variant3_image'=>'nullable|max:255', 
        'variant3_url'=>'nullable|url|max:500',
        'variant4_title'=>'nullable|max:100', 
        'variant4_image'=>'nullable|max:255', 
        'variant4_url'=>'nullable|url|max:500',
        'variant5_title'=>'nullable|max:100', 
        'variant5_image'=>'nullable|max:255', 
        'variant5_url'=>'nullable|url|max:500',
        'variant6_title'=>'nullable|max:100', 
        'variant6_image'=>'nullable|max:255', 
        'variant6_url'=>'nullable|url|max:500',
        'variant7_title'=>'nullable|max:100', 
        'variant7_image'=>'nullable|max:255', 
        'variant7_url'=>'nullable|url|max:500',
        'variant8_title'=>'nullable|max:100', 
        'variant8_image'=>'nullable|max:255', 
        'variant8_url'=>'nullable|url|max:500',
        'variant9_title'=>'nullable|max:100', 
        'variant9_image'=>'nullable|max:255', 
        'variant9_url'=>'nullable|url|max:500',
        'variant10_title'=>'nullable|max:100', 
        'variant10_image'=>'nullable|max:255', 
        'variant10_url'=>'nullable|url|max:500']);
    
    $data = new Product();
    $data->category_id = $req->category_id;
    $data->brand_id = $req->brand_id;
    $data->name = $req->name;
    $data->slug = Str::slug($req->name);
    $data->short_content = $req->short_content;
    $data->content = $req->content;
    $data->additional_information = $req->additional_information;
    $data->warranty_period = $req->warranty_period;
    $data->sku = $req->sku;
    $data->mrp = $req->mrp;
    $data->price = $req->price;
    $data->stock = $req->stock;
    $data->asin = $req->asin;
    $data->replacement = $req->replacement;
    $data->delivery = $req->delivery;
    $data->warranty = $req->warranty;
    $data->brand = $req->brand;
    $data->bluedart = $req->bluedart;
    $data->secure = $req->secure;
    $data->keywords = $req->keywords;
    $data->video = $req->video;
    $data->image_alt = $req->image_alt;
    $data->image_title = $req->image_title;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;
    $data->status = $req->status;
    
    $data->variant1_title = $req->variant1_title;
    $data->variant1_image = $req->variant1_image;
    $data->variant1_url = $req->variant1_url;
    $data->variant2_title = $req->variant2_title;
    $data->variant2_image = $req->variant2_image;
    $data->variant2_url = $req->variant2_url;
    $data->variant3_title = $req->variant3_title;
    $data->variant3_image = $req->variant3_image;
    $data->variant3_url = $req->variant3_url;
    $data->variant4_title = $req->variant4_title;
    $data->variant4_image = $req->variant4_image;
    $data->variant4_url = $req->variant4_url;
    $data->variant5_title = $req->variant5_title;
    $data->variant5_image = $req->variant5_image;
    $data->variant5_url = $req->variant5_url;
    $data->variant6_title = $req->variant6_title;
    $data->variant6_image = $req->variant6_image;
    $data->variant6_url = $req->variant6_url;
    $data->variant7_title = $req->variant7_title;
    $data->variant7_image = $req->variant7_image;
    $data->variant7_url = $req->variant7_url;
    $data->variant8_title = $req->variant8_title;
    $data->variant8_image = $req->variant8_image;
    $data->variant8_url = $req->variant8_url;
    $data->variant9_title = $req->variant9_title;
    $data->variant9_image = $req->variant9_image;
    $data->variant9_url = $req->variant9_url;
    $data->variant10_title = $req->variant10_title;
    $data->variant10_image = $req->variant10_image;
    $data->variant10_url = $req->variant10_url;
    
    $image = "";
    if($req->hasFile('image')){
     $file = $req->file('image');
     $image = time().".".$file->getClientOriginalExtension();
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

    //ADD MORE IMAGES
    $images = array();
    if($files=$req->file('more_images')){
     foreach($files as $file){
      $ext_array = array('jpeg','jpg','png','webp');
      $ext = $file->getClientOriginalExtension();
      $file_size = $file->getSize();  
     if(in_array($ext,$ext_array)){ 
      if($file_size <= 250000){
       $more_image = rand(11111111,99999999).".".$ext;
       $path = public_path('/uploaded_files/more_image');
       if(is_dir($path)==false){ mkdir($path); } 
       $file->move($path,$more_image);
       $images[] = $more_image;  
     }}}
      
    foreach($images as $image){
     MoreImage::create([ 'product_id' => $data->id, 'image' => $image ]);
    }} 
    
    //ADD MORE BANNERS
    $images = array();
    if($files=$req->file('more_banners')){
     foreach($files as $file){
      $ext_array = array('jpeg','jpg','png','webp');
      $ext = $file->getClientOriginalExtension();
      $file_size = $file->getSize();  
     if(in_array($ext,$ext_array)){ 
      if($file_size <= 250000){
       $more_image = rand(11111111,99999999).".".$ext;
       $path = public_path('/uploaded_files/more_image');
       if(is_dir($path)==false){ mkdir($path); } 
       $file->move($path,$more_image);
       $images[] = $more_image;  
     }}}
      
    foreach($images as $image){
     MoreBanner::create([ 'product_id' => $data->id, 'image' => $image ]);
    }}
    
    if(isset($req->key) && isset($req->value) && isset($req->cat_attr_id)){ 
    $arr_size = COUNT($req->key);
    if($arr_size>0){ 
     for($i=0;$i<$arr_size;$i++){
      if(!empty($req->key[$i]) && !empty($req->value[$i]) && !empty($req->cat_attr_id[$i])){ 
       $attribute = new ProductAttribute();
       $attribute->cat_attr_id = $req->cat_attr_id[$i];
       $attribute->key = $req->key[$i];
       $attribute->key_slug = str_replace(' ','_',strtolower($req->key[$i]));
       $attribute->value = $req->value[$i];
       $data->attributes()->save($attribute);
      }
     }
    }}
    logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->name);
    return back()->with('message','success|Created successfully.');
  }

  public function edit(Request $req){
    $edit = Product::findOrFail($req->id);
    $attributes = ProductAttribute::join('category_attributes','category_attributes.id','=','product_attributes.cat_attr_id')
        ->select('product_attributes.id as pro_attr_id','product_attributes.key as pro_attr_key','product_attributes.value as pro_attr_value','category_attributes.id as cat_attr_id','category_attributes.key as cat_attr_key','category_attributes.value as cat_attr_value')
              ->where('category_attributes.category_id',$edit->category_id)
              ->where('product_attributes.product_id',$edit->id)->get();
              
    $category_attributes = CategoryAttribute::where('category_id',$edit->category_id)->whereNotIn('id',function($q) use($edit){
       $q->select('cat_attr_id')
         ->from('product_attributes')
         ->where('product_id',$edit->id);
    })->get();          
    $categories = Category::where('parent_id', 0)->where('type','CATEGORY');
    $brands = Category::where('parent_id', 0)->where('type','BRAND');
    if($this->ifSubAdminLoggedIn()){
     $categories->whereIn('id', explode(',', admin()->category_ids));
     $brands->whereIn('id', explode(',', admin()->brand_ids));
    }
    $categories = $categories->get();
    $brands = $brands->get();
    return view('admin.addedit-product',compact('edit','attributes','category_attributes','categories','brands'));  
  }

  public function update(Request $req){
      $req->validate(['image'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:150',
        'banner'=>'nullable|image|mimes:jpeg,jpg,png,webp|max:200',
        'name'=>'required|max:255|unique:products,name,'.$req->id,
        'brand_id'=>'required',
        'sku'=>'nullable',
        'mrp'=>'required|numeric|gt:0',
        'price'=>'required|numeric|gt:0',
        'stock'=>'required|numeric|gt:-1',
        'keywords'=>'nullable',
        'video'=>'nullable|min:11',
        'replacement'=>'nullable|max:200',
        'delivery'=>'nullable|max:200',
        'warranty'=>'nullable|max:200',
        'brand'=>'nullable|max:200',
        'bluedart'=>'nullable|max:200',
        'secure'=>'nullable|max:200',
        'warranty_period'=>'required',
        'variant1_title'=>'nullable|max:100', 
        'variant1_image'=>'nullable|max:255', 
        'variant1_url'=>'nullable|url|max:500',
        'variant2_title'=>'nullable|max:100', 
        'variant2_image'=>'nullable|max:255', 
        'variant2_url'=>'nullable|url|max:500',
        'variant3_title'=>'nullable|max:100', 
        'variant3_image'=>'nullable|max:255', 
        'variant3_url'=>'nullable|url|max:500',
        'variant4_title'=>'nullable|max:100', 
        'variant4_image'=>'nullable|max:255', 
        'variant4_url'=>'nullable|url|max:500',
        'variant5_title'=>'nullable|max:100', 
        'variant5_image'=>'nullable|max:255', 
        'variant5_url'=>'nullable|url|max:500',
        'variant6_title'=>'nullable|max:100', 
        'variant6_image'=>'nullable|max:255', 
        'variant6_url'=>'nullable|url|max:500',
        'variant7_title'=>'nullable|max:100', 
        'variant7_image'=>'nullable|max:255', 
        'variant7_url'=>'nullable|url|max:500',
        'variant8_title'=>'nullable|max:100', 
        'variant8_image'=>'nullable|max:255', 
        'variant8_url'=>'nullable|url|max:500',
        'variant9_title'=>'nullable|max:100', 
        'variant9_image'=>'nullable|max:255', 
        'variant9_url'=>'nullable|url|max:500',
        'variant10_title'=>'nullable|max:100', 
        'variant10_image'=>'nullable|max:255', 
        'variant10_url'=>'nullable|url|max:500']);
            
      $data = Product::find($req->id);
      if(empty($data->category_id)){
       $data->category_id = $req->category_id;
      }
      $data->brand_id = $req->brand_id;
      $data->name = $req->name;
      $data->slug = Str::slug($req->name);
      $data->short_content = $req->short_content;
      $data->content = $req->content;
      $data->additional_information = $req->additional_information;
      $data->warranty_period = $req->warranty_period;
      $data->sku = $req->sku;
      $data->mrp = $req->mrp;
      $data->price = $req->price;
      $data->stock = $req->stock;
      $data->asin = $req->asin;
      $data->replacement = $req->replacement;
      $data->delivery = $req->delivery;
      $data->warranty = $req->warranty;
      $data->brand = $req->brand;
      $data->bluedart = $req->bluedart;
      $data->secure = $req->secure;
      $data->keywords = $req->keywords;
      $data->video = $req->video;
      $data->image_alt = $req->image_alt;
      $data->image_title = $req->image_title;
      $data->meta_title = $req->meta_title;
      $data->meta_description = $req->meta_description;
      $data->meta_keywords = $req->meta_keywords;
      $data->status = $req->status;
      
      $data->variant1_title = $req->variant1_title;
    $data->variant1_image = $req->variant1_image;
    $data->variant1_url = $req->variant1_url;
    $data->variant2_title = $req->variant2_title;
    $data->variant2_image = $req->variant2_image;
    $data->variant2_url = $req->variant2_url;
    $data->variant3_title = $req->variant3_title;
    $data->variant3_image = $req->variant3_image;
    $data->variant3_url = $req->variant3_url;
    $data->variant4_title = $req->variant4_title;
    $data->variant4_image = $req->variant4_image;
    $data->variant4_url = $req->variant4_url;
    $data->variant5_title = $req->variant5_title;
    $data->variant5_image = $req->variant5_image;
    $data->variant5_url = $req->variant5_url;
    $data->variant6_title = $req->variant6_title;
    $data->variant6_image = $req->variant6_image;
    $data->variant6_url = $req->variant6_url;
    $data->variant7_title = $req->variant7_title;
    $data->variant7_image = $req->variant7_image;
    $data->variant7_url = $req->variant7_url;
    $data->variant8_title = $req->variant8_title;
    $data->variant8_image = $req->variant8_image;
    $data->variant8_url = $req->variant8_url;
    $data->variant9_title = $req->variant9_title;
    $data->variant9_image = $req->variant9_image;
    $data->variant9_url = $req->variant9_url;
    $data->variant10_title = $req->variant10_title;
    $data->variant10_image = $req->variant10_image;
    $data->variant10_url = $req->variant10_url;
      
      $image = $data->image;
      $banner = $data->banner;
      if($req->hasFile('image')){
        @unlink($this->file_path."/".$image);  
        $file = $req->file('image');
        $image = time().".".$file->getClientOriginalExtension();
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

       //ADD MORE IMAGES
     $images = array();
     if($files=$req->file('more_images')){
       foreach($files as $file){
        $ext_array = array('jpeg','jpg','png','webp');
        $ext = $file->getClientOriginalExtension();
        $file_size = $file->getSize();  
       if(in_array($ext,$ext_array)){
        if($file_size <= 250000){  
         $more_image = rand(11111111,99999999).".".$ext;
         $path = public_path('/uploaded_files/more_image');
         if(is_dir($path)==false){ mkdir($path); } 
         $file->move($path,$more_image);
         $images[] = $more_image;  
       }}}
       
     foreach($images as $image){
      MoreImage::create([ 'product_id' => $data->id, 'image' => $image ]);
     }}
     
       //ADD MORE BANNERS
     $images = array();
     if($files=$req->file('more_banners')){
       foreach($files as $file){
        $ext_array = array('jpeg','jpg','png','webp');
        $ext = $file->getClientOriginalExtension();
        $file_size = $file->getSize();  
       if(in_array($ext,$ext_array)){
        if($file_size <= 250000){  
         $more_image = rand(11111111,99999999).".".$ext;
         $path = public_path('/uploaded_files/more_image');
         if(is_dir($path)==false){ mkdir($path); } 
         $file->move($path,$more_image);
         $images[] = $more_image;  
       }}}
       
     foreach($images as $image){
      MoreBanner::create([ 'product_id' => $data->id, 'image' => $image ]);
     }}
     
     if(isset($req->key) && isset($req->value) && isset($req->cat_attr_id)){
      ProductAttribute::where('product_id',$data->id)->delete();
      $arr_size = COUNT($req->key);
      if($arr_size>0){ 
       for($i=0;$i<$arr_size;$i++){
        if(!empty($req->key[$i]) && !empty($req->value[$i]) && !empty($req->cat_attr_id[$i])){  
         $attribute = new ProductAttribute();
         $attribute->cat_attr_id = $req->cat_attr_id[$i];
         $attribute->key = $req->key[$i];
         $attribute->key_slug = str_replace(' ','_',strtolower($req->key[$i]));
         $attribute->value = $req->value[$i];
         $data->attributes()->save($attribute);
        }
       }
      }}
     logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->name);
     return back()->with('message','success|Updated successfully.');
    }

    public function removeImage(Request $req){
     $column = $req->column;
     $data = Product::find($req->id);
     @unlink($this->file_path."/".$data->$column);
     $data->$column = "";
     $data->update();
     return back()->with('message','success|Image removed.');
    }

    public function updateStatus(Request $req){
     Product::where('id', $req->id)->update(['status' => $req->status]);
     return back()->with('message','success|Status changed.');
    }

    public function search(Request $req){
     $search_keyword = $req->search_keyword;
     $filter = $req->filter;
     $brand = $req->brand;
     $category = $req->category;
     $data = Product::where('name','!=','');
     if($this->ifSubAdminLoggedIn()){
      $data->whereIn('category_id', explode(',', admin()->category_ids));
      $data->whereIn('brand_id', explode(',', admin()->brand_ids));
     }
     if(!empty($search_keyword)){
      $data->where(function($q) use($search_keyword){
       $q->where('name','LIKE','%'.$search_keyword.'%')
         ->orWhere('sku',$search_keyword);      
      });     
     }
     if(!empty($brand)){
      $data->where('brand_id', $brand);      
     }
     if(!empty($category)){
      $data->where('category_id', $category);     
     }
     if(!empty($filter)){
      if($filter == "A-Z"){
       $data->orderBy('name','asc');
      }else if($filter == "Z-A"){
       $data->orderBy('name','desc');
      }else if($filter == "ON"){
       $data->orderBy('id','asc');
      }else if($filter == "NO"){
       $data->latest();
      }else if($filter == "ACTIVE"){
       $data->where('status',1);
      }else if($filter == "INACTIVE"){
       $data->where('status',0);
      }else if($filter == "INSTOCK"){
       $data->where('stock','>',1);
      }else if($filter == "OUTSTOCK"){
       $data->where('stock','<=',0);
      }else if($filter == "EOL"){
       $data->where('is_eol',1);
      }   
     }      
      
     $data = $data->paginate(setting()->product_per_page);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.product',compact('data','i','search_keyword','filter','brand','category'));
    }

    public function bottomAction(Request $req){
      $ids = $req->ids;
      $action = $req->req_for;
      if($action == "Delete"){  
       foreach($ids as $id) {
        $more_image = MoreImage::where('product_id',$id)->get();
        foreach($more_image as $row){
         @unlink("uploaded_files/more_image/".$row->image);
         MoreImage::where('id',$row->id)->delete();
        }
        $more_banner = MoreBanner::where('product_id',$id)->get();
        foreach($more_banner as $row){
         @unlink("uploaded_files/more_image/".$row->image);
         MoreBanner::where('id',$row->id)->delete();
        }
         $data = Product::find($id,['name','image','banner']);
         @unlink($this->file_path."/".$data->image);
         @unlink($this->file_path."/".$data->banner);
         logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->name);
         Product::where('id',$id)->delete();   
       }   
      }else if($action == "Update Input"){
        $hidden_ids = $req->hidden_ids;
        
        //UPDATE ORDER BY
        $order_by = $req->order_by;
        for($i=0;$i<COUNT($hidden_ids);$i++){
         Product::where('id', $hidden_ids[$i])->update(['order_by' => $order_by[$i]]);
        }
        
        //UPDATE MRP
        $mrp = $req->mrp;
        for($i=0;$i<COUNT($hidden_ids);$i++){
         Product::where('id', $hidden_ids[$i])->update(['mrp' => $mrp[$i]]);
        }
        
        //UPDATE PRICE
        $price = $req->price;
        for($i=0;$i<COUNT($hidden_ids);$i++){
         Product::where('id', $hidden_ids[$i])->update(['price' => $price[$i]]);
        }
        
        //UPDATE STOCK
        $stock = $req->stock;
        for($i=0;$i<COUNT($hidden_ids);$i++){
         Product::where('id', $hidden_ids[$i])->update(['stock' => $stock[$i]]);
        }
        
      }else if($action == "Active" || $action == "Inactive"){
       $status = ($action=="Active") ? 1 : 0;
       Product::whereIn('id',$ids)->update(['status'=>$status]);
      }else if($action == "Make Featured" || $action == "Remove Featured"){
        $status = ($action=="Make Featured") ? 1 : 0;
        Product::whereIn('id',$ids)->update(['is_featured'=>$status]);
      }else if($action == "Make Best" || $action == "Remove Best"){
        $status = ($action=="Make Best") ? 1 : 0;
        Product::whereIn('id',$ids)->update(['is_best'=>$status]);
      }else if($action == "Make EOL" || $action == "Remove EOL"){
        $status = ($action=="Make EOL") ? 1 : 0;
        Product::whereIn('id',$ids)->update(['is_eol'=>$status]);
      }
      return back()->with('message','success|Action completed.');
    }

    public function export(Request $req){
     $filename = "pro-".md5(time()).".xlsx";    
     return Excel::download(new ExportProduct($req->product_ids), $filename); 
    }

    public function import(Request $req){
     $req->validate(['import_product'=>'required']); 
     $file = $req->file('import_product');
     $ext=$file->getClientOriginalExtension();
     if($ext=="csv"){
      Excel::import(new ImportProduct(),request()->file('import_product'));
      return back()->with('message','success|Imported successfully.');
     }else{
      return back()->with('message','error|Please upload a csv file.');  
     } 
    }

    public function removeMoreImages(Request $req){
     $data = MoreImage::find($req->id);
     @unlink("uploaded_files/more_image/".$data->image);
     $data->delete();
     return back()->with('message','success|Image removed.');
    }
    
    public function removeMoreBanners(Request $req){
     $data = MoreBanner::find($req->id);
     @unlink("uploaded_files/more_image/".$data->image);
     $data->delete();
     return back()->with('message','success|Image removed.');
    }
    
    public function attributeForm(Request $req){
     $data = CategoryAttribute::where('category_id',$req->category_id)->get();
     return view('admin.category-attribute-form',compact('data'));
    }
    
    public function categoryProduct(Request $req){
     $data = Product::where('category_id', $req->id)->orderBy('order_by')
                    ->paginate(setting()->product_per_page);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.product',compact('data','i'));
    }
    
    public function copy(Request $req){
     $product = Product::find($req->id);
     $data = new Product();
     $data->category_id = NULL;
     $data->brand_id = $product->brand_id;
     $data->name = $product->name;
     $data->slug = Str::slug($product->name)."-".rand(1111,9999);
     $data->short_content = $product->short_content;
     $data->content = $product->content;
     $data->additional_information = $product->additional_information;
     $data->warranty_period = $product->warranty_period;
     $data->sku = $product->sku;
     $data->mrp = $product->mrp;
     $data->price = $product->price;
     $data->stock = $product->stock;
     $data->asin = $product->asin;
     $data->replacement = $product->replacement;
     $data->delivery = $product->delivery;
     $data->warranty = $product->warranty;
     $data->brand = $product->brand;
     $data->keywords = $product->keywords;
     $data->video = $product->video;
     $data->image_alt = $product->image_alt;
     $data->image_title = $product->image_title;
     $data->meta_title = $product->meta_title;
     $data->meta_description = $product->meta_description;
     $data->meta_keywords = $product->meta_keywords;
     $data->status = $product->status;
     $data->save();
     return back()->with('message','success|Copied successfully.');
    }

/*###################### MANAGE OFFER ############################*/    
  
  public function offer(Request $req){
   $product = Product::find($req->product_id);      
   $data = ProductOffer::where('product_id', $product->id)->latest()
                        ->paginate(20);
   $i = $data->perPage() * ($data->currentPage() -1);
   return view('admin.product-offer',compact('data','i','product'));
  }  
  
  public function addOffer(Request $req){
   $product = Product::find($req->product_id);
   return view('admin.addedit-product-offer',compact('product'));
  }
  
  public function createOffer(Request $req){
   $req->validate(['name'=>'required|max:200', 'content'=>'required|max:255',
                   'link'=>'required|url']); 
   $data = new ProductOffer();
   $data->name = $req->name;
   $data->link = $req->link;
   $data->status = $req->status;
   $data->content = $req->content;
   $data->product_id = $req->product_id;
   $data->save();
   return back()->with('message','success|Created successfully.');
  }
  
  public function editOffer(Request $req){
   $product = Product::find($req->product_id);
   $edit = ProductOffer::find($req->id);
   return view('admin.addedit-product-offer',compact('product','edit'));
  }
  
  public function updateOffer(Request $req){
   $req->validate(['name'=>'required|max:200', 'content'=>'required|max:255',
                   'link'=>'required|url']); 
   $data = ProductOffer::find($req->id);
   $data->name = $req->name;
   $data->link = $req->link;
   $data->status = $req->status;
   $data->content = $req->content;
   $data->update();
   return back()->with('message','success|Updated successfully.');
  }
   
  public function offerBottomAction(Request $req){
   $ids = $req->ids;
   $action = $req->req_for;
     if($action == "Delete"){  
      foreach($ids as $id) {
       ProductOffer::where('id',$id)->delete();   
      }   
     }else if($action == "Update Order"){
       $order_by_ids = $req->order_by_ids;
       $order_by = $req->order_by;
      for($i=0;$i<COUNT($order_by_ids);$i++){
       ProductOffer::where('id', $order_by_ids[$i])->update(['order_by' => $order_by[$i]]);
      }
     }else if($action == "Active" || $action == "Inactive"){
      $status = ($action=="Active") ? 1 : 0;
      ProductOffer::whereIn('id',$ids)->update(['status'=>$status]);
     }
    return back()->with('message','success|Action completed.');
  }  
    
}
