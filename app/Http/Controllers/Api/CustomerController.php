<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{

    public function index()
    {
        $customers=Customer::all();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'name'=> 'required',
            'email'=> 'unique:customers',
            'address'=> '',
            'phone'=> 'required | numeric | unique:customers'
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(200,200);
            $upload_path = 'backend/img/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        Customer::create($validatedData);
    }

    public function show($id)
    {
        $customer=Customer::find($id);
        return response()->json($customer);
    }

    public function update(Request $request, $id)
    {
        $customer=Customer::find($id);

        $validatedData=$request->validate([
            'name'=> 'required',
            'email'=> '',
            'address'=> '',
            'phone'=> 'required | numeric'
        ]);

        if ($request->newImage) {
            if($customer->image){
                unlink($customer->image);
            }
            $position = strpos($request->newImage, ';');
            $sub = substr($request->newImage, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->newImage)->resize(200,200);
            $upload_path = 'backend/img/customer/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        $customer->update($validatedData);
    }

    public function destroy($id)
    {
        $customer=Customer::find($id);
        if($customer->image){
            unlink($customer->image);
        }
        $customer->delete();
    }
}
