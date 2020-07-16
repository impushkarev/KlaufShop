<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasePrizeListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_prize_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('case_prize_id')->references('id')->on('case_prizes')->onDelete('cascade');
            $table->bigInteger('case_prize_id')->unsigned();
            $table->string('data');
            $table->foreign('getBy')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('getBy')->unsigned()->nullable();
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
        Schema::dropIfExists('case_prize_lists');
    }
}
