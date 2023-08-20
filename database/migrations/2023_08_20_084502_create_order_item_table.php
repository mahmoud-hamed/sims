<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('sim_id');
            $table->foreign('sim_id')->references('id')->on('sims')->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('qty');
            $table->float('price');
            $table->float('total_price');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
