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
        Schema::create('question', function (Blueprint $table) {
            $table->id('question_id');
            $table->string('question', 300);
            $table->string('answer', 50);
            $table->integer('marks')->default(1);
            $table->unsignedBigInteger('challenge_id')->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('question');
    }
};
