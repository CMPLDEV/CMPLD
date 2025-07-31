<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesAnalyticController extends Controller{
  
  public function __construct(){
   return $this->middleware('auth:admin');
  }
  
  public function today(){
   $today = date('Y-m-d');      
   $total_sales = Order::whereRaw("date(created_at) = '$today' ");
   $total_sales = $total_sales->sum('net_amount');
                         
   $gateway_sales = Order::where('sub_type','GATEWAY')
                ->whereRaw("date(created_at) = '$today' ");
   $gateway_sales = $gateway_sales->sum('net_amount');
                
   $upi_sales = Order::where('sub_type','UPI')
                ->whereRaw("date(created_at) = '$today' ");
   $upi_sales = $upi_sales->sum('net_amount');
   
   $dbt_sales = Order::where('sub_type','DIRECT_BANK_TRANSFER')
                ->whereRaw("date(created_at) = '$today' ");
   $dbt_sales = $dbt_sales->sum('net_amount');
                             
   return json_encode(['total_sales'=>$total_sales, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales]);
 }
 
  public function yesterday(){
   $yesterday = date('Y-m-d',strtotime('-1 days'));       
   $total_sales = Order::whereRaw("date(created_at) = '$yesterday' ");
   $total_sales = $total_sales->sum('net_amount'); 
                         
   $gateway_sales = Order::where('sub_type','GATEWAY')
                     ->whereRaw("date(created_at) = '$yesterday' ");
   $gateway_sales = $gateway_sales->sum('net_amount');
                
   $upi_sales = Order::where('sub_type','UPI')
                ->whereRaw("date(created_at) = '$yesterday' ");
   $upi_sales = $upi_sales->sum('net_amount');
   
   $dbt_sales = Order::where('sub_type','DIRECT_BANK_TRANSFER')
                ->whereRaw("date(created_at) = '$yesterday' ");
   $dbt_sales = $dbt_sales->sum('net_amount');
                              
   return json_encode(['total_sales'=>$total_sales, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales]);
  }
  
  public function weekly(){
   $gateway_sales = array();
   $upi_sales = array();
   $days = array();      
   $last_week_dates = lastWeekDates();
   $total_sales = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 7 DAY)");
   $total_sales = $total_sales->sum('net_amount'); 
                
    foreach($last_week_dates as $date){
     $output1 = Order::where('sub_type','GATEWAY')
                     ->whereRaw("date(created_at) = '$date' ");
     $gateway_sales [] = $output1->sum('net_amount');
                
     $output2 = Order::where('sub_type','UPI')
                     ->whereRaw("date(created_at) = '$date' ");
     $upi_sales [] = $output2->sum('net_amount');
     
     $output3 = Order::where('sub_type','DIRECT_BANK_TRANSFER')
                     ->whereRaw("date(created_at) = '$date' ");
     $dbt_sales [] = $output2->sum('net_amount');
                
    $days [] = date('D',strtotime($date));              
   }            
                              
   return json_encode(['total_sales'=>$total_sales, 'gateway_sales'=>$gateway_sales, 'upi_sales'=>$upi_sales, 'dbt_sales'=>$dbt_sales, 'days'=>$days]);
  }
  
  public function monthly(){
   $gateway_data = array();      
   $upi_data = array();
   $last_month_dates = lastMonthDates();
   $total_sales = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 30 DAY)");
   $total_sales = $total_sales->sum('net_amount'); 
                
    foreach($last_month_dates as $date){
     $gateway_sales = Order::where('sub_type','GATEWAY')
                ->whereRaw("date(created_at) = '$date' ");
     $gateway_sales = $gateway_sales->sum('net_amount');
                
     $upi_sales = Order::where('sub_type','UPI')
                ->whereRaw("date(created_at) = '$date' ");
     $upi_sales = $upi_sales->sum('net_amount');
     
     $dbt_sales = Order::where('sub_type','DIRECT_BANK_TRANSFER')
                ->whereRaw("date(created_at) = '$date' ");
     $dbt_sales = $dbt_sales->sum('net_amount');
                
     $gateway_data [] = array('x'=>$date, 'y'=>$gateway_sales); 
     $upi_data [] = array('x'=>$date, 'y'=>$upi_sales);
     $dbt_data [] = array('x'=>$date, 'y'=>$dbt_sales);
    }            
                              
   return json_encode(['total_sales'=>$total_sales, 'gateway_data'=>$gateway_data, 'upi_data'=>$upi_data, 'dbt_data'=>$dbt_data]);
  }
  
  public function yearly(){
   $gateway_data = array();      
   $upi_data = array();
   $dbt_data = array();
   $last_year_months = lastYearMonths();
   $total_sales = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 365 DAY)");
    $total_sales = $total_sales->sum('net_amount'); 
                
    foreach($last_year_months as $date){
     $gateway_sales = Order::where('sub_type','GATEWAY')
                ->whereRaw("date(created_at) = '$date' ");
     $gateway_sales = $gateway_sales->sum('net_amount');
                
     $upi_sales = Order::where('sub_type','UPI')
                ->whereRaw("date(created_at) = '$date' ");
     $upi_sales = $upi_sales->sum('net_amount');
     
     $dbt_sales = Order::where('sub_type','DIRECT_BANK_TRANSFER')
                ->whereRaw("date(created_at) = '$date' ");
     $dbt_sales = $dbt_sales->sum('net_amount');
                
     $gateway_data [] = array('x'=>$date, 'y'=>$gateway_sales); 
     $upi_data [] = array('x'=>$date, 'y'=>$upi_sales);
     $dbt_data [] = array('x'=>$date, 'y'=>$dbt_sales);
    }            
                              
   return json_encode(['total_sales'=>$total_sales, 'gateway_data'=>$gateway_data, 'upi_data'=>$upi_data, 'dbt_data'=>$dbt_data]);
  }
  
}
