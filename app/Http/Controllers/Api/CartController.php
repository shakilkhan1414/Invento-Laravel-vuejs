<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pos;

class CartController extends Controller
{
    public function addToCart($id){
        $product=Product::find($id);

        $cartItem = array(
            "product_id" => $id,
            "product_name" => $product->product_name,
            "product_quantity" => 1,
            "product_price" => $product->selling_price,
            "sub_total" => $product->selling_price
        );
        Pos::create($cartItem);
    }
}
