<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->string('email', 100)->unique();
			$table->string('password', 64);
			$table->date('birthday');
			$table->string('time_zone');
			$table->date('lastlogdate');
			$table->string('remember_token', 100);		
			$table->string('id_code')->default(0);
			$table->string('pw_code')->default(0);
			
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
		Schema::drop('users');
	}

}
