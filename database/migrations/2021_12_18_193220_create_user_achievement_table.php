<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAchievementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_achievement', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
             $table->bigInteger('achievement_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')
             ->onDelete('cascade');
         $table->foreign('achievement_id')->references('id')->on('achievements')
             ->onDelete('cascade');
             
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_achievement');
    }
}
