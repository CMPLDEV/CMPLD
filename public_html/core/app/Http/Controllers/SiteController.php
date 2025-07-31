<?php
namespace App\Http\Controllers;

use DB;
use Session;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Offer;
use App\Models\Slider;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Category;
use App\Models\Software;
use App\Models\MoreImage;
use App\Models\OurClient;
use App\Models\OurPartner;
use App\Models\MoreBanner;
use App\Models\Testimonial;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\ProductOffer;
use App\Models\OurAssociates;
use App\Models\IdentifyProduct;
use App\Models\ProductAttribute;
use App\Models\CategoryAttribute;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\SubscriptionController;

class SiteController extends Controller{
  
  protected $route_name;
  public function __construct(Request $req){
   $this->route_name = $req->route()->getName();
  }

  public function index(Request $req){
   $blog_i = 0;
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $heading = $page->default_heading;

   $slider = Slider::where('status',1)->orderBy('order_by')->get();
   $blogs = Blog::where('status',1)->orderBy('order_by')->limit(4)->get();
   $categories = Category::where('status',1)->where('for_home',1)->where('type','CATEGORY')->get();
   $best_categories = Category::where('status',1)->where('is_best',1)
                               ->where('type','CATEGORY')->get();
   $best_products = Product::where('status',1)->orderBy('order_by')->where('is_best',1)->get();
   $featured_products = Product::where('status',1)->orderBy('order_by')->where('is_featured',1)->limit(16)->get();
   $brands = Category::where('status',1)->where('for_home',1)->where('type','BRAND')->get();
    
   $offers = Offer::where('status',1)->orderBy('order_by')->get();
   $testimonials = Testimonial::where('status',1)->orderBy('order_by')->get();
   
   $our_clients = OurClient::where('status', 1)->get();
   $our_partners = OurPartner::where('status', 1)->get();
   $our_associates = OurAssociates::where('status', 1)->get();
    
   return view('index',compact('page','meta_title','meta_description','meta_keywords','blogs','blog_i','heading','slider','categories','best_products','featured_products','brands','best_categories','offers','testimonials','our_clients','our_partners','our_associates'));
  }

  public function aboutUs(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('about-us',compact('page','meta_title','meta_description','meta_keywords'));
  }
  
  public function faq(){
   $i = 1;      
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $data = Faq::where('status',1)->orderBy('order_by')->paginate(30);
   return view('faq',compact('page','meta_title','meta_description','meta_keywords','data','i'));
  }

  public function gallery(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $data = Gallery::where('status',1)->orderBy('order_by')->paginate(10);
   return view('gallery',compact('page','meta_title','meta_description','meta_keywords','data'));
  }

  public function contactUs(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('contact-us',compact('page','meta_title','meta_description','meta_keywords'));
  }
  
  public function privacyPolicy(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('privacy-policy',compact('page','meta_title','meta_description','meta_keywords'));
  }
  
  public function shippingPolicy(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('shipping-policy',compact('page','meta_title','meta_description','meta_keywords'));
  }
  
  public function refundReturnPolicy(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('refund-return-policy',compact('page','meta_title','meta_description','meta_keywords'));
  }

  public function termsConditions(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('terms-condition',compact('page','meta_title','meta_description','meta_keywords'));
  }

  public function marketArea(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('market-area',compact('page','meta_title','meta_description','meta_keywords'));
  }
  
  public function sitemap(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $pages = Page::where('status',1)->orderBy('order_by')->get();
   $blogs = Blog::where('status',1)->orderBy('order_by')->get();
   $products = Product::where('status',1)->orderBy('order_by')->paginate(100);
   $i = $products->perPage() * ($products->currentPage() - 1);
   return view('sitemap',compact('page','meta_title','meta_description','meta_keywords','pages','products','blogs','i'));
  }
  
  public function ourClient(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $data = OurClient::where('status',1)->get();
   return view('our-client',compact('page','meta_title','meta_description','meta_keywords','data'));
  }
  
  public function ourPartner(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $data = OurPartner::where('status',1)->get();
   return view('our-partner',compact('page','meta_title','meta_description','meta_keywords','data'));
  }

  public function blog(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $data = Blog::where('status',1)->orderBy('order_by')->paginate(10);
   $products = Product::where('status',1)->orderBy('order_by')->where('is_featured',1)->limit(6)->get();
   return view('blog',compact('page','meta_title','meta_description','meta_keywords','data','products'));
  }

  public function blogDetail(Request $req){
   if(urlExist('blogs',$req->slug)==0){return redirect('/');}  
    $row = Blog::where('slug',$req->slug)->first();
    $blogs = Blog::where('status',1)->where('id','!=',$row->id)->latest()->limit(5)->get();
    $meta_title = $row->meta_title;
    $meta_description = $row->meta_description;
    $meta_keywords = $row->meta_keywords;
    return view('blog-detail',compact('blogs','meta_title','meta_description','meta_keywords','row'));
  }
  
  public function giftOffer(Request $req){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $offers = Offer::latest()->paginate(50);
   return view('gift-offer', compact('page','meta_title','meta_description','meta_keywords','offers'));      
  }

  public function support(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $news = Blog::where('is_news',1)->paginate(10);
   return view('support',compact('page','meta_title','meta_description','meta_keywords','news'));
  }
  
  public function softwareDriver(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $brands = Category::where('type','BRAND')->where('status',1)
                     ->where('show_support',1)->get();
   return view('software-driver',compact('page','meta_title','meta_description','meta_keywords','brands'));   
  }
  
  public function warranty(){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   return view('warranty',compact('page','meta_title','meta_description','meta_keywords'));  
  }

   public function brandDetail(Request $req){
    if(urlExist('categories',$req->slug)==0){return redirect('/');}  
    $data = Category::where('slug',$req->slug)->first();
    $softwares = Software::where('brand_id',$data->id)->get();
    $meta_title = $data->meta_title;
    $meta_description = $data->meta_description;
    $meta_keywords = $data->meta_keywords;
    return view('brand-detail',compact('data','meta_title','meta_description','meta_keywords','softwares'));     
   }    

  public function categories(Request $req){
   $page = Page::where('slug',$this->route_name)->first();
   $meta_title = $page->meta_title;
   $meta_description = $page->meta_description;
   $meta_keywords = $page->meta_keywords;
   $banner = (!empty($page->banner)) ? setting()->website_url."/uploaded_files/page/".$page->banner : "";
   return view('categories',compact('page','meta_title','meta_description','meta_keywords','banner'));
  }

  public function categoryWiseBrand(Request $req){
   if(urlExist('categories',$req->category_slug)==0){return redirect('/');}
   if(urlExist('categories',$req->brand_slug)==0){return redirect('/');}
    $category = Category::where('slug',$req->category_slug)->first();
    $brand = Category::where('slug',$req->brand_slug)->first();
    $content = $brand->content;
    $meta_title = $brand->meta_title;
    $meta_description = $brand->meta_description;
    $meta_keywords = $brand->meta_keywords;

    $page_title = $brand->name;
    $type = "brand";
    $type_value = [$category->id,$brand->id];
    $type_value = implode(',',$type_value);
    $sort_by = "";
    $category_id = "";
    $banner = (!empty($data->banner)) ? setting()->website_url."/uploaded_files/category/".$data->banner : "";
    
    return view('product',compact('meta_title','meta_description','meta_keywords','page_title','type','type_value','sort_by','category_id','banner'));   
  }
 
  public function products(Request $req){
    if(urlExist('categories',$req->slug)==0){return redirect('/');}
    $data = Category::where('slug',$req->slug)->first();
    $content = $data->content;
    $meta_title = $data->meta_title;
    $meta_description = $data->meta_description;
    $meta_keywords = $data->meta_keywords;

    $page_title = $data->name;
    $type = "category";
    $type_value = $data->id;
    $sort_by = "";
    $category_id = "";
    
    $filters = CategoryAttribute::where('category_id',$data->id)->get();
    
    $banner = (!empty($data->banner)) ? setting()->website_url."/uploaded_files/category/".$data->banner : "";
    
    return view('product',compact('data','meta_title','meta_description','meta_keywords','page_title','type','type_value','sort_by','banner','filters','category_id'));  
  }

  public function allProducts(Request $req){
    $page = Page::where('slug',$this->route_name)->first();
    $meta_title = $page->meta_title;
    $meta_description = $page->meta_description;
    $meta_keywords = $page->meta_keywords;

    $page_title = $page->name;
    $type = "all";
    $type_value = "";
    $sort_by = "";
    $category_id = "";
    
    $banner = (!empty($page->banner)) ? setting()->website_url."/uploaded_files/page/".$page->banner : "";
    
    return view('product',compact('meta_title','meta_description','meta_keywords','page_title','type','type_value','sort_by','category_id','banner'));  
  }

  public function productDetail(Request $req){
    if(urlExist('products',$req->slug)==0){return redirect('/');}
     $data = Product::where('slug',$req->slug)->first();
     $meta_title = $data->meta_title;
     $meta_description = $data->meta_description;
     $meta_keywords = $data->meta_keywords;
     $content = $data->content;

     $related = Product::where('status',1)->where('id','!=',$data->id)
                       ->where('category_id', $data->category_id)
                       ->latest()->limit(10)->get();
    $q = 1;
    $more_images = MoreImage::where('product_id',$data->id)->get();
    $more_banners = MoreBanner::where('product_id',$data->id)->get();
    $ratings = Rating::join('products','products.id','=','ratings.product_id')
                     ->select('ratings.*','products.id as pro_id')
                     ->where('ratings.product_id',$data->id)->limit(3)->get();
    $attributes = ProductAttribute::where('product_id',$data->id)
                                  ->where('value','!=','none')->get();
    $product_offers = ProductOffer::where('product_id',$data->id)->get();
    return view('product-detail',compact('data','content','meta_title','meta_description','meta_keywords','related','more_images','q','ratings','more_banners','attributes','product_offers'));   
  }

  public function submitEnquiry(Request $req){
   $req->validate(['name'=>'required|max:100','email'=>'required|email|max:255',
                   'mobile'=>'required|numeric','message'=>'required|max:255',
                   'g-recaptcha-response' => 'required'
                  ],
                  ['g-recaptcha-response.required' => 'Please verify that you are not a robot.',]);
   if(!verifyCaptcha($req)){
    return back()->withErrors(['g-recaptcha-response' => 'ReCAPTCHA verification failed. Please try again.']);       
   }                                
   $name = $req->name;
   $email = $req->email;
   $mobile = '+'.countryDetail($req->country)->phonecode.'-'.$req->mobile;
   $subject = $req->subject;
   $source = $req->source;
   $message = $req->message;                
    
   $data = new EnquiryController();
   $data->name = $name;
   $data->email = $email;
   $data->mobile = $mobile;
   $data->subject = $subject;
   $data->source = $source;
   $data->message = $message; 
   $data->is_mail = true;
   $data->saveEnquiry();
    
   return back()->with('message','success|Enquiry submitted.');               
  }

  public function search(Request $req){
    $req->validate(['search_keyword'=>'required']);
    $search_keyword = $req->search_keyword;
    $meta_title = "Search result for ".$search_keyword;
    $meta_description = "Search result for ".$search_keyword;
    $meta_keywords = "Search result for ".$search_keyword;

    $page_title = "Search result for ".$search_keyword;
    $type = "search";
    $type_value = $search_keyword;
    $sort_by = "";
    $category_id = $req->category_id;
    $banner = "";
    return view('product',compact('meta_title','meta_description','meta_keywords','page_title','type','type_value','sort_by','search_keyword','category_id','banner'));
  }

  public function compare(){
   $is_data = 0;
   $data = '';
    if(Session::has('compare')){
     $compare_array = Session::get('compare');
     if(COUNT($compare_array) > 0){ 
      $data = Product::whereIn('id',$compare_array)->get();
      $is_data = 1; 
    }}
    return view('compare',compact('data','is_data'));
  }

  public function removeCompare(Request $req){
   if(Session::has('compare')){
    $product_id = $req->id;
    $compare_array = Session::get('compare');
    print_r($compare_array);
    
    $key = array_search($product_id, $compare_array, true);
    if($key !== false) {
     unset($compare_array[$key]);
     Session::forget('compare');
     Session::put('compare',$compare_array);
    }
   }
   return back()->with('message','success|Product removed from compare list');
  }
  
  public function supportSearch(Request $req){
   $product = "";
   $warranty_left = "";
   $req->validate(['serial_no'=>'required']);  
   $meta_title = setting()->comp_name." - Support";
   $meta_description = setting()->comp_name." - Support";
   $meta_keywords = setting()->comp_name." - Support";
   $data = IdentifyProduct::where('serial_no',$req->serial_no)->first();
   
   if(!empty($data) && !empty($data->warranty_end_date)){
    $seconds_difference = strtotime($data->warranty_end_date) - strtotime(date('Y-m-d'));  
    $days_difference = floor($seconds_difference / (24 * 60 * 60));
    $warranty_left = ($days_difference > 0) ? $days_difference." day(s)" : "Expired";
    $product = Product::join('categories','categories.id','=','products.category_id')->where('asin',$data->asin)->select('products.name','products.image','products.slug','products.sku','categories.name as category_name')->first();   
   }
   return view('support-search',compact('data','meta_title','meta_description','meta_keywords','warranty_left','product'));
  }

  public function sendSubscriptionVerificationRequest(Request $req){
    $is_exist = Subscription::where('email',$req->email)->count();
    if($is_exist == 0){
      $data = new SubscriptionController();
      $data->email = $req->email;
      $data->sendVerificationRequest();
      return true;
    }else{
      return false;
    }
  }

  public function subscriptionVerification(Request $req){
    $email = base64_decode($req->email);
    $token = base64_decode($req->token);
    $verify = DB::table('password_resets')->where('email',$email)->where('token',$token)->count(); 
    if($verify){
      $data = new SubscriptionController();
      $data->email = $email;
      $data->saveSubscription();
      $data->sendMail();
      DB::table('password_resets')->where('email',$email)
                                  ->where('token',$token)->delete();
      return redirect()->route('home')
                       ->with('message','success|Verified successfully.');
    }

     DB::table('password_resets')->where('email',$email)
                                 ->orWhere('token',$token)->delete();
     return redirect()->route('home')
                      ->with('message','error|Somethin went wrong.');
  }

  public function unsubscribe(Request $req){
   $email = base64_decode($req->email);
   $is_exist = Subscription::where('email',$email)->count();
   if($is_exist){
    Subscription::where('email',$email)->update(['status'=>0]);  
    return redirect()->route('home')->with('message','success|Unsubscribed Successfully.');
   }
   return redirect()->route('home')->with('message','error|Email address is invalid.');
  }
  
  public function productReview(Request $req){
   $product = Product::find($req->id);   
   if(empty($product)){
    return redirect()->route('home')
                     ->with('message','error|Something went wrong.');   
   }
   $meta_title = $product->meta_title;
   $meta_description = $product->meta_description;
   $meta_keywords = $product->meta_keywords;
   $ratings = Rating::join('products','products.id','=','ratings.product_id')
                     ->select('ratings.*','products.id as pro_id')
                     ->where('ratings.product_id',$product->id)->paginate(10);
   return view('product-review', compact('product','meta_title','meta_description','meta_keywords','ratings'));
  }
  
  public function buyWithConfidence(){
   $meta_title = "Buy With Confidence | ".setting()->comp_name;
   $meta_description = "Buy With Confidence | ".setting()->comp_name;
   $meta_keywords = "Buy With Confidence | ".setting()->comp_name;
   return view('buy-with-confidence', compact('meta_title','meta_description','meta_keywords'));      
  }
  
  public function viewCertificate(Request $req){
   $data = Certificate::where('slug',$req->certificate)->first();
   if(empty($data)){
    return redirect()->route('home');   
   }
   $certificate = $data->pdf;
   $meta_title = "Buy With Confidence | ".setting()->comp_name;
   $meta_description = "Buy With Confidence | ".setting()->comp_name;
   $meta_keywords = "Buy With Confidence | ".setting()->comp_name;
   return view('buy-with-confidence-detail', compact('meta_title','meta_description','meta_keywords','certificate'));      
  }
    
}
