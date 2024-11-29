<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnlogShopping;
use App\Models\Product;

class UnlogShoppingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        UnlogShopping::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
        ]);

        return back()->with('message', 'Thông tin mua hàng đã được lưu.');
    }

    public function showUnlogShoppingForm()
    {
        return view('information.unlog_shopping');
    }

    public function searchByPhone(Request $request)
{
    $request->validate([
        'phone' => 'required|string|max:15',
    ]);

    $phone = $request->input('phone');

    // Tìm kiếm các sản phẩm trong giỏ hàng của số điện thoại này
    $shoppingItems = UnlogShopping::join('products', 'unlog_shopping.product_id', '=', 'products.id')
        ->where('unlog_shopping.phone', $phone)
        ->select('unlog_shopping.name as buyer_name', 'products.name as product_name', 'unlog_shopping.quantity', 'products.price')
        ->get();

    // Trả kết quả về view, đảm bảo truyền cả shoppingItems và phone
    return view('information.unlog_shopping', compact('shoppingItems', 'phone'));
}

    
}
