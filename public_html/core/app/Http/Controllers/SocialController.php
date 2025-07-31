<?php
 namespace App\Http\Controllers;
 
 use Auth;
 use Session;
 use Socialite;
 use App\Models\Cart;
 use App\Models\User;
 use Illuminate\Http\Request;
 
 class SocialController extends Controller{
  
  public function redirect($provider){
   return Socialite::driver($provider)->redirect();         
  }
  
  public function callback($provider){
   try{
    $get_info = Socialite::driver($provider)->stateless()->user();
    $user = $this->createUser($get_info, $provider);
    Auth::login($user);
    // SWITCH TO USER ID FROM SESSION ID
    Cart::where('session_id',cartSession())->update(['user_id'=>$user->id]);
    Session()->forget('cart_session_id');
    return redirect()->route('userpanel');    
   }catch(\Exception $e){
    //echo $e->getMessage();
    return redirect()->route('userpanel');   
   }      
   
  }
  
  public function createUser($get_info, $provider){
   $user = User::latest();
   if($provider == "google"){
    $user = $user->where('email', $get_info->email);
    $fname = $get_info->user['given_name'];
    $lname = $get_info->user['family_name'];
   }else{
    $user = $user->where('provider_id', $get_info->id);
    $fname = $get_info->name;
    $lname = "";
   }
   $user = $user->first();
   if(empty($user)){
    $name = (empty($lname)) ? $fname : $fname.' '.$lname;   
    $user = User::create([
        'name' => $name,
        'email' => $get_info->email,
        'provider' => $provider,
        'provider_id' => $get_info->id
    ]);       
   }
   return $user;
  }
       
 }