<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all(); // Lấy tất cả sản phẩm từ database
        return view('products.index', compact('products')); // Truyền sản phẩm sang view
    }

    // Hiển thị form thêm sản phẩm
    public function create()
    {
        if (Auth::user()->account_type !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập');
        }

        return view('products.create');
    }

    // Lưu sản phẩm mới vào database
    public function store(Request $request)
{
    if (Auth::user()->account_type !== 'admin') {
        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập');
    }

    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
    ]);

    // Tạo sản phẩm mới
    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    // Xử lý upload ảnh
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            // Lưu ảnh vào storage
            $path = $imageFile->store('public/images'); 
            // Lưu thông tin ảnh vào database
            Image::create([
                'product_id' => $product->id, // Liên kết với sản phẩm
                'file_path' => str_replace('public/', '', $path), // Lưu đường dẫn ảnh
                'alt_text' => $product->name, // Alt text là tên sản phẩm
            ]);
        }
    }

    return redirect()->route('home')->with('success', 'Thêm sản phẩm thành công!');
}



    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        if (Auth::user()->account_type !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập');
        }

        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Cập nhật thông tin sản phẩm
    public function update(Request $request, $id)
{
    if (Auth::user()->account_type !== 'admin') {
        return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập');
    }

    // Validate dữ liệu
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate ảnh
    ]);

    // Cập nhật sản phẩm
    $product = Product::findOrFail($id);
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
    ]);

    // Xử lý upload ảnh mới nếu có
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('public/images'); // Lưu ảnh vào storage
            Image::create([
                'product_id' => $product->id, // Liên kết với sản phẩm
                'file_path' => str_replace('public/', '', $path), // Lưu đường dẫn ảnh
                'alt_text' => $product->name, // Alt text là tên sản phẩm
            ]);
        }
    }

    return redirect()->route('home')->with('success', 'Cập nhật sản phẩm thành công!');
}



    // Xóa sản phẩm
    public function destroy($id)
    {
        if (Auth::user()->account_type !== 'admin') {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập');
        }

        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('home')->with('success', 'Xóa sản phẩm thành công!');
    }
}
