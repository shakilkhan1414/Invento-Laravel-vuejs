<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{

    public function index()
    {
        $expenses=Expense::all();
        return response()->json($expenses);
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'details'=> 'required',
            'amount'=> 'required',
            'date'=> 'required'
        ]);

        Expense::create($validatedData);
    }

    public function show($id)
    {
        $expense=Expense::find($id);
        return response()->json($expense);
    }


    public function update(Request $request, $id)
    {
        $expense=Expense::find($id);

        $validatedData=$request->validate([
            'details'=> 'required',
            'amount'=> 'required',
            'date'=> 'required'
        ]);

        $expense->update($validatedData);
    }

    public function destroy($id)
    {
        Expense::destroy($id);
    }
}

