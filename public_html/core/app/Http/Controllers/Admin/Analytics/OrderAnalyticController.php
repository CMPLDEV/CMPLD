<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderAnalyticController extends Controller{
 
 public function __construct(){
  return $this->middleware('auth:admin');
 }
 
 public function today(){
  $today = date('Y-m-d');     
  $total_order = Order::whereRaw("date(created_at) = '$today' ");
  $total_order = $total_order->count(); 
  $order_count = $total_order;
                        
    $y_axis = 100;
     if($total_order > 100){
     while($total_order > 100){
      $total_order = $total_order - 100;
      $y_axis += 100; 
     }
    }
     
    $order_12_am = Order::whereBetween('created_at',[date('Y-m-d 00:00'),date('Y-m-d 03:00')]);
    $order_12_am = $order_12_am->count();
    
    $order_3_am = Order::whereBetween('created_at',[date('Y-m-d 03:00'),date('Y-m-d 06:00')]);
    $order_3_am = $order_3_am->count();
    
    $order_6_am = Order::whereBetween('created_at',[date('Y-m-d 06:00'),date('Y-m-d 09:00')]);
    $order_6_am = $order_6_am->count();
    
    $order_9_am = Order::whereBetween('created_at',[date('Y-m-d 09:00'),date('Y-m-d 12:00')]);
    $order_9_am = $order_9_am->count();
    
    $order_12_pm = Order::whereBetween('created_at',[date('Y-m-d 12:00'),date('Y-m-d 15:00')]);
    $order_12_pm = $order_12_pm->count();
    
    $order_3_pm = Order::whereBetween('created_at',[date('Y-m-d 15:00'),date('Y-m-d 18:00')]);
    $order_3_pm = $order_3_pm->count();
    
    $order_6_pm = Order::whereBetween('created_at',[date('Y-m-d 18:00'),date('Y-m-d 21:00')]);
    $order_6_pm = $order_6_pm->count();
                         
    $order_9_pm = Order::whereBetween('created_at',[date('Y-m-d 21:00'),date('Y-m-d 23:59')]);
    $order_9_pm = $order_9_pm->count();      
    return json_encode(['total_order'=>$order_count, 'y_axis'=>$y_axis, 'order_12_am'=>$order_12_am, 'order_3_am'=>$order_3_am, 'order_6_am'=>$order_6_am, 'order_9_am'=>$order_9_am, 'order_12_pm'=>$order_12_pm, 'order_3_pm'=>$order_3_pm, 'order_6_pm'=>$order_6_pm, 'order_9_pm'=>$order_9_pm]);   
 }
 
  public function yesterday(){
   $yesterday = date('Y-m-d',strtotime('-1 days'));     
   $total_order = Order::whereRaw("date(created_at) = '$yesterday' ");
    $total_order = $total_order->count(); 
    $order_count = $total_order;
    $y_axis = 100;
     if($total_order > 100){
     while($total_order > 100){
      $total_order = $total_order - 100;
      $y_axis += 100; 
     }
    }
     
     
    $order_12_am = Order::whereBetween('created_at',[date('Y-m-d 00:00',strtotime('-1 days')),date('Y-m-d 03:00',strtotime('-1 days'))]);
    $order_12_am = $order_12_am->count();
                         
    $order_3_am = Order::whereBetween('created_at',[date('Y-m-d 03:00',strtotime('-1 days')),date('Y-m-d 06:00',strtotime('-1 days'))]);
    $order_3_am = $order_3_am->count();
                         
    $order_6_am = Order::whereBetween('created_at',[date('Y-m-d 06:00',strtotime('-1 days')),date('Y-m-d 09:00',strtotime('-1 days'))]);
    $order_6_am = $order_6_am->count();
                         
    $order_9_am = Order::whereBetween('created_at',[date('Y-m-d 09:00',strtotime('-1 days')),date('Y-m-d 12:00',strtotime('-1 days'))]);
    $order_9_am = $order_9_am->count();
                         
    $order_12_pm = Order::whereBetween('created_at',[date('Y-m-d 12:00',strtotime('-1 days')),date('Y-m-d 15:00',strtotime('-1 days'))]);
    $order_12_pm = $order_12_pm->count();
                         
    $order_3_pm = Order::whereBetween('created_at',[date('Y-m-d 15:00',strtotime('-1 days')),date('Y-m-d 18:00',strtotime('-1 days'))]);
    $order_3_pm = $order_3_pm->count();
                         
    $order_6_pm = Order::whereBetween('created_at',[date('Y-m-d 18:00',strtotime('-1 days')),date('Y-m-d 21:00',strtotime('-1 days'))]);
    $order_6_pm = $order_6_pm->count();
                         
    $order_9_pm = Order::whereBetween('created_at',[date('Y-m-d 21:00',strtotime('-1 days')),date('Y-m-d 23:59',strtotime('-1 days'))]);
    $order_9_pm = $order_9_pm->count();                     
     
    return json_encode(['total_order'=>$order_count, 'y_axis'=>$y_axis, 'order_12_am'=>$order_12_am, 'order_3_am'=>$order_3_am, 'order_6_am'=>$order_6_am, 'order_9_am'=>$order_9_am, 'order_12_pm'=>$order_12_pm, 'order_3_pm'=>$order_3_pm, 'order_6_pm'=>$order_6_pm, 'order_9_pm'=>$order_9_pm]);   
 }

 public function weekly(){
  $data = array();
  $days = array();
  $last_week_dates = lastWeekDates();
  $total_order = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 7 DAY)");
  $total_order = $total_order->count(); 
  $order_count = $total_order;
                     
    $y_axis = 100;
     if($total_order > 100){
     while($total_order > 100){
      $total_order = $total_order - 100;
      $y_axis += 100; 
     }
    }
    
    foreach($last_week_dates as $date){
     $output = Order::whereRaw("date(created_at) = '$date' ");
     $data [] = $output->count();  
     $days [] = date('D',strtotime($date));              
    }
   return json_encode(['total_order'=>$order_count, 'y_axis'=>$y_axis, 'data'=>$data, 'days'=>$days]);   
 }
 
 public function monthly(){
  $data = array();
  $last_month_dates = lastMonthDates();
 $total_order = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 30 DAY)");
  $total_order = $total_order->count(); 
  $order_count = $total_order;
  
    $y_axis = 100;
     if($total_order > 100){
     while($total_order > 100){
      $total_order = $total_order - 100;
      $y_axis += 100; 
     }
    }
    
    foreach($last_month_dates as $date){
     $value = Order::whereRaw("date(created_at) = '$date' ");
     $value = $value->count();    
     $data [] = array('x'=>$date, 'y'=>$value);    
    }
  return json_encode(['total_order'=>$order_count, 'y_axis'=>$y_axis, 'data'=>$data]);   
 }
 
 public function yearly(){
  $data = array();
  $last_year_months = lastYearMonths();
$total_order = Order::whereRaw("DATE(created_at) > (NOW() - INTERVAL 365 DAY)");
   $total_order = $total_order->count(); 
   $order_count = $total_order;
                    
    $y_axis = 100;
     if($total_order > 100){
     while($total_order > 100){
      $total_order = $total_order - 100;
      $y_axis += 100; 
     }
    }
    
    foreach($last_year_months as $date){
     $value = Order::whereRaw("DATE(created_at) = '$date'");
     $value = $value->count();    
     $data [] = array('x'=>$date, 'y'=>$value);    
    }
  return json_encode(['total_order'=>$order_count, 'y_axis'=>$y_axis, 'data'=>$data]);   
 }

}
