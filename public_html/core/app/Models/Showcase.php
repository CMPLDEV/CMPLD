<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Showcase extends Model
{
    use HasFactory;

    /**
     * Get all of the products for the Showcase
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
     return $this->hasMany(ShowcaseProduct::class, 'showcase_id')
             ->join('products','products.id','=','showcase_products.product_id')
             ->select('showcase_products.*','products.name','products.image','products.price','products.mrp','products.slug','products.id as product_id','products.stock');
    }

}
