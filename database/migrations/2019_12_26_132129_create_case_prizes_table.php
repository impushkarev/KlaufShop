<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasePrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_prizes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->bigInteger('case_id')->unsigned();
            $table->string('name');
            $table->integer('chance')->unsigned();
            $table->string('type');
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
        Schema::dropIfExists('case_prizes');
    }
}
