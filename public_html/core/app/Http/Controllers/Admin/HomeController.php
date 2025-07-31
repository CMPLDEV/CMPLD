<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\Analytics\OrderAnalyticController;
use App\Http\Controllers\Admin\Analytics\SalesAnalyticController;
use App\Http\Controllers\Admin\Analytics\TopSellingItemAnalyticController;

class HomeController extends Controller{
   
    public function __construct(){
     $this->middleware('auth:admin'); 
    }

    public function index(){
     Log::where('created_at','<',monthsAgo(3))->delete();    
     return $this->adminDashboard();  
    }
    
    public function adminDashboard(){
     $product_count = Product::count();
     $enquiry_count = Enquiry::count();
     $order_count = Order::count();
     $user_count = User::where('status',1)->count();    
     return view('admin.index',compact('product_count','enquiry_count','order_count','user_count'));    
    }

// ########################## ORDER METHODS START #########################
    public function orderAnalyticToday(Request $req){
     $order_obj = new OrderAnalyticController();
     $order = json_decode($order_obj->today(),true);
     $total_order = numFormat($order['total_order']);
     $order_y_axis = $order['y_axis'];
     $order_12_am = $order['order_12_am'];
     $order_3_am = $order['order_3_am'];
     $order_6_am = $order['order_6_am'];
     $order_9_am = $order['order_9_am'];
     $order_12_pm = $order['order_12_pm'];
     $order_3_pm = $order['order_3_pm'];
     $order_6_pm = $order['order_6_pm'];
     $order_9_pm = $order['order_9_pm'];
     
     return response()->json(['total_order'=>$total_order, 'order_y_axis'=>$order_y_axis, 'order_12_am'=>$order_12_am, 'order_3_am'=>$order_3_am, 'order_6_am'=>$order_6_am, 'order_9_am'=>$order_9_am, 'order_12_pm'=>$order_12_pm, 'order_3_pm'=>$order_3_pm, 'order_6_pm'=>$order_6_pm, 'order_9_pm'=>$order_9_pm]);     
    }
    
    public function orderAnalyticYesterday(Request $req){
     $order_obj = new OrderAnalyticController();
     $order = json_decode($order_obj->yesterday(),true);
     $total_order = numFormat($order['total_order']);
     $order_y_axis = $order['y_axis'];
     $order_12_am = $order['order_12_am'];
     $order_3_am = $order['order_3_am'];
     $order_6_am = $order['order_6_am'];
     $order_9_am = $order['order_9_am'];
     $order_12_pm = $order['order_12_pm'];
     $order_3_pm = $order['order_3_pm'];
     $order_6_pm = $order['order_6_pm'];
     $order_9_pm = $order['order_9_pm'];
     
     return response()->json(['total_order'=>$total_order, 'order_y_axis'=>$order_y_axis, 'order_12_am'=>$order_12_am, 'order_3_am'=>$order_3_am, 'order_6_am'=>$order_6_am, 'order_9_am'=>$order_9_am, 'order_12_pm'=>$order_12_pm, 'order_3_pm'=>$order_3_pm, 'order_6_pm'=>$order_6_pm, 'order_9_pm'=>$order_9_pm]);     
    }
    
    public function orderAnalyticWeekly(Request $req){
     $order_obj = new OrderAnalyticController();
     $order = json_decode($order_obj->weekly(),true);
     $total_order = numFormat($order['total_order']);
     $order_y_axis = $order['y_axis'];
     $data = $order['data'];
     $days = $order['days'];
     return response()->json(['total_order'=>$total_order, 'order_y_axis'=>$order_y_axis, 'data'=>$data, 'days'=>$days]);     
    }
    
    public function orderAnalyticMonthly(Request $req){
     $order_obj = new OrderAnalyticController();
     $order = json_decode($order_obj->monthly(),true);
     $total_order = numFormat($order['total_order']);
     $order_y_axis = $order['y_axis'];
     $data = $order['data'];
     return response()->json(['total_order'=>$total_order, 'order_y_axis'=>$order_y_axis, 'data'=>$data]);     
    }
    
    public function orderAnalyticYearly(Request $req){
     $order_obj = new OrderAnalyticController();
     $order = json_decode($order_obj->yearly(),true);
     $total_order = numFormat($order['total_order']);
     $order_y_axis = $order['y_axis'];
     $data = $order['data'];
     return response()->json(['total_order'=>$total_order, 'order_y_axis'=>$order_y_axis, 'data'=>$data]);     
    }
// ########################## ORDER METHODS END ###########################

// ########################## SALES METHODS START #########################
    public function salesAnalyticToday(Request $req){
     $sales_obj = new SalesAnalyticController();
     $sales = json_decode($sales_obj->today(),true);
     $total_sales = $sales['total_sales'];
     $y_axis = $total_sales;
     $total_sales = numFormat($total_sales);
     $gateway_sales = $sales['gateway_sales'];
     $upi_sales = $sales['upi_sales'];
     $upi_sales = $sales['upi_sales'];
     $dbt_sales = $sales['dbt_sales'];
     
     return response()->json(['total_sales'=>$total_sales, 'y_axis'=>$y_axis, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales]);     
    }
    
    public function salesAnalyticYesterday(Request $req){
     $sales_obj = new SalesAnalyticController();
     $sales = json_decode($sales_obj->yesterday(),true);
     $total_sales = $sales['total_sales'];
     $y_axis = $total_sales;
     $total_sales = numFormat($total_sales);
     $gateway_sales = $sales['gateway_sales'];
     $upi_sales = $sales['upi_sales'];
     $dbt_sales = $sales['dbt_sales'];
     
     return response()->json(['total_sales'=>$total_sales, 'y_axis'=>$y_axis, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales]);     
    }
    
    public function salesAnalyticWeekly(Request $req){
     $sales_obj = new SalesAnalyticController();
     $sales = json_decode($sales_obj->weekly(),true);
     $total_sales = $sales['total_sales'];
     $y_axis = $total_sales;
     $total_sales = numFormat($total_sales);
     $gateway_sales = $sales['gateway_sales'];
     $upi_sales = $sales['upi_sales'];
     $dbt_sales = $sales['dbt_sales'];
     $days = $sales['days'];
     
     return response()->json(['total_sales'=>$total_sales, 'y_axis'=>$y_axis, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales, 'days'=>$days]);     
    }
    
    public function salesAnalyticMonthly(Request $req){
     $sales_obj = new SalesAnalyticController();
     $sales = json_decode($sales_obj->monthly(),true);
     $total_sales = $sales['total_sales'];
     $y_axis = $total_sales;
     $total_sales = numFormat($total_sales);
     $gateway_data = $sales['gateway_data'];
     $upi_data = $sales['upi_data'];
     $dbt_data = $sales['dbt_data'];
     
     return response()->json(['total_sales'=>$total_sales, 'y_axis'=>$y_axis, 'gateway_data'=>$gateway_data, 'upi_data'=>$upi_data, 'dbt_data'=>$dbt_data]);     
    }
    
    public function salesAnalyticYearly(Request $req){
     $sales_obj = new SalesAnalyticController();
     $sales = json_decode($sales_obj->yearly(),true);
     $total_sales = $sales['total_sales'];
     $y_axis = $total_sales;
     $total_sales = numFormat($total_sales);
     $gateway_data = $sales['gateway_data'];
     $upi_data = $sales['upi_data'];
     $dbt_data = $sales['dbt_data'];
     
     return response()->json(['total_sales'=>$total_sales, 'y_axis'=>$y_axis, 'gateway_data'=>$gateway_data, 'upi_data'=>$upi_data, 'dbt_data'=>$dbt_data]);     
    }
    
// ########################## SALES METHODS END ###########################

// ####################### TOP SELLING METHODS START ########################
    public function topSellingAnalyticToday(Request $req){
     $top_selling_obj = new TopSellingItemAnalyticController();
     $top_selling = json_decode($top_selling_obj->today(),true);
     $item_name = $top_selling['item_name'];
     $item_qty = $top_selling['item_qty'];
     $y_axis = $top_selling['y_axis'];
     return response()->json(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
    }
    
    public function topSellingAnalyticYesterday(Request $req){
     $obj = new TopSellingItemAnalyticController();
     $data = json_decode($obj->yesterday(),true);
     $item_name = $data['item_name'];
     $item_qty = $data['item_qty'];
     $y_axis = $data['y_axis'];
     return response()->json(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
    }
    
    public function topSellingAnalyticWeekly(Request $req){
     $obj = new TopSellingItemAnalyticController();
     $data = json_decode($obj->weekly(),true);
     $item_name = $data['item_name'];
     $item_qty = $data['item_qty'];
     $y_axis = $data['y_axis'];
     return response()->json(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
    }
    
    public function topSellingAnalyticMonthly(Request $req){
     $obj = new TopSellingItemAnalyticController();
     $data = json_decode($obj->monthly(),true);
     $item_name = $data['item_name'];
     $item_qty = $data['item_qty'];
     $y_axis = $data['y_axis'];
     return response()->json(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
    }
    
    public function topSellingAnalyticYearly(Request $req){
     $obj = new TopSellingItemAnalyticController();
     $data = json_decode($obj->yearly(),true);
     $item_name = $data['item_name'];
     $item_qty = $data['item_qty'];
     $y_axis = $data['y_axis'];
     return response()->json(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
    }
    
    
// ######################## TOP SELLING METHODS END #######################

    public function autocomplete(Request $request){
     $search_keyword = $request->q;
     $data = array();
     $response = Product::select('id','name')->where('name','LIKE','%'.$search_keyword.'%')->get();
      foreach($response as $row){
       $data[] = $row->name.' - '.$row->id;     
      }
     return response()->json($data);
    }

    public function autocompleteUsers(Request $request){
     $search_keyword = $request->q;
     $data = array();
     $response = User::select('id','name')
                     ->where('name','LIKE','%'.$search_keyword.'%')
                     ->orWhere('email','LIKE','%'.$search_keyword.'%')->get();
      foreach($response as $row){
       $data[] = $row->name.' - '.$row->id;     
      }
     return response()->json($data);
    }

}
