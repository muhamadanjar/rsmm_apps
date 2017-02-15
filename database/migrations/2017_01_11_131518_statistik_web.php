<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StatistikWeb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistik_web', function (Blueprint $table) {
            $table->increments('id_statistik');
            $table->string('ip',20);
            $table->string('os',60);
            $table->string('browser',60);
            $table->date('date_create');
            $table->string('online')->nullable();
            $table->integer('hits')->default(1)->nullable();
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
        Schema::dropIfExists('statistik_web');
    }
}
