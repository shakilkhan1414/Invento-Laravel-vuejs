<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{

    public function index()
    {
        //
    }

    public function paySalary(Request $request, $id)
    {
        $validatedData=$request->validate([
            'amount'=> 'required',
            'salary_month'=> 'required'
        ]);

        $validatedData['employee_id']=$id;
        $validatedData['salary_date']=date('d/m/Y');
        $validatedData['salary_year']=date('Y');

        $check = Salary::where('employee_id', $id)->where('salary_month', $validatedData['salary_month'])->where('salary_year', $validatedData['salary_year'])->first();

        if($check){
            return response()->json('Salary Already Paid');
        }
        else{
            Salary::create($validatedData);
        }

    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

