<?php

namespace App\Imports;

use Str;
use Hash;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ImportUser implements ToCollection
{
    
    public function collection(Collection $rows){
      foreach($rows as $row){ 
        
        $name = $row[0];
        $email = $row[1];
        $password = Hash::make($row[2]);
        $mobile = $row[3];
        $status = $row[4];
         
        $check_user = User::where('email',$email)->where('mobile',$mobile)->count();
        if($check_user==0){  
          $user = new User;
          $user->name = $name;
          $user->email = $email;
          $user->password = $password;
          $user->mobile = $mobile;
          $user->status = $status;
          $user->created_at = date('Y-m-d H:i');
          $user->save();
        }
       }
    }
}
