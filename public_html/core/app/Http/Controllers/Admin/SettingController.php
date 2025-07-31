<?php
namespace App\Http\Controllers\Admin;

use Auth;
use Hash;
use App\Models\Seo;
use App\Models\Admin;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller{
    
  public function __construct(){
   $this->middleware('auth:admin');
  }

  public function index(){
   $data = Setting::findOrFail(1);
   return view('admin.setting',compact('data'));  
  }

   public function updateSetting(Request $req){
    $req->validate(['comp_name'=>'required',
          'website_url'=>'required|url',
          'email'=>'required|email',
          'logo'=>'nullable|image|mimes:jpg,png,jpeg,webp|max:400',
          'favicon'=>'nullable|image|mimes:jpg,png,jpeg,webp|max:100',
          'facebook'=>'nullable|url', 'twitter'=>'nullable|url', 
          'linkedin'=>'nullable|url', 'instagram'=>'nullable|url', 
          'youtube'=>'nullable|url', 'notification'=>'nullable|max:255'
        ],
        ['comp_name.required' => 'Company name required.']); 
    $setting = Setting::findOrFail(1);
    $logo = $setting->logo;
    if($req->hasFile('logo')){
     @unlink('uploaded_files/logo/'.$logo);
     $logo_file = $req->file('logo');
     $logo = rand(1111,9999).".".$logo_file->getClientOriginalExtension();
     $path = public_path("/uploaded_files/logo");
     $logo_file->move($path,$logo);
     $setting->logo = $logo;
    }
    
    $favicon = $setting->favicon;
    if($req->hasFile('favicon')){
     @unlink('uploaded_files/favicon/'.$favicon);
     $favicon_file = $req->file('favicon');
     $favicon = rand(1111,9999).".".$favicon_file->getClientOriginalExtension();
     $path = public_path("/uploaded_files/favicon");
     $favicon_file->move($path,$favicon);
     $setting->favicon = $favicon;
    }
      
     $setting->comp_name = $req->comp_name;
     $setting->email = $req->email;
     $setting->alt_email = $req->alt_email;
     $setting->mobile = $req->mobile;
     $setting->whatsapp = $req->whatsapp;
     $setting->phone = $req->phone;
     $setting->website_url = $req->website_url;
     $setting->address = $req->address;
     $setting->city = $req->city;
     $setting->pincode = $req->pincode;
     $setting->country = $req->country;
     $setting->state = $req->state;
     $setting->facebook = $req->facebook;
     $setting->twitter = $req->twitter;
     $setting->linkedin = $req->linkedin;
     $setting->instagram = $req->instagram;
     $setting->youtube = $req->youtube;
     $setting->m_location = $req->m_location;
     $setting->map = $req->map;
     $setting->currency = $req->currency;
     $setting->notification = $req->notification;
     $setting->footer_content = $req->footer_content;
     $setting->update();  
     return back()->with('message','success|Settings updated successfully.');
   }

   public function removeImage(Request $req){
    $img_type = $req->img_type;
    $path = "uploaded_files/".$img_type."/";
    $setting = Setting::findOrFail(1);
    @unlink($path.$setting->$img_type);
    $setting->$img_type = "";
    $setting->update();
    return back();
   }
   
   public function advanceSetting(){
    $data = Setting::findOrFail(1);
    return view('admin.advance-setting',compact('data'));  
   }
   
   public function updateAdvanceSetting(Request $req){
    $setting = Setting::findOrFail(1);
    $setting->g_recaptcha_site_key = $req->g_recaptcha_site_key;
    $setting->g_recaptcha_secret_key = $req->g_recaptcha_secret_key;
    $setting->meta_robots = (isset($req->meta_robots)) ? 1 : 0;
    $setting->site_verification = $req->site_verification;
    $setting->analytics = $req->analytics;
    $setting->site_schema = $req->site_schema;
    $setting->update();
    file_put_contents("robots.txt",$req->robotstxt);
    return back()->with('message','success|Updated successfully.');
   }

   public function productSEO(){
    $data = Seo::find(1);
    return view('admin.product-seo',compact('data'));
   }

   public function updateProductSEO(Request $req){
    $req->validate(['content'=>'required','meta_title'=>'required|max:255','meta_description'=>'required|max:255',
                    'meta_keywords'=>'required|max:255']);
    $id = $req->id;                
    $data = ($id==0) ? new Seo() : Seo::find($id);
    $data->content = $req->content;
    $data->meta_title = $req->meta_title;
    $data->meta_description = $req->meta_description;
    $data->meta_keywords = $req->meta_keywords;  
    ($id==0) ? $data->save() : $data->update();
    return back()->with('message','success|Updated successfully.');              
   }

   public function subadmins(){
    $data = Admin::whereNotIn('type',['SUPER_ADMIN','VENDOR'])->orderBy('type');
    if(Auth::guard('admin')->user()->type!="SUPER_ADMIN"){
     $data->where('type','!=','ADMIN'); 
    }
     $data = $data->paginate(50);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.subadmin',compact('data','i'));
   }

   public function updateStatus(Request $req){
    Admin::where('id', $req->id)->update(['status' => $req->status]);
    return back()->with('message','success|Status changed.');
   }

   public function addSubadmin(Request $req){
    $flag=0;
    $id=0;
    $login_user_roles = explode(',',Auth::guard('admin')->user()->roles);
    if(Auth::guard('admin')->user()->type=="SUPER_ADMIN"){
     $check = Admin::where('type','ADMIN')->count();
     if($check==0){
      $flag=1;
     } 
    }
     if(!empty($req->id)){
      if(Auth::guard('admin')->user()->type=="SUPER_ADMIN"){
       $check = Admin::where('type','ADMIN')->where('id',$req->id)->count();
        if($check==1){
         $flag=1;
        } 
       }
      $id = $req->id;
      $edit = Admin::findOrFail($req->id);
      $roles = explode(',',$edit->roles);
      $login_user_roles = explode(',',Auth::guard('admin')->user()->roles);
     return view('admin.modal.subadmin.addedit-subadmin',compact('flag','edit','roles','login_user_roles','id'));
    }
    return view('admin.modal.subadmin.addedit-subadmin',compact('flag','id','login_user_roles'));  
   }

   public function createSubadmin(Request $req){
    $validator = Validator::make($req->all(), [
     'name' => ['required', 'string', 'max:255'],
     'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
     'mobile' => ['required', 'numeric'],
     'password' => ['required'],
     'roles' => ['required'],
    ]);
    if($validator->fails()){
     return response()->json(['error'=>$validator->errors()],201);     
    }
      
    $can_delete = (isset($req->can_delete)) ? '1' : '0';
  
    $data = new Admin();
    $data->name = $req->name;
    $data->email = $req->email;
    $data->mobile = $req->mobile;
    $data->type = $req->type;
    $data->password = Hash::make($req->password);
    $data->roles = implode(',',$req->roles);
    $data->can_delete = $can_delete;
    $data->category_ids = (isset($req->category_ids)) ? implode(',',$req->category_ids) : "";
    $data->brand_ids = (isset($req->brand_ids)) ? implode(',',$req->brand_ids) : "";
    $data->save(); 
    return response()->json(['success'=>"Created successfully"],200);
   }

    public function updateSubadmin(Request $req){
     $validator = Validator::make($req->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,'.$req->id],
      'mobile' => ['required', 'numeric'],
      'roles' => ['required'],
     ]);
     if($validator->fails()){
      return response()->json(['error'=>$validator->errors()],201);     
     }
      
     $can_delete = (isset($req->can_delete)) ? '1' : '0';  
  
     $data = Admin::findOrFail($req->id);
     $data->name = $req->name;
     $data->email = $req->email;
     $data->mobile = $req->mobile;
     $data->type = $req->type;
     $data->roles = implode(',',$req->roles);
     $data->can_delete = $can_delete;
     $data->category_ids = (isset($req->category_ids)) ? implode(',',$req->category_ids) : "";
     $data->brand_ids = (isset($req->brand_ids)) ? implode(',',$req->brand_ids) : "";
     $data->update(); 
     return response()->json(['success'=>"Updated successfully"],200);
    }

    public function changeSubadminPassword(Request $request){
     //GET OLD PASSWORD FROM DB
     $admin_pass = Admin::findOrFail($request->id);
     $old_pass = $admin_pass->password;
     if($request->new_password!=$request->confirm_password)
      {echo 5;}
     else{
      Admin::where("id",$request->id)->update(["password" => Hash::make($request->new_password)]);
       echo 6;
     }
    }

    public function roles(Request $req){
     $user = Admin::find($req->id);
     $roles = explode(',',$user->roles);
     $roles_list="";
     if(in_array('1',$roles)){
      $roles_list.="# Settings";  
     }if(in_array('2',$roles)){
      $roles_list.="<br> # Manage Sub Admin";  
     }if(in_array('3',$roles)){
      $roles_list.="<br> # Change Password";  
     }if(in_array('4',$roles)){
      $roles_list.="<br> # Manage User";  
     }if(in_array('5',$roles)){
      $roles_list.="<br> # Manage Category";  
     }if(in_array('6',$roles)){
      $roles_list.="<br> # Manage Product";  
     }if(in_array('7',$roles)){
      $roles_list.="<br> # Manage Pages";  
     }if(in_array('8',$roles)){
      $roles_list.="<br> # Manage Slider";  
     }if(in_array('9',$roles)){
      $roles_list.="<br> # Manage Blog";  
     }if(in_array('10',$roles)){
      $roles_list.="<br> # Manage Marketplace";  
     }if(in_array('11',$roles)){
      $roles_list.="<br> # Product SEO";  
     }if(in_array('12',$roles)){
      $roles_list.="<br> # Manage Enquiry";  
     }if(in_array('13',$roles)){
      $roles_list.="<br> # Manage Coupon";  
     }if(in_array('14',$roles)){
      $roles_list.="<br> # Manage Order";  
     }if(in_array('15',$roles)){
      $roles_list.="<br> # Manage Newsletter";  
     }if(in_array('16',$roles)){
      $roles_list.="<br> # Advance Setting";  
     }if(in_array('17',$roles)){
      $roles_list.="<br> # Manage Gallery";  
     }if(in_array('18',$roles)){
      $roles_list.="<br> # Manage Ticket";  
     }if(in_array('19',$roles)){
      $roles_list.="<br> # Identify Product";  
     }if(in_array('20',$roles)){
      $roles_list.="<br> # Product Negotiation";  
     }if(in_array('21',$roles)){
      $roles_list.="<br> # Our Client";  
     }if(in_array('22',$roles)){
      $roles_list.="<br> # Our Partner";  
     }if(in_array('23',$roles)){
      $roles_list.="<br> # Manage Offer";  
     }if(in_array('24',$roles)){
      $roles_list.="<br> # Product Review";  
     }if(in_array('25',$roles)){
      $roles_list.="<br> # Location Pincode";  
     }if(in_array('26',$roles)){
      $roles_list.="<br> # Manage Testimonial";  
     }if(in_array('27',$roles)){
      $roles_list.="<br> # Return & Refund";  
     }if(in_array('28',$roles)){
      $roles_list.="<br> # Our Associates";  
     }if(in_array('29',$roles)){
      $roles_list.="<br> # Manage Showcase";  
     }if(in_array('30',$roles)){
      $roles_list.="<br> # Manage FAQ";  
     }if(in_array('31',$roles)){
      $roles_list.="<br> # Log History";  
     }if(in_array('32',$roles)){
      $roles_list.="<br> # Certificates";  
     }
     return $roles_list;
    }

    public function deleteSubadmin(Request $request){
     Admin::findOrFail($request->id)->delete();    
    }

    public function searchSubadmin(Request $req){
      $req->validate(['search_keyword'=>'required']);
      $search_keyword = $req->search_keyword;
      $data = Admin::whereNotIn('type',['SUPER_ADMIN','VENDOR']);
      if(Auth::guard('admin')->user()->type!="SUPER_ADMIN"){
       $data->where('type','!=','ADMIN'); 
      }
      $data->where(function($q) use($search_keyword){
        $q->where('name','LIKE','%'.$search_keyword.'%')
          ->OrWhere('email','LIKE','%'.$search_keyword.'%')
          ->OrWhere('mobile','LIKE','%'.$search_keyword.'%');
      });
      $data = $data->paginate(50);
      $i = $data->perPage() * ( $data->currentPage() - 1);
      return view('admin.subadmin',compact('data','search_keyword','i'));
    }

    public function profile(Request $request){
     $profile = Admin::findOrFail(Auth::guard('admin')->user()->id);     
     return view('admin.modal.subadmin.profile',compact('profile'));  
    }
  
    public function updateProfile(Request $request){
     $profile = Admin::findOrFail(Auth::guard('admin')->user()->id);     
     $request->validate(['name'=>'required','pic'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:200']);  
     $pic = $profile->pic;
     if($request->hasFile('pic')){
      $pic_image = $request->file('pic');
      $pic = rand(100000,900000).".".$pic_image->getClientOriginalExtension();
      $path = public_path('/uploaded_files/profile');
      if(is_dir($path)==false){ mkdir($path); }
       
      $pic_image->move($path,$pic);
     }
     $profile->name = $request->name;
     $profile->pic = $pic;
     $profile->update();
     return back()->with('message','success|Profile updated successfully.');
    }
  
    public function removePic(Request $request){
     $profile = Admin::findOrFail(Auth::guard('admin')->user()->id);     
     @unlink("uploaded_files/profile/".$profile->pic);
     Admin::where('id',$profile->id)->update(['pic'=>'']);
     return back()->with('message','success|Profile picture removed.');
    }

    public function changePasswordForm(){
     return view('admin.change-password');
    }

    public function changePassword(Request $request){
     $id=Auth::guard('admin')->user()->id;
     $pass=Auth::guard('admin')->user()->password;

     $request->validate([
      'old_password' => ['required','string','min:6'],
      'new_password' =>  ['required','string','min:6'],
      'confirm_password' =>  ['required','string','min:6','same:new_password']
     ]);

     if(!Hash::check($request->old_password,$pass)){
      return back()->with('message','error|Old password is invalid.');
     }else{
      Admin::where("id",$id)->update(['password' => Hash::make($request->new_password)]);
      return back()->with('message','success|Password updated successfully.');
     }
    }

    public function showPerPage(Request $req){
     $data = setting();
     $column = $req->column;
     $per_page = $req->per_page;
     $data->$column = $per_page;
     $data->update();
     return true; 
    }

}
