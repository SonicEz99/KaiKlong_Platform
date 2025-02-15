<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';
    
    protected $fillable = [
        'user_id',
        'product_name',
        'product_description',
        'product_price',
        'product_condition',
        'product_location',
        'product_phone',
        'category_id',
        'type_id',
        'brand_id'
    ];

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
