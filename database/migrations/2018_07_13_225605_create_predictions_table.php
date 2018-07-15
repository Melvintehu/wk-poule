<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('predictions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('goals_home');
            $table->integer('goals_away');
            $table->integer('yellow_cards_home');
            $table->integer('yellow_cards_away');
            $table->integer('red_cards_home');
            $table->integer('red_cards_away');


            $table->unsignedInteger('user_id');
            $table->unsignedInteger('match_id');
            
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
        Schema::dropIfExists('predictions');
    }
}
