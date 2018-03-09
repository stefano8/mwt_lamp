<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItinerariesCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itineraries_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('itinerary_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('itinerary_id')->references('id')->on('itineraries');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('itineraries_categories');
    }
}
