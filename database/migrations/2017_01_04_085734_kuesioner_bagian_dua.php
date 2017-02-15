<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianDua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_bagian_dua', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_kuesioner')->nullable();
            $table->string('nomor_bsn')->nullable();
            $table->string('nama_surveyor')->nullable();
            $table->date('tgl_survey')->nullable();
            $table->string('propinsi')->nullable();

            $table->string('ii_1')->nullable()->comment('');
            $table->string('ii_1_a')->nullable()->comment('');
            $table->string('ii_2')->nullable()->comment('');
            $table->string('ii_2_a')->nullable()->comment('');
            $table->string('ii_3')->nullable()->comment('');
            $table->string('ii_3_a')->nullable()->comment('');
            $table->string('ii_3_b')->nullable()->comment('');
            $table->string('ii_3_c')->nullable()->comment('');
            $table->string('ii_3_d')->nullable()->comment('');
            $table->string('ii_3_e')->nullable()->comment('');
            $table->string('ii_3_e_a')->nullable()->comment('');
            $table->string('ii_4')->nullable()->comment('');
            $table->string('ii_5')->nullable()->comment('');
            $table->string('ii_6')->nullable()->comment('');
            $table->string('ii_6_a')->nullable()->comment('');
            $table->string('ii_7_a')->nullable()->comment('');
            $table->string('ii_7_b')->nullable()->comment('');
            $table->string('ii_7_c')->nullable()->comment('');
            $table->string('ii_7_d')->nullable()->comment('');
            $table->string('ii_7_d_a')->nullable()->comment('');
            $table->string('ii_7_e_a')->nullable()->comment('');
            $table->string('ii_7_e_b')->nullable()->comment('');
            $table->string('ii_8')->nullable()->comment('');
            $table->string('ii_8_a')->nullable()->comment('');
            $table->string('ii_8_b')->nullable()->comment('');
            $table->string('ii_8_c')->nullable()->comment('');
            $table->string('ii_9')->nullable()->comment('');
            $table->string('ii_9_a')->nullable()->comment('');
            $table->string('jumlah_umk_bersertifikat',500)->nullable()->comment('');

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
        Schema::dropIfExists('kuesioner_bagian_dua');
    }
}
