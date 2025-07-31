<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopSellingItemAnalyticController extends Controller{
  public function __construct(){
   return $this->middleware('auth:admin');
  }
  
  public function today(){
    $today = date('Y-m-d');  
    $item_name = array();
    $item_qty = array();
    $data = Order::whereRaw("date(order_details.created_at) = '$today' ")
        ->join('order_details','order_details.order_id','=','orders.id')
        ->selectRaw('order_details.item_name, COUNT(order_details.item_qty) as item_volume');
      $data->groupBy('order_details.item_name')
           ->orderByRaw('COUNT(order_details.item_qty) desc')->limit(5);
      $data = $data->get();
        
    foreach($data as $row){
     $item_name [] = $row->item_name;
     $item_qty [] = $row->item_volume;
    } 
    $y_axis = (!empty($item_qty)) ? max($item_qty) : 0;
    return json_encode(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
 }
 
  public function yesterday(){
    $yesterday = date('Y-m-d',strtotime('-1 days'));  
    $item_name = array();
    $item_qty = array();
    $data = Order::whereRaw("date(order_details.created_at) = '$yesterday' ")
        ->join('order_details','order_details.order_id','=','orders.id')
        ->selectRaw('order_details.item_name, COUNT(order_details.item_qty) as item_volume');
       $data->groupBy('order_details.item_name')
            ->orderByRaw('COUNT(order_details.item_qty) desc')->limit(5);
    $data = $data->get();
        
    foreach($data as $row){
     $item_name [] = $row->item_name;
     $item_qty [] = $row->item_volume;
    } 
    $y_axis = (!empty($item_qty)) ? max($item_qty) : 0;
    return json_encode(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
 }
 
  public function weekly(){
    $item_name = array();
    $item_qty = array();
    $data = Order::whereRaw("DATE(order_details.created_at) > (NOW() - INTERVAL 7 DAY)");
     $data->join('order_details','order_details.order_id','=','orders.id')
        ->selectRaw('order_details.item_name, COUNT(order_details.item_qty) as item_volume')
       ->groupBy('order_details.item_name')
       ->orderByRaw('COUNT(order_details.item_qty) desc')
       ->limit(5);
    $data = $data->get();  
    foreach($data as $row){
     $item_name [] = $row->item_name;
     $item_qty [] = $row->item_volume;
    } 
    $y_axis = (!empty($item_qty)) ? max($item_qty) : 0;
    return json_encode(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
 }
 
  public function monthly(){
    $item_name = array();
    $item_qty = array();
    $data = Order::whereRaw("DATE(order_details.created_at) > (NOW() - INTERVAL 30 DAY)");
     $data->join('order_details','order_details.order_id','=','orders.id')
        ->selectRaw('order_details.item_name, COUNT(order_details.item_qty) as item_volume')
        ->groupBy('order_details.item_name')
        ->orderByRaw('COUNT(order_details.item_qty) desc')
        ->limit(5);
    $data = $data->get();
        
    foreach($data as $row){
     $item_name [] = $row->item_name;
     $item_qty [] = $row->item_volume;
    } 
    $y_axis = (!empty($item_qty)) ? max($item_qty) : 0;
    return json_encode(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
  }
  
  public function yearly(){
    $item_name = array();
    $item_qty = array();
    $data = Order::whereRaw("DATE(order_details.created_at) > (NOW() - INTERVAL 365 DAY)");
      $data->join('order_details','order_details.order_id','=','orders.id')
           ->selectRaw('order_details.item_name, COUNT(order_details.item_qty) as item_volume')
           ->groupBy('order_details.item_name')
           ->orderByRaw('COUNT(order_details.item_qty) desc')
           ->limit(5);
    $data = $data->get();
       
    foreach($data as $row){
     $item_name [] = $row->item_name;
     $item_qty [] = $row->item_volume;
    } 
    $y_axis = (!empty($item_qty)) ? max($item_qty) : 0;
    return json_encode(['item_name'=>$item_name, 'item_qty'=>$item_qty, 'y_axis'=>$y_axis]);
  }
 
}
