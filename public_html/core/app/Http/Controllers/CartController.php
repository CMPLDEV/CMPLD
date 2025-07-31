<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\CouponController;

class CartController extends Controller{
   
   protected $session_id;
   public function __construct(){
     $this->middleware('auth')->only(['wishlistList']);
     $this->middleware(function ($request, $next){
       $this->session_id = cartSession();
       return $next($request);
     });
   }

  public function index(){
    //EXECUTING THIS FUNCTION FOR DELETING CARTS ITEMS WHICH IS 30 DAYS OLD.
    deleteOldCart();
    
    $meta_title = setting()->comp_name." | Cart";
    $meta_description = setting()->comp_name." | Cart";
    $meta_keywords = setting()->comp_name." | Cart";
    $carts = cartData();
    return view('cart',compact('carts','meta_title','meta_description','meta_keywords'));
  } 

  public function addCart(Request $req){
    //CHECK STOCK OF PRODUCT
    $product = Product::find($req->product_id);
    $qty = $req->qty;
    if($qty > 0){
     if($product->stock >= $qty){
    $is_exist = Cart::where('product_id',$product->id);
    if(Auth::check()){
      $is_exist->where('user_id',Auth::user()->id);
    }else{
      $is_exist->where('session_id',$this->session_id);
    }
    
    $is_exist = $is_exist->count();
    if($is_exist == 0){
      $cart = new Cart();
      $cart->session_id = $this->session_id;
      if(Auth::check()){ $cart->user_id = Auth::user()->id; }
      $cart->product_id = $product->id;
      $cart->quantity = $qty;
      $cart->save();  
    }else{
     if(Auth::check()){
      Cart::where('product_id',$product->id)->where('quantity','<',$product->stock)->where('user_id',Auth::user()->id)->increment('quantity');
     }else{
      Cart::where('product_id',$product->id)->where('quantity','<',$product->stock)->where('session_id',$this->session_id)->increment('quantity');
     }  
    }
    $res = array('status'=>1,'cart_count'=>cartCount(),'msg'=>"Product added in cart.");
   }else{
    $res = array("status"=>0,"msg"=>$product->stock." Stock(s) available only.");
   }
    return response()->json($res);
   }
  }
    
  public function remove(Request $req){
    Cart::where('id',$req->id)->delete();
    return back()->with('message','success|Item removed from cart.');
  }

  public function updateCart(Request $req){
    //CHECK STOCK OF PRODUCT
    $qty = $req->qty; 
    $cart = Cart::find($req->cart_id);
    $product = Product::find($cart->product_id);
    if($qty > 0){
      if($product->stock >= $qty){
        $cart->quantity = $req->qty;
        $cart->update();
      }
    }   
    return true;
  }

  public function miniCart(){
   $carts = cartData();
   return view('mini-cart',compact('carts'));
  }

  public function applyCoupon(Request $req){
   $req->validate(['code'=>'required'],['code.required'=>'coupon code is required.']);
   $coupon = new CouponController();
   $coupon->code = $req->code;
   $coupon->user_id = Auth::user()->id;
   return $coupon->apply();
  }

  public function removeCoupon(Request $req){
   $coupon = new CouponController();
   $coupon->code = $req->id;
   return $coupon->remove();
  }

  public function addWishlist(Request $req){
   if(Auth::check()){  
    $product_id = $req->product_id;
    $check_row = Wishlist::where('product_id',$product_id)->where('user_id',user()->id)->count();
     if($check_row==0){
      $data = new Wishlist();
      $data->product_id = $product_id;
      $data->user_id = user()->id;
      $data->save();
      $response = array("status"=>1,"total"=>wishlistCount());
     }else{
      $response = array('status'=>2);
     }}else{
      $response = array('status'=>0);
     }
     return response()->json($response);
   }

   public function wishlistList(){
    $meta_title = "Wishlists";
    $meta_description = "Wishlists";
    $meta_keywords = "Wishlists";
    $products = Wishlist::join('products','products.id','=','wishlists.product_id')
                        ->select('wishlists.*','products.id as pro_id','products.name','products.image','products.slug','products.stock','products.price')->where('user_id',user()->id)->paginate(30);
    return view('wishlist',compact('meta_title','meta_description','meta_keywords','products'));
   }

   public function removeWishlist(Request $req){
    Wishlist::where('id',$req->id)->delete();
    return back()->with('message','success|Removed from wishlist.');
   }

}
