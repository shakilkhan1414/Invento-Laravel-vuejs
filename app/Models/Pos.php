<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
        'sub_total'
    ];

}
