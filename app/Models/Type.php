<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'type_id';

    public function category()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }
}
