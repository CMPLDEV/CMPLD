<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function attributes(){
     return $this->hasMany(ProductAttribute::class);    
    }
    
    public function getCreatedAtAttribute($value):string{
     return date('d-m-Y',strtotime($value));    
    }
    
    public function getUpdatedAtAttribute($value):string{
     return date('d-m-Y',strtotime($value));    
    }
    
}
