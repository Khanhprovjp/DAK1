<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class DetailController extends Controller
{
    public function show($id)
    {
        // Tìm sản phẩm theo ID và eager load mối quan hệ với hình ảnh
        $product = Product::with('images')->findOrFail($id);

        // Trả về view chi tiết sản phẩm và truyền dữ liệu sản phẩm cùng với hình ảnh
        return view('products.detail', compact('product'));
    }
}
