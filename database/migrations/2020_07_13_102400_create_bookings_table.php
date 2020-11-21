<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hall_id');
            $table->string('event_type')->nullable();
            $table->string('no_of_persons')->nullable();
            $table->string('booking_time')->nullable();
            $table->dateTime('book_time_from')->nullable();
            $table->dateTime('book_time_to')->nullable();
            $table->text('menu')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->default('pending'); // pending | approved | rejected

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('bookings');
    }
}
