<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;

class SalaryController extends Controller
{

    public function index()
    {
        $salaries = Salary::with('employee')->get();
        return response()->json($salaries);
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
        $salary=Salary::with('employee')->find($id);
        return response()->json($salary);
    }

    public function update(Request $request, $id)
    {
        $salary=Salary::find($id);

        $validatedData=$request->validate([
            'amount'=> 'required',
            'salary_month'=> 'required'
        ]);

        $salary->update($validatedData);
    }

    public function destroy($id)
    {
        Salary::destroy($id);
    }
}

