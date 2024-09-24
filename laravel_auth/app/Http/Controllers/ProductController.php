<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\Technology;


class ProductController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'price' => 'required|numeric',
    ]);

    Product::create($request->all());

    return redirect()->route('products.index')->with('success', 'Product added successfully.');
}

public function index(){
    $products = Product::with(['images' => function ($query) {
        $query->limit(1); // Chỉ lấy một ảnh
    }])->get();
    $brands = Brand::all();
    $categories = Category::all();
    $technologies = Technology::all();
    return view('product',compact('products','brands','categories','technologies'));
}

public function destroy(Product $products)
{
    $products->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}
