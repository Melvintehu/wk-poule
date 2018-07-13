<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id')->unsigned()->nullable();
            $table->date('play_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->enum('status', ['played', 'started', 'pending'])->nullable();
            $table->integer('matchday')->nullable();
            $table->string('home_team')->nullable();
            $table->string('away_team')->nullable();
            $table->integer('home_goals')->nullable();
            $table->integer('away_goals')->nullable();

            // foreign
            $table->integer('matchday_id')->unsigned()->nullable();

            $table->foreign('matchday_id')->references('id')->on('matchdays')->onDelete('no action');

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
        Schema::dropIfExists('matches');
    }
}
