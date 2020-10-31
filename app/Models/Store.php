<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    protected $fillable =[
      'store_image','store_name','store_details','store_email','store_password','store_status','store_id',
    ];
}
