<?php

function domain(){
 return str_replace(['http://','https://'],'',setting()->website_url); 
}

function setting(){
 $data = \App\Models\Setting::findOrFail(1);
 return $data;  
}

function noImage(){
 $image = "admin_assets/images/no-image.png";
 return $image;
}

function noBanner(){
 $image = "admin_assets/images/no-banner.jpg";
 return $image;
}

function admin($id=0){
 if($id!=0){
  return \App\Models\Admin::find($id);
 }else{
 if(\Auth::guard('admin')->check()){
  return \App\Models\Admin::find(\Auth::guard('admin')->user()->id);
 }}
}

 function products($id=0){
  if($id!=0){
   return \App\Models\Product::find($id);
  }else{
   return \App\Models\Product::all();
  } 
 }
 
 function showcaseCount(){
  return \App\Models\Showcase::where('status',1)->count();     
 }
 
 function allProductCount(){
  return DB::select("SELECT SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS active_count, SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS inactive_count, SUM(CASE WHEN stock > 1 THEN 1 ELSE 0 END) AS in_stock, SUM(CASE WHEN stock <= 0 THEN 1 ELSE 0 END) AS out_of_stock, SUM(CASE WHEN is_eol = 1 THEN 1 ELSE 0 END) AS eol_count, SUM(CASE WHEN status = 1 THEN 1 ELSE 1 END) AS all_count FROM products");    
 }

 function productsByCategory($category_id, $is_best=0){
  $data = \App\Models\Product::where('category_id', $category_id)->where('status',1);
  if($is_best == 1){
   $data->where('is_best',1);      
  }
  $data = $data->get();
  return $data;
 }

function showImage($file,$path){
 if($file){
  $res = $path."/".$file;
 }else{
  $res = noImage();
 }
 return $res;
}

function canDelete(){
 if(!in_array(\Auth::guard('admin')->user()->type,['SUPER_ADMIN','ADMIN'])){
  if(\Auth::guard('admin')->user()->can_delete==0){
    return false;
  }else{
   return true;
  }
 }else{
  return true;
 }  
}

function canUpdate(){
 if(!in_array(\Auth::guard('admin')->user()->type,['SUPER_ADMIN','ADMIN'])){
  return false;
 }else{
  return true;
 }  
}

 function isAdmin(){
  return (Auth::guard('admin')->user()->type == "SUB_ADMIN") ? false : true; 
 }
 
 function isTicketRaised($order_detail_id){
  return \App\Models\Ticket::where('order_detail_id',$order_detail_id)->count();
 } 
 
 function ticketStatusColor($status){
  $res = "text-warning";
  if($status == "RESOLVED"){
   $res = "text-success";      
  }else if($status == "CLOSED"){
   $res = "text-danger";      
  }
  return $res;
 }

 function softwareCount($brand_id){
  return \App\Models\Software::where('brand_id',$brand_id)->count();     
 }
 
 function getOrderID($order_detail_id){
  $res = \App\Models\OrderDetail::find($order_detail_id);     
  return (!empty($res)) ? $res->order_id : "";
 }

 function coupon($id){
  return \App\Models\Coupon::find($id);
 }
 
 function coupons(){
  return \App\Models\Coupon::where('status',1)
                           ->where('expiry','>=',date('Y-m-d'))->get();
 }

 function statusBadge($status){
  if($status==0){
    $res = '<span class="badge bg-danger text-uppercase">Inactive</span>';
  }else{
    $res = '<span class="badge bg-success text-uppercase">Active</span>';
  }
  return $res;
 }

 function subscriptionBadge($status){
  if($status==0){
   $res = '<span class="badge bg-danger text-uppercase">Unsubscribed</span>';
  }else{
   $res = '<span class="badge bg-success text-uppercase">Subscribed</span>';
  }
  return $res;
 }

 function stockBadge($stock){
  if($stock > 0){
    $res = '<span class="bg-success text-uppercase custm-badge text-white">In Stock</span>';
  }else{
    $res = '<span class="bg-danger text-uppercase custm-badge text-white">Out of Stock</span>';
  }
  return $res;
 }
 
 function returnStatus($status){
  $response = '<span class="badge bg-warning text-uppercase">PENDING</span>';
  if($status == 2){
   $response = '<span class="badge bg-info text-uppercase">IN_PROCESS</span>';      
  }else if($status == 3){
   $response = '<span class="badge bg-success text-uppercase">APPROVED</span>';    
  }else if($status == 4){
   $response = '<span class="badge bg-danger text-uppercase">REJECTED</span>';  
  }
  return $response;
 }
 
 function refundStatus($status){
  $response = '<span class="badge bg-warning text-uppercase">PENDING</span>';
  if($status == 'IN_PROCESS'){
   $response = '<span class="badge bg-info text-uppercase">IN_PROCESS</span>';  
  }else if($status == 'REFUNDED'){
   $response = '<span class="badge bg-success text-uppercase">REFUNDED</span>'; 
  }
  return $response;
 }
 
 function orderStatus($status){
  $response = '<span class="badge bg-warning text-uppercase">'.$status.'</span>';
  if($status == 'DELIVERED'){
   $response = '<span class="badge bg-success text-uppercase">'.$status.'</span>'; 
  }else if($status == 'SHIPPED'){
   $response = '<span class="badge bg-primary text-uppercase">'.$status.'</span>'; 
  }else if($status == 'CANCELLED'){
   $response = '<span class="badge bg-danger text-uppercase">'.$status.'</span>'; 
  }
  return $response;
 }

 function productCategories($parent_ids){
  $i=1;
  $ids = explode(',',$parent_ids);
  $data = \App\Models\Category::whereIn('id',$ids)->get();
  $res = "";
  foreach($data as $c){
   if(COUNT($data) == $i++){
    $res .= "<a href='".url("/".$c->slug.'.htm')."'>".$c->name."</a>";
   }else{
    $res .= "<a href='".url("/".$c->slug.'.htm')."'>".$c->name."</a>, ";
   } 
  }
  return $res;
 }

 function paymentMethodDiscount($method){
  $discount = 0;
  return $discount;
  if(in_array($method, ['UPI','DIRECT_BANK_TRANSFER'])){
   $discount = (checkoutTotal() * 2) / 100;   
  }     
  return $discount;
 }

 function totalReviews($product_id){
  return \App\Models\Rating::where('product_id',$product_id)->count();
 }

 function singleUserRating($product_id,$user_id){
  $rating = \App\Models\Rating::where('product_id',$product_id)
                              ->where('user_id',$user_id)->avg('rating');
  $no_star = 5 - $rating;
  $star="";
  while($rating > 0){
   if($rating > 0.5){
    $star .= '<i class="fa fa-star" style="color:gold"></i>';
   }else{
    $star .= '<i class="fa fa-star-half-o" style="color:gold"></i>';
   } 
   $rating--;
  }
  for($i=1;$i<=$no_star;$i++){
    $star .= '<i class="fa fa-star" style="color:#ccc"></i>';  
  }
  return $star;
 }

 function starRating($product_id){
  $rating = \App\Models\Rating::where('product_id',$product_id)->avg('rating');
  $no_star = 5 - $rating;
  $star="";
  while($rating > 0){
   if($rating > 0.5){
    $star .= '<i class="fa fa-star" style="color:gold"></i>';
   }else{
    $star .= '<i class="fa fa-star-half-o" style="color:gold"></i>';
   } 
   $rating--;
  }
  for($i=1;$i<=$no_star;$i++){
    $star .= '<i class="fa fa-star" style="color:#ccc"></i>';  
  }
  return $star;
 }

 function rating($product_id){
  $rating = \App\Models\Rating::where('product_id',$product_id)->avg('rating');
  $rating = number_format($rating,1);
  return $rating;
 }

 function verifyCaptcha($request){
  $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => setting()->g_recaptcha_secret_key,
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
  ]);
  $recaptchaData = $response->json();
  return $recaptchaData['success'];
 }

 function categories($parent_id=0){
  $data = \App\Models\Category::where('parent_id',$parent_id)->orderBy('order_by')->where('status',1)->where('type','CATEGORY')->get();
  return $data;
 }
 
 function headerCategories($parent_id=0){
  $data = \App\Models\Category::where('parent_id',$parent_id)->orderBy('order_by')->where('status',1)->where('type','CATEGORY')
                  ->where('for_header',1)->limit(8)->get();
  return $data;
 }
 
 function allCategories($parent_id=0){
  $data = \App\Models\Category::orderBy('order_by')->where('status',1)->where('type','CATEGORY')
                  ->where('for_all',1)->limit(8)->get();
  return $data;
 }
 
 function adminCategories($parent_id=0){
  $data = \App\Models\Category::where('parent_id',$parent_id)->where('type','CATEGORY')->get();
  return $data;
 }
 
 function brands($parent_id=0){
  $data = \App\Models\Category::where('parent_id',$parent_id)->orderBy('order_by')->where('status',1)->where('type','BRAND')->get();
  return $data;
 }
 
 function adminBrands($parent_id=0){
  $data = \App\Models\Category::where('parent_id',$parent_id)->where('type','BRAND')->orderBy('order_by')->get();
  return $data;
 }
 
 function categoryWiseBrands($brand_ids){
  $data = \App\Models\Category::whereIn('id',explode(',',$brand_ids))->orderBy('order_by')->where('status',1)->where('type','BRAND')->get();
  return $data;       
 }

 function marketplaces($parent_id=0){
  $data = \App\Models\Marketplace::where('parent_id',$parent_id)->get();
  return $data;
 }

 function category($id){
  $data = \App\Models\Category::find($id);
  return $data;
 }

 function moreImages($product_id){
  return \App\Models\MoreImage::where('product_id',$product_id)->get();
 }
 
 function moreBanners($product_id){
  return \App\Models\MoreBanner::where('product_id',$product_id)->get();
 }

 function users(){
  $data = \App\Models\User::orderBy('name')->get();
  return $data;
 }

 function user($id=0){
  if($id!=0){
    return \App\Models\User::find($id);
  }else{
  if(\Auth::check()){
    return \App\Models\User::find(\Auth::user()->id);
  }}
 }

 function pages($show_in){
  return \App\Models\Page::where($show_in,1)->orderBy('order_by')->whereNotIn('slug',['shipping-policy','gallery','privacy-policy','terms-conditions','refund-return-policy'])->get();
 }

 function subpages($show_in){
  return \App\Models\Page::where($show_in,1)->orderBy('order_by')->whereIn('slug',['shipping-policy','gallery','privacy-policy','terms-conditions','refund-return-policy'])->get();
 }
 
 function certificates(){
  return \App\Models\Certificate::where('status',1)->orderBy('order_by')->get();
 }

 function currency(){
  return setting()->currency;
 }

 function countries(){
  return \DB::table('countries')->get();
 }

 function states($country_id){
  return \DB::table('states')->where('country_id',$country_id)->get();
 }

 function country($id){
  $data = \DB::table('countries')->where('id',$id)->first();
  return (!empty($data)) ? $data->name : "";
 }

 function countryDetail($id){
  $data = \DB::table('countries')->where('id',$id)->first();
  return (!empty($data)) ? $data : "";
 }

 function state($id){
  $data = \DB::table('states')->where('id',$id)->first();
  return (!empty($data)) ? $data->name : "";
 }


 function categoryCount(){
  return \App\Models\Category::where('type','CATEGORY')->count();
 }
 
 function brandCount(){
  return \App\Models\Category::where('type','BRAND')->count();
 }

 function defaultLocation(){
  $res = setting()->m_location;
  if(!empty(checkMarketArea(app('request')->market_area))){
    $res = "loc_name";
  }
  return $res;
 }
 
function emailMobileValidation($column,$value,$type,$user_id){
  $res = true;
  if($type == 0){
    $data = \App\Models\UserAddress::where($column,$value)->first();
    if(!empty($data)){
      if($data->user_id != $user_id){
        $res = false;
      }
    }
    
    $data2 = \App\Models\User::where($column,$value)->first();
    if(!empty($data2)){
      if($data2->id != $user_id){
        $res = false;
      }
    }
    
  }else{
    $data = \App\Models\User::where($column,$value)->first();
    if(!empty($data)){
      if($data->id != $user_id){
        $res = false;
      }
    }
    
    $data2 = \App\Models\UserAddress::where($column,$value)->first();
    if(!empty($data2)){
      if($data2->user_id != $user_id){
        $res = false;
      }
    }
    
  }
  return $res;
 }

function deleteOldCart(){
  \App\Models\Cart::whereDate('created_at', '<=', now()->subDays(30))->delete();
 }

 function cartCount(){
  $res = \App\Models\Cart::where('session_id','!=','');
  if(\Auth::check()){
   $res->where('user_id',Auth::user()->id); 
  }else{
   $res->where('session_id',cartSession()); 
  }
  return $res->count();
 }

 function wishlistCount(){
  $data = 0;
  if(\Auth::check()){
   $data = \App\Models\Wishlist::where('user_id',user()->id)->count(); 
  }
  return $data;
 }

 function productCount($category_id){
  return \App\Models\Product::where('category_id', $category_id)->count();
 }

 function cartTotal(){
  $total = 0;
  $data = cartData();
  if($data->isNotEmpty()){
   foreach($data as $row){
    $total += $row->price  * $row->quantity; 
   }}
  return $total;
}

 function couponCondition(){
  $user_coupon = \App\Models\UserCoupon::where('user_id',user()->id)->where('status','APPLIED')->first();
  if(!empty($user_coupon)){
    $coupon = \App\Models\Coupon::find($user_coupon->coupon_id);
    if(cartTotal() < $coupon->condition){
      \App\Models\UserCoupon::where('id',$user_coupon->id)->delete();
    }else{
      return $user_coupon;
    }
  }else{
    return false;
  }
 }

 function discount($id){
  $discount=0.00;   
  $product = \App\Models\Product::where('id',$id)->where('mrp','!=','')->where('price','!=','')->select('mrp','price')->first();
  if(!empty($product)){
   $discount = number_format((($product->mrp - $product->price)*100) / $product->mrp);
  } 
  return $discount;  
 }

 function couponAmount($coupon_id){
  $coupon = \App\Models\Coupon::find($coupon_id);
  $discount = ($coupon->type == "FIXED") ? $coupon->amount : (cartTotal() / 100) * $coupon->amount;
  return round($discount);
 }

 function checkoutTotal(){
  if(\Auth::check()){
   if($coupon_data = couponCondition()){
     $total = round((cartTotal() - couponAmount($coupon_data->coupon_id)));
    }else{
     $total = round(cartTotal());      
    }
  }else{
    $total = round(cartTotal());
  } 
  return $total;
 }

 function cartData(){
  $carts = \App\Models\Cart::join('products','products.id','=','carts.product_id')
        ->select('carts.*','products.id as pro_id','products.name','products.image','products.slug','products.price','products.short_content','products.sku');
  if(\Auth::check()){
    $carts->where('user_id',user()->id);
  }else{
    $carts->where('session_id',cartSession());
  } 
  $carts = $carts->get();
  return $carts;
}

 function productSEO(){
  return \App\Models\Seo::find(1);
 }

 function checkMarketArea($url){
  $data = \App\Models\Marketplace::where('slug',$url)->select('name')->first();
  $res = (!empty($data->name)) ? $data->name : "";
  return $res;
 }

 function location(){
  $market_area = checkMarketArea(app('request')->market_area);
  return (!empty($market_area)) ? $market_area : setting()->m_location;
}

function marketAreaText($text,$loc,$pro_name=''){
 $res = "";
 if(empty($pro_name)){
  $res = str_ireplace(defaultLocation(),checkMarketArea($loc),$text); 
 }else{
  $res = str_ireplace(defaultLocation(),checkMarketArea($loc),$text);
  $res = str_ireplace('pro_name', $pro_name, $res); 
 } 
 return $res;    
}

 function monthsAgo($months){
  return \Carbon\Carbon::now()->subMonths($months);   
 }

 function logHistory($action, $action_by_id, $action_by, $action_on, $action_title){
  \App\Models\Log::insert(['action'=>$action, 'action_by_id'=>$action_by_id, 'action_by'=>$action_by, 'action_on'=>$action_on, 'action_title'=>$action_title, 'created_at'=>date('Y-m-d H:i:s')]);     
 }

 function attributes($product_id){
  return \App\Models\ProductAttribute::where('product_id',$product_id)->get();
 }

 function categoryURL($slug){
  $market_area = \Str::slug(checkMarketArea(app('request')->market_area));  
  $url = $market_area."/".$slug.".htm";
  return $url;
 }
 
 function productURL($slug){
  $market_area = \Str::slug(checkMarketArea(app('request')->market_area));  
  $url = $market_area."/".$slug.".html";
  return $url;
 }

 function urlExist($table,$slug){
  return \DB::table($table)->where('slug',$slug)->where('status',1)->count();
 }
 
function updateCart($product_id){
 $stock = App\Models\Product::find($product_id,['stock']);
 if($stock->stock == 0){
 //REMOVE ALL CART RELATED TO THIS PRODUCT
  \App\Models\Cart::where('product_id',$product_id)->delete();
 }else{
  \App\Models\Cart::where('product_id',$product_id)->where('quantity','>',$stock->stock)->delete();   
 }
}

 function generateSession(){
  if(!Session::has('cart_session_id')){
    Session::put('cart_session_id',substr(str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789'),0,20));
  }
 }

 function cartSession(){
  return Session::get('cart_session_id');
 }

 function shippingAddress($user_id){
  return \App\Models\UserAddress::where('user_id',$user_id)->first();
 }

 function isInvoice($order_id){
  return \App\Models\Invoice::where('order_id',$order_id)->count();
 }

 function totalOrderItems($order_id){
  return \App\Models\OrderDetail::where('order_id',$order_id)->count();
 }

 function orderSum($search_keyword='',$type='',$status='',$from='',$to=''){
  $total = 0;
    
    $data = App\Models\Order::latest()
                            ->where('delivery_status','!=','CANCELLED');
    if(!empty($search_keyword)){
     if(strpos($search_keyword,'#') !== false){
      $data->where('id',str_replace('#','',$search_keyword));
     }else{ 
      $data->where(function($q) use($search_keyword){
        $q->where('name','LIKE','%'.$search_keyword.'%')
          ->orWhere('email','LIKE','%'.$search_keyword.'%')
          ->orWhere('mobile','LIKE','%'.$search_keyword.'%');
      });
     }
    }
    if(!empty($from) && !empty($to)){
      $data->whereRaw('DATE(created_at) >= '."'$from'")
           ->whereRaw('DATE(created_at) <= '."'$to'");
    }
    if(!empty($type)){
      $data->where('type',$type);
    }
    if(!empty($status)){
      if(in_array($status,['PAID','UNPAID'])){
        $data->where('payment_status',$status);
      }else{
        $data->where('delivery_status',$status);
      }
    }

    $total = $data->sum('net_amount');
    return $total;
 }

 function checkRoles($role){
  $accessibility = "";
  if(\Auth::guard('admin')->user()->type!="SUPER_ADMIN"){
   $admin_roles=explode(',',\Auth::guard('admin')->user()->roles);
   $accessibility = (in_array($role,$admin_roles)) ? : "hide-item";
  }
  return $accessibility;
 }

 function checkMultipleRoles($roles){
  $accessibility = "";
  if(\Auth::guard('admin')->user()->type!="SUPER_ADMIN"){
   $accessibility = "hide-item"; 
   $roles_array = explode(',',$roles);  
   $admin_roles=explode(',',\Auth::guard('admin')->user()->roles);
   for($i=0;$i<COUNT($roles_array);$i++){
    if(in_array($roles_array[$i],$admin_roles)){
     $accessibility = "";
    }
   }  
  }
  return $accessibility;
 }


 // GET NEXT GENERATED ID 
 function getNextID($table){
  $statement = \DB::select("show table status like '$table' ");
  return $statement[0]->Auto_increment;
 }

 function generateInvoiceNo(){
  return "CMPL/".date('y').'/'.getNextID('invoices');
 }

function reverseSlug($string){
 return ucwords(str_ireplace(["-","_"]," ",$string)); 
}

 function checkPincode($pincode){
  $check = \App\Models\Location::where('pincode',$pincode)
                      ->where('status',1)->count();
  return ($check > 0) ? 1 : 0;   
 }

 function numFormat($number) {
  $number = (int) preg_replace('/[^0-9]/', '', $number);
   if ($number >= 1000) {
     $rn = round($number);
     $format_number = number_format($rn);
     $ar_nbr = explode(',', $format_number);
     $x_parts = array('K', 'M', 'B', 'T', 'Q');
     $x_count_parts = count($ar_nbr) - 1;
     $dn = $ar_nbr[0] . ((int) $ar_nbr[1][0] !== 0 ? '.' . $ar_nbr[1][0] : '');
     $dn .= $x_parts[$x_count_parts - 1];
     return $dn;
    }
   return $number;
 }
 
 function lastWeekDates(){
  $last_week_dates = array();     
  $previous_week_date = date('Y-m-d',strtotime('-1 week'));
  for($i = 1; $i <= 7; $i++){
   $last_week_dates [] = date('Y-m-d',strtotime($previous_week_date.'+'.$i."days"));
  }
  return $last_week_dates;
 }
  
 function lastMonthDates(){
  $last_month_dates = array();     
  $previous_month_date = date('Y-m-d',strtotime('-1 month'));
  for($i = 1; $i <= 30; $i++){
   $last_month_dates [] = date('Y-m-d',strtotime($previous_month_date.'+'.$i."days"));
  }
  return $last_month_dates;
 } 
 
 function lastYearMonths(){
  $last_year_months = array();     
  $previous_year_month = date('Y-m-d',strtotime('-365 days'));
  for($i = 1; $i <= 365; $i++){
   $last_year_months [] = date('Y-m-d',strtotime($previous_year_month.'+'.$i."days"));
  }
  return $last_year_months;
 } 