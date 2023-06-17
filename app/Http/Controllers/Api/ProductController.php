<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with('category', 'supplier')->get();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'product_name'=> 'required',
            'product_code'=> 'required | unique:products',
            'root'=> 'required',
            'buying_price'=> 'required',
            'selling_price'=> 'required',
            'category_id'=> 'required',
            'supplier_id'=> 'required ',
            'buying_date'=> 'required ',
            'product_quantity'=> 'required '
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->image)->resize(200,200);
            $upload_path = 'backend/img/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        Product::create($validatedData);
    }


    public function show($id)
    {
        $product=Product::find($id);
        return response()->json($product);
    }


    public function update(Request $request, $id)
    {
        $product=Product::find($id);

        $validatedData=$request->validate([
            'product_name'=> 'required',
            'product_code'=> 'required',
            'root'=> 'required',
            'buying_price'=> 'required',
            'selling_price'=> 'required',
            'category_id'=> 'required',
            'supplier_id'=> 'required ',
            'buying_date'=> 'required ',
            'product_quantity'=> 'required '
        ]);

        if ($request->newImage) {
            unlink($product->image);
            $position = strpos($request->newImage, ';');
            $sub = substr($request->newImage, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->newImage)->resize(200,200);
            $upload_path = 'backend/img/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $validatedData['image']=$image_url;
        }

        $product->update($validatedData);
    }

    public function destroy($id)
    {
        $product=Product::find($id);
        if($product->image){
            unlink($product->image);
        }
        $product->delete();
    }
}
