<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationTable extends Migration
{
    public function up()
    {
        Schema::create('information', function (Blueprint $table) {
            $table->id(); // ID chính
            $table->unsignedBigInteger('user_id'); // Khóa ngoại
            $table->string('name'); // Tên người dùng
            $table->string('address'); // Địa chỉ
            $table->string('phone'); // Số điện thoại
            $table->timestamps();

            // Thiết lập khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('information');
    }
}
