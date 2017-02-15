<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianEmpat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_bagian_empat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iv_1')->comment('Masukan untuk BSN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('kuesioner_bagian_empat');
    }
}
