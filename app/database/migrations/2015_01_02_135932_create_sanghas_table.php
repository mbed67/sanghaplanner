<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanghasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sanghas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('sanghaname');
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
		Schema::drop('sanghas');
	}
	
}
