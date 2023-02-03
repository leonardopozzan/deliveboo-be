<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dish_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('dish_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
            // $table->foreignId('order_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
            $table->tinyInteger('quantity')->unsigned();
            $table->float('current_price', 5, 2)->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dish_order');
    }
};
