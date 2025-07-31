<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Models\UserCoupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller{
    
    public $code;
    public $user_id;
    protected $section_name;
    
    public function __construct(){
     $this->section_name = "Coupon";    
     $this->middleware('auth:admin');
    }

    public function index(){
     $data = Coupon::latest()->paginate(50);
     $i = $data->perPage() * ($data->currentPage() - 1);
     return view('admin.coupon',compact('data','i'));  
    }

    public function add(){   
     return view('admin.addedit-coupon');   
    }

    public function create(Request $req){
     $req->validate(['code' => 'required|max:100|unique:coupons,code','amount'=>'required|numeric|gt:0',
                    'content'=>'nullable|max:255','condition'=>'required|numeric','expiry'=>'required']);
     $data = new Coupon();
     $data->code = $req->code;
     $data->type = $req->type;
     $data->amount = $req->amount;
     $data->content = $req->content;
     $data->condition = $req->condition;
     $data->status = $req->status;
     $data->expiry = $req->expiry;
     $data->save();
     logHistory('ADD', admin()->id, admin()->name, $this->section_name, $data->code);
     return back()->with('message','success|Created successfully.');
    }
    
      public function edit(Request $req){
       $edit = Coupon::find($req->id);
       return view('admin.addedit-coupon',compact('edit'));  
      }

      public function update(Request $req){
        $req->validate(['code' => 'required|max:100|unique:coupons,code,'.$req->id,'amount'=>'required|numeric|gt:0',
                        'content'=>'nullable|max:255','condition'=>'required|numeric','expiry'=>'required']);
        $data = Coupon::find($req->id);
        $data->code = $req->code;
        $data->type = $req->type;
        $data->amount = $req->amount;
        $data->content = $req->content;
        $data->condition = $req->condition;
        $data->status = $req->status;
        $data->expiry = $req->expiry;
        $data->update();
        logHistory('UPDATE', admin()->id, admin()->name, $this->section_name, $data->code);
        return back()->with('message','success|Updated successfully.');
      }

      public function updateStatus(Request $req){
       Coupon::where('id', $req->id)->update(['status' => $req->status]);
       return back()->with('message','success|Status changed.');
      }
    
      public function bottomAction(Request $req){
       $ids = $req->ids;
       $action = $req->req_for;
       if($action == "Delete"){  
        foreach($ids as $id){
         $data = Coupon::find($id);
         logHistory('DELETE', admin()->id, admin()->name, $this->section_name, $data->code);
         $data->delete();
        }   
       }else if($action == "Active" || $action == "Inactive"){
        $status = ($action=="Active") ? 1 : 0;
        Coupon::whereIn('id',$ids)->update(['status'=>$status]);
       }
       return back()->with('message','success|Action completed.');
      }
      
    public function apply(){
     $code = $this->code;
     $subtotal = cartTotal();
    
     $coupon = Coupon::where('code',$code)
                    ->where('expiry','>=',date('Y-m-d'))->first();
    if(empty($coupon)){
      return back()->with('message','error|Invalid Coupon.');
    }
    $carts = cartData();
    $user_coupon = UserCoupon::where('coupon_id',$coupon->id)
                             ->where('status','USED')->count();
    
    if($subtotal < $coupon->condition){
      return back()->with('message','error|Invalid Coupon');
    }else{
      
      $data = new UserCoupon();
      $data->user_id = $this->user_id;
      $data->coupon_id = $coupon->id;
      $data->status = "APPLIED";
      $data->save();
      return back()->with('message','success|Coupon Applied.');
    }  
  }

  public function remove(){
   UserCoupon::where('id',$this->code)->delete();
   return back()->with('message','success|Coupon Removed.');
  }

}
