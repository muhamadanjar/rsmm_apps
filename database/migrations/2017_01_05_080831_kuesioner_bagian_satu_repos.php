<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerBagianSatuRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('kuesioner_bagian_satu_repos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_input')->nullable();
            $table->string('kode')->nullable();
            $table->string('nomor_kuesioner')->nullable();
            $table->string('nomor_bsn')->nullable();
            $table->string('nama_surveyor')->nullable();
            $table->date('tgl_survey')->nullable();
            $table->string('propinsi')->nullable();
            $table->string('i_1')->comment('Nama UMKM')->nullable();
            $table->string('i_2')->comment('Nama Pemilik')->nullable();
            $table->string('i_3')->comment('Alamat Perusahaan')->nullable();
            $table->string('i_4')->comment('No HP/Telepon')->nullable();
            $table->string('i_5')->comment('Alamat E-mail')->nullable();
            $table->string('i_6')->comment('Alamat Website')->nullable();
            $table->string('i_7')->comment('Jumlah Karyawan')->nullable();
            $table->string('i_8')->nullable()->comment('Dalam melakukan proses usahanya, sudah dilakukan pembagian pekerjaan untuk masing-masing karyawan (Seperti bagian administrasi, produksi, pemasaran, dll) ');
            $table->string('i_9')->nullable()->comment('Apakah UMKM sudah mempunyai legalitas usaha');
            $table->string('i_10')->nullable()->comment('Apabila jabawan butir b sudah, legalitas yang dimiliki berupa');
            $table->string('i_10_a')->nullable()->comment('Nomor Registrasi TDP/IUI/Lainnya');
            $table->string('i_10_b')->nullable()->comment('Lampiran Copy TDP/IUI/Lainnya');
            $table->string('i_11')->nullable()->comment('Sebutkan produk yang dihasilkan oleh UMKM Saudara, dan sebutkan mana yang merupakan produk utama? ');
            $table->string('i_11_a')->nullable()->comment('Lampiran foto Produk');
            $table->string('i_12')->nullable()->comment('Apakah Produk yang dihasilkan sudah mempunyai Merkyang terdaftar di Kementerian Hukum dan HAM');
            $table->string('i_12_a')->nullable()->comment('Nomor Registrasi Merk');
            $table->string('i_13')->nullable()->comment('Apabila produk Saudara sudah mempunyai ijin edar?');
            $table->string('i_13_a')->nullable()->comment('Keterangan lain jika sudah mempunyai ijin edar');
            $table->string('i_14')->nullable()->comment('Berapakah rata-rata pertahun volume produksi untuk produk utama yang Saudara');
            $table->string('i_15')->nullable()->comment('Berapakah rata-rata pertahun nilai produksi untuk produk utama yang Saudara hasilkan:');
            $table->string('i_16')->nullable()->comment('Mohon disebutkan area pemasaran untuk produk Saudara:');
            $table->string('jenis_umk')->nullable();
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
        Schema::dropIfExists('kuesioner_bagian_satu_repos');
    }
}
