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
            $table->primary(['match_id', 'user_id']);
            $table->integer('match_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('home_goals')->unsigned()->nullable();
            $table->integer('away_goals')->unsigned()->nullable();

            $table->enum('status', ['pending', 'processed'])->default('pending');


            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
            $table->foreign('match_id')->references('id')->on('matches')->onDelete('no action');

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
