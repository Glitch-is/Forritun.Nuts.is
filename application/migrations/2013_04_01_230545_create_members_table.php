<?php

class Create_Members_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('members', function($table)
		{
		    $table->increments('id');
		    $table->string('name');
		    $table->string('email');
		    $table->string('phone');
		    $table->timestamps();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('members');
	}

}