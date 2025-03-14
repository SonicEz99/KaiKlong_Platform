<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $primaryKey = 'message_id';


    protected $fillable = [
        'user_seller_id',
        'user_buyer_id',
        'message',
        'send_form'
    ];
}
