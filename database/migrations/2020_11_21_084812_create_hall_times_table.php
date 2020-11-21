<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();

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
        Schema::dropIfExists('hall_times');
    }
}
