<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'cli_id','pro_id','store_id','pro_price','pro_quantity','delivery_status',
    ];
}
