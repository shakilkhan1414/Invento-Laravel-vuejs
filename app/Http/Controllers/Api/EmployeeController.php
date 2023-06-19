<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{

    public function index()
    {
        $employees=Employee::all();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'name'=> 'required',
            'email'=> 'required | unique:employees',
            'address'=> 'required',
            'nid'=> 'required',
            'phone'=> 'required | numeric',
            'salary'=> 'required',
            'joining_date'=> 'required '
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(200,200);
            $upload_path = 'backend/img/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        Employee::create($validatedData);

    }

    public function show($id)
    {
        $employee=Employee::find($id);
        return response()->json($employee);

    }

    public function update(Request $request, $id)
    {
        $employee=Employee::find($id);

        $validatedData=$request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'nid'=> 'required',
            'phone'=> 'required | numeric',
            'salary'=> 'required',
            'joining_date'=> 'required '
        ]);

        if ($request->newImage) {
            if($employee->image){
                unlink($employee->image);
            }
            $position = strpos($request->newImage, ';');
            $sub = substr($request->newImage, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->newImage)->resize(200,200);
            $upload_path = 'backend/img/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        $employee->update($validatedData);
    }

    public function destroy($id)
    {
        $employee=Employee::find($id);
        if($employee->image){
            unlink($employee->image);
        }
        $employee->delete();
    }
}
