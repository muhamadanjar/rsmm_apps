<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rkminggu extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rk_minggu', function(Blueprint $table){
			$table->increments('id');
			$table->string('rencanamingguan');
			$table->integer('user_id');
			$table->timestamp('daritgl');
			$table->timestamp('sampaitgl');
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
		Schema::drop('rk_minggu');
	}

}
