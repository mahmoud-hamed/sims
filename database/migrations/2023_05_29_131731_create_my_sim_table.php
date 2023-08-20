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
        Schema::create('my_sim', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')
                ->onUpdate('cascade');
                $table->unsignedBigInteger('sim_id');
                $table->foreign('sim_id')->references('id')->on('sims')->onDelete('cascade')
                    ->onUpdate('cascade');
                    $table->enum('status',[ 'pending' , 'active' , 'expired']);
                    $table->date('end_date');
    
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_sim');
    }
};
