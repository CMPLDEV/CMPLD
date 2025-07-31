<?php

namespace App\Exports;

use DB;
use App\Models\Order;
use App\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportOrder implements FromCollection, WithHeadings
{

    protected $ids;
    
    public function __construct($ids){
      $this->ids = $ids;  
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
      
     $orders = Order::whereIn('id', $this->ids)->get();
     
     return $orders->map(function($data) {                    
        
        $order_detail = OrderDetail::where('order_id', $data->id)
                 ->select(DB::raw("GROUP_CONCAT(item_name) as items"))->first();
        $items = $order_detail->items;                           
                 
        return [
           'id' => $data->id,
           'type' => $data->type,
           'sub_type' => $data->sub_type,
           'gateway_payment_id' => $data->gateway_payment_id,
           'tracking_no' => $data->tracking_no,
           'amount' => $data->amount,
           'discount' => $data->discount,
           'net_amount' => $data->net_amount,
           'delivery_status' => $data->delivery_status,
           'payment_status' => $data->payment_status,
           'items' => $items,
           'name' => $data->name,
           'email' => $data->email,
           'mobile' => $data->mobile,
           'created_at' => $data->created_at,
        ];
     });
    }

    public function headings(): array
    {

        return [
            'Order ID',
            'Type',
            'Sub Type',
            'Transaction ID',
            'Tracking No',
            'Amount',
            'Discount',
            'Net Amount',
            'Delivery Status',
            'Payment Status',
            'Items',
            'Name',
            'Email',
            'Mobile',
            'Created At',
        ];
      
    }
}
