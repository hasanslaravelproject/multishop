<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'pro_name','pro_image','pro_status','pro_id','store_id','pro_price','pro_validity','pro_category','pro_quantity'
    ];
}
