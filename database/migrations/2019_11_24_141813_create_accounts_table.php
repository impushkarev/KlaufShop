<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('boughtBy')->unsigned()->nullable();
            $table->foreign('boughtBy')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('game');
            $table->text('description');
            $table->integer('mres')->unsigned()->default(0);
            $table->integer('ares')->unsigned()->default(0);
            $table->integer('dres')->unsigned()->default(0);
            $table->integer('rang')->unsigned()->default(0);
            $table->string('desc_rang');
            $table->string('lvl');
            $table->string('login');
            $table->string('password');
            $table->boolean('isLinked')->default(false);
            $table->double('price', 8, 2)->unsigned();
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
        Schema::dropIfExists('accounts');
    }
}
