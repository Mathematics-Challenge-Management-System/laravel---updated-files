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
        Schema::create('admin', function (Blueprint $table) {
            $table->id('admin_id');
        
            $table->string('Fname', 25)->nullable();
            $table->string('Lname', 25)->nullable();
            $table->string('Email', 50)->unique();
            $table->string('Phone', 15)->nullable();
            $table->string('Password', 200)->nullable();
          
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
        Schema::dropIfExists('admin');
    }
};
