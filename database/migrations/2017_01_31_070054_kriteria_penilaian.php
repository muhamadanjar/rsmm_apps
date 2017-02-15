<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KriteriaPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kriteria');
            $table->integer('nilai');
            $table->string('ket')->nullable();
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
        Schema::dropIfExists('kriteria_penilaian');
    }
}
