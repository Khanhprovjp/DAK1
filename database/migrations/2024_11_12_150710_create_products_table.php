<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('name'); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm, tối đa 10 chữ số, trong đó có 2 chữ số thập phân
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
