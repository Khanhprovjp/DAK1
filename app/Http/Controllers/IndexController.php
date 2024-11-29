<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexController extends Controller
{
    public function index()
    {
        // Lấy tất cả sản phẩm từ bảng products
        $products = Product::all();
        
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            // Lấy thông tin người dùng
            $user = Auth::user();
            
            // Kiểm tra loại tài khoản
            if ($user->account_type === 'admin') {
                $message = "Xin chào, " . $user->name . ". Đây là tài khoản admin.";
            } else {
                $message = "Xin chào, " . $user->name . ". Đây là tài khoản thường.";
            }
        } else {
            // Nếu người dùng chưa đăng nhập
            $message = "Bạn chưa đăng nhập";
        }

        // Truyền message và danh sách sản phẩm cho view
        return view('products.index', compact('message', 'products'));
    }
}
