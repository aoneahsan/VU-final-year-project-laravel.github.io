<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('amount')->nullable();
            $table->string('is_available')->nullable();

            $table->foreign('hall_id')->references('id')->on('halls')->onDelete('cascade');

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
        Schema::dropIfExists('hall_food');
    }
}
