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
        Schema::create('challenge', function (Blueprint $table) {
            $table->id('challenge_id');
            $table->string('challenge_name', 50)->unique();
            $table->string('challenge_description', 300)->nullable();
            $table->date('challenge_start_date');
            $table->date('challenge_end_date');
            $table->integer('duration');
            $table->integer('wrong_answer_marks')->nullable();
            $table->integer('blank_answer_marks')->nullable();
            $table->integer('questions_to_answer')->nullable();
            $table->string('admin_id');
            $table->foreign('admin_id')->references('id')->on('admin');
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
        Schema::dropIfExists('challenge');
    }
};
