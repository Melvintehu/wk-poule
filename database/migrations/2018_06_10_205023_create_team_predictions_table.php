<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamPredictionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_predictions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned()->nullable(); // 808
            $table->integer('round_number')->unsigned()->nullable(); // 1
            $table->integer('user_id')->unsigned()->nullable(); // 2
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('no action');

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
        Schema::dropIfExists('team_predictions');
    }
}
