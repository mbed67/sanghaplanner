<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sangha_user_id')->unsigned()->index();
            $table->foreign('sangha_user_id')->references('id')->on('sangha_user')->onDelete('cascade');
            $table->integer('retreat_id')->unsigned()->index();
            $table->foreign('retreat_id')->references('id')->on('retreats')->onDelete('cascade');
            $table->string('description');
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
        Schema::drop('tasks');
    }
}
