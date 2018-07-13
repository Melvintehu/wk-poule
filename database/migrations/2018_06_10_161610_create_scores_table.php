<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('score')->unsigned()->nullable();
            $table->integer('correct_match_outcomes')->unsigned()->nullable();
            $table->integer('correct_match_scores')->unsigned()->nullable();
            $table->integer('teams_to_next_round')->unsigned()->nullable();
            $table->integer('correct_top_scorer')->unsigned()->nullable();
            $table->integer('correct_team_with_most_goals')->unsigned()->nullable();
            $table->integer('correct_team_with_most_goals_against')->unsigned()->nullable();
            
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
        Schema::dropIfExists('scores');
    }
}
