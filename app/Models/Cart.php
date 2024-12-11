<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'customer_id', 
        'total_quantity',
        'total_price'
    ];
    
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }   
}
