<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 
        'total_price',
        
    ];
    
    public function user()
    {
        return $this->belongsTo(user::class);
    }
    public function orderItems()
    {
        return $this->hasMany(Order_items::class, 'order_id');
    }
   
}
