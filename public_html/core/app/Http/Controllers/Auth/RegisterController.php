<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
      return Validator::make($data, [
       'name' => ['required', 'string', 'max:255'],
       'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
       'mobile' => [ 'required', 'numeric', 'digits:10', 'unique:users'],
       'password' => ['required', 'string', 'min:6', 'confirmed'],
       'g-recaptcha-response' => ['required'],
        ],
         ['g-recaptcha-response.required' => 'Please verify that you are not a robot.',]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data){
     $user = new User();
     $user->name = $data['name'];
     $user->email = $data['email'];
     $user->mobile = $data['mobile'];
     $user->password = $data['password'];
     $user->save();
     //EXPIRE SESSION
     Session::forget('reg_data');
     $this->sendRegistrationMail($user);
     return $user; 
    }
    
    public function sendOTPOnMail(array $data){
     $data['otp'] = $this->generateOTP($data['name'], $data['email'], $data['mobile'], $data['password']);
     $mail = new MailController();
     $mail->template = "email.register.otp";
     $mail->receiver_email = $data['email'];
     $mail->receiver_name = $data['name'];
     $mail->subject = "OTP Request";
     $mail->data = $data;
     $mail->send(); 
    }

    public function generateOTP($name, $email, $mobile, $password){
     $otp = rand(1111,9999);
     $reg_data = array("name"=>$name, "email"=>$email, "mobile"=>$mobile, "password"=>Hash::make($password), "otp"=>Hash::make($otp));  
     Session::put('reg_data',$reg_data); 
     return $otp;
    }

    public function otpForm(){   
     return view('auth.otp-form'); 
    }

    public function verifyOTP(Request $req){
     $otp = $req->otp;
     $reg_data = Session::get('reg_data');
     if(!Hash::check($otp, $reg_data['otp'])){
      return back()->with('message','error|OTP is invalid.');  
     } 
     $user = $this->create($reg_data);
     Auth::loginUsingId($user->id);
     // SWITCH TO USER ID FROM SESSION ID
     Cart::where('session_id',cartSession())->update(['user_id'=>$user->id]);
     $req->session()->forget('cart_session_id');
     return redirect()->route('userpanel'); 
    }

    public function resendOTP(){
     $reg_data = Session::get('reg_data');  
     $this->sendOTPOnMail($reg_data); 
     return back()->with('message','success|OTP sent successfully.');
    }

    public function sendRegistrationMail($user){
     $data = array('name'=>$user->name, 'email'=>$user->email, 'mobile'=>$user->mobile);   
     $mail = new MailController();
     $mail->template = "email.register.confirmation";
     $mail->receiver_email = $user->email;
     $mail->receiver_name = $user->name;
     $mail->subject = "Registration confirmation mail from ".setting()->comp_name;
     $mail->data = $data;
     $mail->send();  
    }
    
}
