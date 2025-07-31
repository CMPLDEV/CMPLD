<?php

namespace App\Exports;

use App\Models\IdentifyProduct;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportIdentifyProduct implements FromCollection, WithHeadings
{

    protected $ids;
    
    public function __construct($ids){
     $this->ids = $ids;  
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
     $identify_products = IdentifyProduct::whereIn('id',explode(',',$this->ids))->get();
     
     return $identify_products->map(function($data) {
           
        return [
           'serial_no' => $data->serial_no,
           'asin' => $data->asin,
           'product_name' => $data->product_name,
           'quantity' => $data->quantity,
           'warranty_start_date' => date('d-m-Y',strtotime($data->warranty_start_date)),
           'warranty_end_date' => date('d-m-Y',strtotime($data->warranty_end_date)),
        ];
     });
    }

    public function headings(): array{

        return [
            'Serial No',
            'ASIN',
            'Product Name',
            'Quantity',
            'Warranty Start Date',
            'Warranty End Date'
        ];
      
    }
}
