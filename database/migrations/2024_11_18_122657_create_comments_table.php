<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Khóa ngoại liên kết đến bảng products
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // Khóa ngoại liên kết đến bảng users
            $table->text('content'); // Nội dung bình luận
            $table->timestamps(); // Các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
