<?php

namespace App\Imports;

use Str;
use App\Models\IdentifyProduct;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportIdentifyProduct implements ToCollection{
    
    public function collection(Collection $rows){
      foreach($rows as $row){ 
       $serial_no = (isset($row[0])) ? $row[0] : "";
       $asin = (isset($row[1])) ? $row[1] : "";
       $product_name = (isset($row[2])) ? $row[2] : "";
       $quantity = (isset($row[3])) ? $row[3] : "";
       $warranty_start_date = (isset($row[4])) ? $row[4] : "";
       $warranty_end_date = (isset($row[5])) ? $row[5] : "";
       $remark = (isset($row[6])) ? $row[6] : "";
         
       $is_exist = IdentifyProduct::where('serial_no',$serial_no)
                                  ->select('id')->first();
            
       if(empty($is_exist)){
            
        $data = new IdentifyProduct();
        $data->serial_no = $serial_no;
        $data->asin = $asin;
        $data->product_name = $product_name;
        $data->quantity = $quantity;
        $data->warranty_start_date = date('Y-m-d',strtotime($warranty_start_date));
        $data->warranty_end_date = date('Y-m-d',strtotime($warranty_end_date));
        $data->remark = $remark;
        $data->save();
          
       }else{
        $data = IdentifyProduct::find($is_exist->id);
        $data->serial_no = $serial_no;
        $data->asin = $asin;
        $data->product_name = $product_name;
        $data->quantity = $quantity;
        $data->warranty_start_date = date('Y-m-d',strtotime($warranty_start_date));
        $data->warranty_end_date = date('Y-m-d',strtotime($warranty_end_date));
        $data->remark = $remark;
        $data->update();

      }
     }
    }
}
