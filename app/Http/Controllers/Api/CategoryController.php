<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {
        $categories=Category::all();
        return response()->json($categories);
    }

    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'category_name'=> 'required | unique:categories'
        ]);

        Category::create($validatedData);
    }

    public function show($id)
    {
        $category=Category::find($id);
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category=Category::find($id);

        $validatedData=$request->validate([
            'category_name'=> 'required'
        ]);

        $category->update($validatedData);
    }

    public function destroy($id)
    {
        $category=Category::find($id);
        $category->delete();
    }
}
