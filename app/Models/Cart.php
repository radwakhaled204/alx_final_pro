<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id', 
        'total_quantity',
        'total_price'
    ];
    
    public function cartitems()
    {
        return $this->hasMany(CartItem::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
