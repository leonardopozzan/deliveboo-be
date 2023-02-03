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
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 150)->unique();
            $table->float('price', 5, 2)->unsigned();
            $table->string('image')->nullable();
            $table->boolean('visible');
            $table->text('ingredients');
            $table->foreignId('restaurant_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // $table->foreignId('restaurant_id')->cascadeOnUpdate()->cascadeOnDelete()->costrained();
            // $table->foreignId('category_id')->cascadeOnUpdate()->nullOnDelete()->costrained();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
};
