<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            
            $table->string('nik', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('ttl', 10)->nullable();
            $table->string('photo')->nullable();
            $table->string('image')->nullable();
            $table->integer('divisi_id')->nullable();

            $table->string('jabatan')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->string('isactive')->nullable();
            $table->timestamp('latestlogin')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
