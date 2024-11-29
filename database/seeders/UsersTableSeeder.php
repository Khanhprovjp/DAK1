<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo tài khoản admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Mật khẩu đã mã hóa
            'account_type' => 'admin', // Loại tài khoản là admin
        ]);

        // Tạo tài khoản thường
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password123'), // Mật khẩu đã mã hóa
            'account_type' => 'regular', // Loại tài khoản là thường
        ]);
    }
}
