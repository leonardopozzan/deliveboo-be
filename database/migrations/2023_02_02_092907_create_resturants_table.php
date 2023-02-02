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
        Schema::create('resturants', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug');
            $table->string('email', 100)->unique();
            $table->string('image')->nullable();
            $table->string('address');
            $table->string('partita_iva', 13);
            $table->string('website')->nullable();
            $table->time('opening_hours');
            $table->time('closing_hours');
            $table->string('phone_number',10);
            $table->foreignId('type_id')->cascadeOnUpdate()->nullOnDelete()->costrained();
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
        Schema::dropIfExists('resturants');
    }
};
