<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/'); // Chuyển hướng về trang chủ nếu đăng nhập thành công
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'account_type' => 'regular', // Mặc định tài khoản thường
        ]);

        return redirect()->route('login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.'); // Chuyển đến trang đăng nhập sau khi đăng ký
    }
}

