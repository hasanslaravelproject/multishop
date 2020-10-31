<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable =[
        'cli_name','cli_email','cli_password','cli_image','cli_id','cli_package','cli_validation','cli_status',
    ];
}
