<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AktifitasKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktifitas_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->text('aktifitas_kerja');
            $table->text('keterangan')->nullable();
            $table->text('isactive')->nullable();
            $table->date('tgl')->nullable();
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
        Schema::dropIfExists('aktifitas_kerja');
    }
}
