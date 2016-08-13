<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Katakunci extends Migration {


	public function up()
	{
		Schema::create('katakunci', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kata');
            $table->unsignedInteger('user_id')->nullable()->default(0);
        });
	}

	
	public function down()
	{
		Schema::drop('katakunci');
	}

}
