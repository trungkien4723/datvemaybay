<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Flight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flight', function (Blueprint $table) {
            $table->id();
            $table->integer("aircraft_ID");
            $table->integer("start_airport_ID");
            $table->dateTime("start_time");
            $table->integer("arrive_airport_ID");
            $table->dateTime("arrive_time");
            $table->integer("price");
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
        Schema::dropIfExists('Flight');
    }
}
