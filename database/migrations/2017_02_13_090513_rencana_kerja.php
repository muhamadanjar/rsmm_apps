<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RencanaKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencana_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_rencana');
            $table->text('kode_grup_rencana');
            $table->text('rencana_kerja');
            $table->date('dari_tgl');
            $table->date('sampai_tgl');
            $table->text('keterangan')->nullable();
            $table->text('isactive')->nullable();
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
        Schema::dropIfExists('rencana_kerja');
    }
}
