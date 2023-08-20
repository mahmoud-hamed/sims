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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method', ['cod','visa']);
            $table->float('sub_total')->default(0.0);
            $table->float('shipping_price')->default(0.0);
            $table->float('total_price')->default(0.0);
            $table->enum('status',['pending','in_progress','done','cancelled'])->default('pending');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')
                ->onUpdate('cascade');
                $table->string('name');

            $table->string('address');
            $table->string('phone');
            $table->timestamps();
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
