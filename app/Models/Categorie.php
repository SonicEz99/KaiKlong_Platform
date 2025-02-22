<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_name',
        'category_pic_path',
    ];

    public $timestamps = false;

    public function brands()
    {
        return $this->hasMany(Brand::class, 'category_id');
    }

    public function types()
    {
        return $this->hasMany(Type::class, 'category_id');
    }
    public function category()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
