<?php

class Add_Password_Role_Members_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('members', function($table){
			$table->string('password',64);
			$table->integer('role')->default(1);
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('members', function($table){
			$table->drop_column('password');
			$table->drop_column('role');
		});
	}

}