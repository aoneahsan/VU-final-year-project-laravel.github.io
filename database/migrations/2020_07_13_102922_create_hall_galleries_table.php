<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hall_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();

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
        Schema::dropIfExists('hall_galleries');
    }
}
