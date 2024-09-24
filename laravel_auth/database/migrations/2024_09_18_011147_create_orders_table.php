<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->unsignedBigInteger('order_status')->default(1);
            $table->unsignedBigInteger('shipping_method');
            $table->unsignedBigInteger('shipping_address');
            $table->timestamp('order_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            // Foreign Key Constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('order_status')->references('id')->on('order_statuses')->onDelete('restrict');
            $table->foreign('shipping_method')->references('id')->on('shipping_methods')->onDelete('restrict');
            $table->foreign('shipping_address')->references('id')->on('addresses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
