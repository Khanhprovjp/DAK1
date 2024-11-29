<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopping;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;

class ShoppingController extends Controller
{
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy thông tin sản phẩm từ bảng products
        $product = Product::findOrFail($request->product_id);

        // Kiểm tra số lượng sản phẩm có đủ để mua không
        if ($product->quantity < $request->quantity) {
            return redirect()->back()->with(['error'=> 'Không đủ sản phẩm trong kho.']);
        }

        // Tạo bản ghi mới trong bảng shopping
        Shopping::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
        ]);

        // Giảm số lượng sản phẩm trong bảng products
        $product->decrement('quantity', $request->quantity);

        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
    }

    public function shoppingInfo()
{

    // Lấy thông tin người dùng
    $user = Auth::user();
    $userInfo = $user->shoppingInfo;

    // Lấy thông tin sản phẩm trong giỏ hàng
    $shoppingItems = Shopping::where('user_id', $user->id)
        ->with('product') // Eager load sản phẩm
        ->get();

    // Trả về view
    return view('information.shopping', compact('userInfo', 'shoppingItems'));
}
}

