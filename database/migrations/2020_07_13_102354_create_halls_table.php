<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string("name")->nullable();
            $table->text("description")->nullable();
            $table->string("hall_size")->nullable();
            $table->string("event_type")->nullable();
            $table->string("hall_rent")->nullable();
            $table->string("location")->nullable();
            $table->string("min_no_of_persons")->nullable();
            $table->string("open_time")->nullable();
            $table->string("closed_time")->nullable();
            $table->string("is_available")->default(true)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('halls');
    }
}
