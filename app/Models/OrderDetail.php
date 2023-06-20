<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_quantity',
        'product_price',
        'sub_total'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
