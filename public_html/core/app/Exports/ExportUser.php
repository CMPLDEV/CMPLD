<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection, WithHeadings
{

    protected $user_ids;
    
    public function __construct($user_ids){
      $this->user_ids = $user_ids;  
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection(){
      
     $users = User::whereIn('id',explode(',',$this->user_ids))->get();
     
     return $users->map(function($data) {                    
                 
        return [
           'name' => $data->name,
           'email' => $data->email,
           'mobile' => $data->mobile,
           'status' => ($data->status=='1') ? "ACTIVE" : "INACTIVE",
           'created_at' => $data->created_at,
        ];
     });
    }

    public function headings(): array
    {

        return [
            'Name',
            'Email',
            'Mobile',
            'Status',
            'Created At',
        ];
      
    }
}
