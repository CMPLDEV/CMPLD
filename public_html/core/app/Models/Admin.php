<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
   
class Admin extends Authenticatable{ 
    protected $guard = 'admin';
    protected $fillable = [
        'name', 'email', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The products that belong to the user.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'selling_products','vendor_id')->withTimestamps();
    }

}