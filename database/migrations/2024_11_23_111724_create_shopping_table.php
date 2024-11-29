<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('shopping', function (Blueprint $table) {
            $table->id(); // ID chính tự tăng
            $table->unsignedBigInteger('user_id'); // Khóa ngoại đến bảng users
            $table->unsignedBigInteger('product_id'); // Khóa ngoại đến bảng products
            $table->integer('quantity')->default(1); // Số lượng sản phẩm
            $table->timestamps(); // Cột created_at và updated_at

            // Thiết lập khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('shopping'); // Xóa bảng nếu rollback
    }
};
