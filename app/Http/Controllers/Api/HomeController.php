<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Order;

class HomeController extends Controller
{
    public function statistics(){
        $customer=Customer::all()->count();
        $expense=Expense::sum('amount');
        $sale=Order::sum('total');
        $earning=Order::sum('pay');

        $data=[
            'earning'=>$earning,
            'sell_amount'=>$sale,
            'total_user'=>$customer,
            'expense_amount'=>$expense
        ];

        return response()->json($data);
    }
}
