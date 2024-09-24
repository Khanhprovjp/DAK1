<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // Hiện form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Đăng ký tài khoản
    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 0, // Tài khoản thường
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. You can now log in.');
    }

    // Xác thực thông tin
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
