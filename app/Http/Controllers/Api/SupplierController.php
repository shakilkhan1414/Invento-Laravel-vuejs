<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::all();
        return response()->json($suppliers);
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
            'email'=> 'required | unique:suppliers',
            'address'=> 'required',
            'phone'=> 'required | numeric',
            'shop_name'=> 'required'
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(200,200);
            $upload_path = 'backend/img/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        Supplier::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier=Supplier::find($id);
        return response()->json($supplier);
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
        $supplier=Supplier::find($id);

        $validatedData=$request->validate([
            'name'=> 'required',
            'email'=> 'required',
            'address'=> 'required',
            'phone'=> 'required | numeric',
            'shop_name'=> 'required '
        ]);

        if ($request->newImage) {
            unlink($supplier->image);
            $position = strpos($request->newImage, ';');
            $sub = substr($request->newImage, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->newImage)->resize(200,200);
            $upload_path = 'backend/img/supplier/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        $supplier->update($validatedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier=Supplier::find($id);
        if($supplier->image){
            unlink($supplier->image);
        }
        $supplier->delete();
    }
}
