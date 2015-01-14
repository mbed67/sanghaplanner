<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanghaUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sangha_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sangha_id')->unsigned()->index();
			$table->foreign('sangha_id')->references('id')->on('sanghas')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->integer('role_id')->unsigned()->index();
			$table->foreign('role_id')->references('id')->on('roles');
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
		Schema::drop('sangha_user');
	}

}
