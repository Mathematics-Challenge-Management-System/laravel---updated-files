<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_challenge', function (Blueprint $table) {
            $table->id('participant_challenge_id');
            $table->unsignedBigInteger('participant_id');
            $table->unsignedBigInteger('challenge_id');
            $table->integer('score')->default(0);
            $table->timestamp('start_time')->useCurrent();
            $table->timestamp('end_time')->useCurrentOnUpdate();
            $table->foreign('participant_id')->references('participant_id')->on('participant');
            $table->foreign('challenge_id')->references('challenge_id')->on('challenge');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_challenge');
    }
};
