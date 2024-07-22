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
        Schema::create('participant_answer', function (Blueprint $table) {
            $table->id('participant_answer_id');
            $table->unsignedBigInteger('participant_challenge_id');
            $table->unsignedBigInteger('question_id');
            $table->integer('marks')->default(0);
            $table->string('answer', 50);
            $table->timestamps();
            $table->foreign('participant_challenge_id')->references('participant_challenge_id')->on('participant_challenge');
            $table->foreign('question_id')->references('question_id')->on('question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_answer');
    }
};
