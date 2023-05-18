<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees=Employee::all();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee=Employee::find($id);
        return response()->json($employee);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            unlink($employee->image);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=Employee::find($id);
        if($employee->image){
            unlink($employee->image);
        }
        $employee->delete();
    }
}
