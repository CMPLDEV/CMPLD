<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Session;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Location;
use App\Models\Category;
use App\Models\Showcase;
use App\Models\MoreImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\ProductNegotiationController;

class AjaxController extends Controller{

    public function getStates(Request $req){
     $data = DB::table('states')->where('country_id',$req->id)
                                ->pluck('name','id');
     return response()->json($data);
    }
    
    public function checkPincodeAvailability(Request $req){
     $count = 0;
     $msg = "Delivery not available at this pincode.";
     $check = Location::where('pincode',$req->pincode)
                      ->where('status',1)->count();
     if($check > 0){
      $count = 1;
      $msg = "Delivery in 3 to 7 days";
     }                  
     return response()->json(['status'=>$count, 'msg'=>$msg]);              
    }
    
    public function checkPincode(Request $req){
     $is_delivery = checkPincode($req->pincode);    
     return response()->json(['is_delivery'=>$is_delivery]);
    }

    public function loadProducts(Request $req){
     $type = $req->type;
     $sort_by = $req->sort_by;
     $type_value = $req->type_value;
     $category_id = $req->category_id;
     $filter_data = json_decode($req->filter_data, true);

     $products = Product::where('products.status',1);

      if(!empty($sort_by)){
      if($sort_by == "AZ"){
       $products->orderBy("products.name");  
      }else if($sort_by == "ZA"){
       $products->orderBy("products.name",'desc');
      }else if($sort_by == "LH"){
       $products->orderBy('price'); 
      }else if($sort_by == "HL"){
       $products->orderBy('price','desc'); 
      }else if($sort_by == "ON"){
       $products->orderBy("products.created_at"); 
      }else if($sort_by == "NO"){
       $products->orderBy("products.created_at",'desc');
      }else{
       $products->orderBy("products.created_at",'desc');    
      }
      }else{
       $products->orderBy("products.created_at");
      }

      if($type == "category"){
       $data = Category::select('id','name','image','slug')
                        ->where('id',$type_value)->first();
       $products->where('category_id', $data->id);
       if(!empty($filter_data)){
        $products->join('product_attributes','product_attributes.product_id','=','products.id');
        $products->whereIn('product_attributes.value', $filter_data)
                 ->groupBy('products.id');       
       }
       
      }else if($type == "brand"){
       $type_value_array = explode(',',$type_value);
       $products->where('category_id', $type_value_array[0])
                ->where('brand_id', $type_value_array[1]);  
      }else if($type == "search"){
       if(!empty($category_id)){
        $products->where('category_id', $category_id);   
       }
       $products->where(function($q) use($type_value){
        $q->where('name','LIKE','%'.$type_value.'%')
          ->orWhereRaw('FIND_IN_SET(?, keywords)', [$type_value])
          ->orWhere('sku',$type_value);
       });
      }
  
      $products = $products->paginate(28);
      return view('ajax.load-product',compact('products','type','type_value','sort_by'));
     }

      public function quickView(Request $req){
       $data = Product::find($req->product_id);
       $more_images = MoreImage::where('product_id',$data->id)->get();
       return view('ajax.quick-view',compact('data','more_images')); 
      }

      public function submitRating(Request $req){
       $res = ""; 
       if(Auth::check()){
        $validator = Validator::make($req->all(), [
         'rating' => ['required'],
         'review' => ['nullable','max:200'],
        ]);
        if($validator->fails()){
         return response()->json(['error'=>$validator->errors()],201);     
        }
        $product_id = $req->product_id; 
        $rating = $req->rating;
        $review = $req->review;
        $check_row = Rating::where('user_id',user()->id)->where('product_id',$product_id)->count(); 
        if($check_row > 0){
         Rating::where('user_id',user()->id)->where('product_id',$product_id)->update([
            'rating' => $rating,'review'=>$review ]); 
        }else{
         Rating::create(['user_id'=>user()->id,'product_id'=>$product_id,'rating' => $rating,'review'=>$review ]);
        }
        return response()->json(['status'=>1],200);
       }else{
        return response()->json(['status'=>0],401);     
       }
      } 

      public function addCompare(Request $req){
       $product_id = $req->id;
       $res = 0;
       if(Session::has('compare')){
        $compare_array = Session::get('compare');
       if(COUNT($compare_array) == 3){
        $res = 0; //array is full
       }else{
        if(!in_array($product_id,$compare_array)){
          array_push($compare_array,$product_id);
          Session::forget('compare');
          Session::put('compare',$compare_array);
          $res = 1; //add in array
        }else{
          $res = 2; //product is exist in array
        }
       }
       }else{
        Session::put('compare',[$product_id]);
        $res = 3; //create new one
       }
       return $res;
      } 
      
     /*public function checkPincodeAvailability(Request $req){
       $availability = 0;     
       $pincode = $req->pincode;     
       $check = new ShippingController();
       $check->pincode = $pincode;
       $response = json_decode($check->checkPincodeAvailability(), true);
       $result = json_decode($response['result'], true);
       if($result['GetServicesforPincodeAndProductResult']['DeliveryService'] == "Yes"){
        $availability = 1;   
       }
       return $availability;
     } */
     
     public function productNegotiation(Request $req){
      $product = Product::find($req->product_id);
      return view('ajax.product-negotiation', compact('product'));
     }
     
     public function submitProductNegotiation(Request $req){
      $validator = Validator::make($req->all(), [
            'email' => ['required','email','max:255'],
            'mobile' => ['required','numeric','digits:10'],
            'product_found_on' => ['required','max:255'],
            'price' => ['required','numeric'],
          ]);
      if($validator->fails()){
       return response()->json(['error'=>$validator->errors()],201);     
      }     
      $data = new ProductNegotiationController();  
      $data->product_id = $req->product_id;
      $data->email = $req->email;
      $data->mobile = $req->mobile;
      $data->product_found_on = $req->product_found_on;
      $data->price = $req->price;
      $data->create();
      return response()->json(['message'=>'Submitted successfully.'],200);
     }
     
     public function autocomplete(Request $request){
      $search_keyword = $request->q;
      $products = Product::where('name','LIKE','%'.$search_keyword.'%')
                         ->select('name')->where('status',1)->get();
      $data = array();
    
      foreach($products as $pro){
       $data[] = $pro->name;     
      }
      return response()->json($data);
     }
     
     public function showcase(Request $req){
      $showcases = Showcase::where('status', 1)->orderBy('order_by')
                           ->limit(1)->offset($req->offset)->get(); 
      return view('ajax.showcase', compact('showcases'));  
     } 
     
     public function paymentType(Request $req){
      $sub_type = $req->sub_type;
      return view('ajax.checkout-subtype', compact('sub_type'));
     }

}
