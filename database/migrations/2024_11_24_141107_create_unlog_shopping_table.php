<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnlogShoppingTable extends Migration
{
    public function up()
    {
        Schema::create('unlog_shopping', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('unlog_shopping');
    }
}
