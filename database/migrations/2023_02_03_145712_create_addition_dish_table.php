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
        Schema::create('addition_dish', function (Blueprint $table) {
            $table->id();
            $table->foreignId('addition_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('dish_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('addition_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
            // $table->foreignId('dish_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addition_dish');
    }
};
