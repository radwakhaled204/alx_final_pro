<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_image extends Model
{
    protected $table = 'product_image';

    protected $fillable = ['image_name', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
