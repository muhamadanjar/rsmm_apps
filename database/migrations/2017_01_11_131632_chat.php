<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Chat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_room')->nullable();
            $table->string('username',20);
            $table->string('ip',20);
            $table->string('os',60);
            $table->string('browser',60)->nullable();
            $table->date('tanggal');
            $table->time('jam');
            $table->string('smiley',60)->nullable();
            $table->string('foto_file',60)->nullable();
            $table->string('messages');
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
        Schema::dropIfExists('chat');
    }
}
