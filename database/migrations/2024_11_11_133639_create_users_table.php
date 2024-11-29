<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Cột ID tự tăng cho mỗi user
            $table->string('name'); // Tên của người dùng
            $table->string('email')->unique(); // Địa chỉ email, yêu cầu là duy nhất
            $table->string('password'); // Mật khẩu
            $table->enum('account_type', ['regular', 'admin'])->default('regular'); 
            // Cột 'account_type' xác định loại tài khoản: 'regular' cho tài khoản thường, 'admin' cho tài khoản admin
            $table->timestamps(); // Hai cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users'); // Xóa bảng nếu rollback migration
    }
};
