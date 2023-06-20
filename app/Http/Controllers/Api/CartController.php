<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pos;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function cartProducts(){
        $cartProducts=Pos::all();
        return response()->json($cartProducts);
    }

    public function addToCart($id){
        $check=Pos::where('product_id',$id)->first();
        if($check){
            $check->increment('product_quantity');
            $cartProduct=Pos::where('product_id',$id)->first();
            $subTotal=$cartProduct->product_quantity*$cartProduct->product_price;
            $cartProduct->update(['sub_total'=> $subTotal]);
        }
        else{
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

    public function removeCart($id){
        Pos::destroy($id);
    }

    public function increment($id){
        Pos::find($id)->increment('product_quantity');
        $cartProduct=Pos::find($id);
        $subTotal=$cartProduct->product_quantity*$cartProduct->product_price;
        $cartProduct->update(['sub_total'=> $subTotal]);
    }

    public function decrement($id){
        Pos::find($id)->decrement('product_quantity');
        $cartProduct=Pos::find($id);
        $subTotal=$cartProduct->product_quantity*$cartProduct->product_price;
        $cartProduct->update(['sub_total'=> $subTotal]);
    }

    public function order(Request $request){
        $validatedData=$request->validate([
            'customer_id'=> 'required',
            'pay'=> 'required | numeric',
            'due'=> '',
            'payby'=> 'required'
        ]);
        $validatedData['quantity']=$request->quantity;
        $validatedData['sub_total']=$request->sub_total;
        $validatedData['vat']=$request->vat;
        $validatedData['total']=$request->total;
        $validatedData['order_date']=date('d/m/Y');
        $validatedData['order_month']=date('F');
        $validatedData['order_year']=date('Y');

        $order = Order::create($validatedData);

        $carts=Pos::all();

        foreach ($carts as $cart) {
            $data=array(
                'order_id'=>$order->id,
                'product_id'=>$cart->product_id,
                'product_quantity'=>$cart->product_quantity,
                'product_price'=>$cart->product_price,
                'sub_total'=>$cart->sub_total
            );

            OrderDetail::create($data);
            Product::find($cart->product_id)->update(['product_quantity'=> DB::raw('product_quantity - '.$cart->product_quantity)]);
        }

        Pos::truncate();

    }

}

