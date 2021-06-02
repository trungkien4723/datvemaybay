<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Booking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->timestamp("booked_time")->useCurrent();
            $table->integer("flight_ID");
            $table->integer("user_ID");
            $table->integer("adult");
            $table->integer("children");
            $table->integer("infant");
            $table->integer("seat_class_ID");
            $table->string("status");
            $table->rememberToken();
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
        Schema::dropIfExists('Booking');
    }
}
