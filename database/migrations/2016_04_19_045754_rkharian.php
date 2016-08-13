<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rkharian extends Migration {

	
	public function up()
	{
		Schema::create('rk_harian', function(Blueprint $table){
			$table->increments('id');
			$table->string('rencanaharian');
			$table->string('darijam');
			$table->string('sampaijam',10);
			$table->string('keterangan',10)->nullable();
			$table->string('aktifitas')->nullable();
			$table->string('aktifitas_darijam',10)->nullable();
			$table->string('aktifitas_sampaijam',10)->nullable();
			$table->integer('user_id');
			$table->integer('mingguan_id');
			$table->integer('status')->default(0);
			$table->integer('bobot')->default(0);
			$table->timestamp('tgl');
			$table->timestamps();
		});
	}


	public function down()
	{
		Schema::drop('rk_harian');
	}

}
