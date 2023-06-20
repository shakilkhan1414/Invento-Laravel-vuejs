<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('customer')->get();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order=Order::with('customer')->find($id);
        return response()->json($order);
    }

    public function orderDetails($id){
        $orderDetails = OrderDetail::with('product')->where('order_id', $id)->get();
        return response()->json($orderDetails);
    }

}
