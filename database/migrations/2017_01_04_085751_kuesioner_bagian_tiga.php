<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianTiga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_bagian_tiga', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nomor_kuesioner')->nullable();
            $table->string('nomor_bsn')->nullable();
            $table->string('nama_surveyor')->nullable();
            $table->date('tgl_survey')->nullable();
            $table->string('propinsi')->nullable();

            $table->string('iii_1')->nullable()
            ->comment('Apakah Saudara sudah pernah mendapatkan informasi mengenai Standar Nasional Indonesia (SNI)?');
            $table->string('iii_2_a')->nullable()
            ->comment('Jika No. 1 jawaban Saudara Sudah, dari mana Saudara mendapatkan informasi tentang SNI tersebut? Internet');
            $table->string('iii_2_b')->nullable()
            ->comment('Jika No. 1 jawaban Saudara Sudah, dari mana Saudara mendapatkan informasi tentang SNI tersebut? Layanan');
            $table->string('iii_2_c')->nullable()->comment('');
            $table->string('iii_2_c_a')->nullable()->comment('');
            $table->string('iii_2_d')->nullable()->comment('');
            $table->string('iii_2_d_a')->nullable()->comment('');
            $table->string('iii_2_e')->nullable()->comment('');
            $table->string('iii_2_e_a')->nullable()->comment('');
            $table->string('iii_3')->nullable()->comment('');
            $table->string('iii_4')->nullable()->comment('');
            $table->string('iii_5_a')->nullable()->comment('');
            $table->string('iii_5_b')->nullable()->comment('');
            $table->string('iii_5_c')->nullable()->comment('');
            $table->string('iii_5_c_a')->nullable()->comment('');
            $table->string('iii_5_d')->nullable()->comment('');
            $table->string('iii_5_d_a')->nullable()->comment('');
            $table->string('iii_6')->nullable()->comment('');
            $table->string('iii_7')->nullable()->comment('');
            
            $table->string('iii_8')->nullable()->comment('');
            $table->string('iii_8_a')->nullable()->comment('');
            $table->string('iii_8_b')->nullable()->comment('');
            $table->string('iii_8_c')->nullable()->comment('');
            $table->string('iii_8_d')->nullable()->comment('');
            $table->string('iii_8_d_a')->nullable()->comment('');
            $table->string('iii_9')->nullable()->comment('');
            $table->string('iii_9_a')->nullable()->comment('');
            $table->string('iii_10_a')->nullable()->comment('');
            $table->string('iii_10_b')->nullable()->comment('');
            $table->string('iii_10_c')->nullable()->comment('');
            $table->string('iii_10_d')->nullable()->comment('');
            $table->string('iii_10_d_a')->nullable()->comment('');

            $table->string('iii_11_a')->nullable()->comment('');
            $table->string('iii_11_b')->nullable()->comment('');
            $table->string('iii_11_c')->nullable()->comment('');
            $table->string('iii_11_d')->nullable()->comment('');
            $table->string('iii_11_e')->nullable()->comment('');
            $table->string('iii_11_f')->nullable()->comment('');
            $table->string('iii_11_f_a')->nullable()->comment('');
            
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
        Schema::dropIfExists('kuesioner_bagian_tiga');
    }
}
