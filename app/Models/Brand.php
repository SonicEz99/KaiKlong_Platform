<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';

    protected $fillable = [
        'brand_name',
        'brand_pic_path',
        'category_id',
    ];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id');
    }
}
