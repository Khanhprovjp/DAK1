<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Information;

class InformationController extends Controller
{
    // Hiển thị thông tin người dùng
    public function index()
    {
        $user = Auth::user();

        // Lấy thông tin từ bảng information
        $information = Information::where('user_id', $user->id)->first();

        return view('information.index', compact('user', 'information'));
    }

    // Hiển thị form chỉnh sửa thông tin
    public function edit()
    {
        $user = Auth::user();

        // Lấy thông tin từ bảng information
        $information = Information::where('user_id', $user->id)->first();

        return view('information.edit', compact('user', 'information'));
    }

    // Cập nhật hoặc tạo thông tin
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
        ]);

        $user = Auth::user();

        // Tạo hoặc cập nhật thông tin
        $information = Information::updateOrCreate(
            ['user_id' => $user->id], // Điều kiện tìm kiếm (user_id)
            [
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]
        );

        return redirect()->route('information.index')->with('success', 'Thông tin đã được cập nhật!');
    }
}
