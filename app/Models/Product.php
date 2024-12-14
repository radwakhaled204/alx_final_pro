<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table ='products';
    protected $fillable=[
        'name',
        'description',
        'price',
        'category_id',
        'inventory'//add inventory column
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
        public function images()
    {
        return $this->hasMany(product_image::class,'product_id');
    }

}



