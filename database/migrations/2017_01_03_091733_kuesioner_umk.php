<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KuesionerUmk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuesioner_umk', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_input',50)->nullable();
            $table->string('kode',10)->nullable();
            $table->string('nomor_kuesioner',10)->nullable();
            $table->string('nomor_bsn',20)->nullable();
            $table->string('nama_surveyor',100)->nullable();
            $table->date('tgl_survey')->nullable();
            $table->string('propinsi',50)->nullable();
            $table->string('i_1',120)->nullable()->comment('Nama UMKM');
            $table->string('i_2',120)->nullable()->comment('Nama Pemilik');
            $table->string('i_3',200)->nullable()->comment('Alamat Perusahaan');
            $table->string('i_4',100)->nullable()->comment('No HP/Telepon');
            $table->string('i_5',200)->nullable()->comment('Alamat E-mail');
            $table->string('i_6',120)->nullable()->comment('Alamat Website');
            $table->string('i_7',10)->nullable()->comment('Jumlah Karyawan');
            $table->string('i_8',1)->nullable()->comment('Dalam melakukan proses usahanya, sudah dilakukan pembagian pekerjaan untuk masing-masing karyawan (Seperti bagian administrasi, produksi, pemasaran, dll) ');
            $table->string('i_9',1)->nullable()->comment('Apakah UMKM sudah mempunyai legalitas usaha');
            $table->string('i_10',100)->nullable()->comment('Apabila jabawan butir b sudah, legalitas yang dimiliki berupa');
            $table->string('i_10_a',100)->nullable()->comment('Nomor Registrasi TDP/IUI/Lainnya');
            $table->string('i_10_b',100)->nullable()->comment('Lampiran Copy TDP/IUI/Lainnya');
            $table->string('i_11',200)->nullable()->comment('Sebutkan produk yang dihasilkan oleh UMKM Saudara, dan sebutkan mana yang merupakan produk utama? ');
            $table->string('i_11_a',200)->nullable()->comment('Lampiran foto Produk');
            $table->string('i_12',1)->nullable()->comment('Apakah Produk yang dihasilkan sudah mempunyai Merkyang terdaftar di Kementerian Hukum dan HAM');
            $table->string('i_12_a',200)->nullable()->comment('Nomor Registrasi Merk');
            $table->string('i_13',1)->nullable()->comment('Apabila produk Saudara sudah mempunyai ijin edar?');
            $table->string('i_13_a')->nullable()->comment('Keterangan lain jika sudah mempunyai ijin edar');
            $table->string('i_14',120)->nullable()->comment('Berapakah rata-rata pertahun volume produksi untuk produk utama yang Saudara');
            $table->string('i_15',120)->nullable()->comment('Berapakah rata-rata pertahun nilai produksi untuk produk utama yang Saudara hasilkan:');
            $table->string('i_16',250)->nullable()->comment('Mohon disebutkan area pemasaran untuk produk Saudara:');
            $table->string('jenis_umk',1)->nullable();

            $table->string('ii_1',1)->nullable()->comment('');
            $table->string('ii_1_a',200)->nullable()->comment('');
            $table->string('ii_2',1)->nullable()->comment('');
            $table->string('ii_2_a',200)->nullable()->comment('');
            $table->string('ii_3',1)->nullable()->comment('');
            $table->string('ii_3_a',1)->nullable()->comment('');
            $table->string('ii_3_b',1)->nullable()->comment('');
            $table->string('ii_3_c',1)->nullable()->comment('');
            $table->string('ii_3_d',1)->nullable()->comment('');
            $table->string('ii_3_e',1)->nullable()->comment('');
            $table->string('ii_3_e_a',200)->nullable()->comment('');
            $table->string('ii_4',1)->nullable()->comment('');
            $table->string('ii_5',600)->nullable()->comment('');
            $table->string('ii_6',1)->nullable()->comment('');
            $table->string('ii_6_a',100)->nullable()->comment('');
            $table->string('ii_7_a',1)->nullable()->comment('');
            $table->string('ii_7_b',1)->nullable()->comment('');
            $table->string('ii_7_c',1)->nullable()->comment('');
            $table->string('ii_7_d',100)->nullable()->comment('');
            $table->string('ii_7_d_a',200)->nullable()->comment('');
            $table->string('ii_7_e_a',200)->nullable()->comment('');
            $table->string('ii_7_e_b',200)->nullable()->comment('');
            $table->string('ii_8',1)->nullable()->comment('');
            $table->string('ii_8_a',20)->nullable()->comment('');
            $table->string('ii_8_b',120)->nullable()->comment('');
            $table->string('ii_8_c',100)->nullable()->comment('');
            $table->string('ii_9',1)->nullable()->comment('');
            $table->string('ii_9_a',500)->nullable()->comment('');
            $table->string('jumlah_umk_bersertifikat',500)->nullable()->comment('');


            $table->string('iii_1',1)->nullable()
            ->comment('Apakah Saudara sudah pernah mendapatkan informasi mengenai Standar Nasional Indonesia (SNI)?');
            $table->string('iii_2_a',1)->nullable()
            ->comment('Jika No. 1 jawaban Saudara Sudah, dari mana Saudara mendapatkan informasi tentang SNI tersebut? Internet');
            $table->string('iii_2_b',1)->nullable()
            ->comment('Jika No. 1 jawaban Saudara Sudah, dari mana Saudara mendapatkan informasi tentang SNI tersebut? Layanan');
            $table->string('iii_2_c',120)->nullable()->comment('');
            $table->string('iii_2_c_a',200)->nullable()->comment('');
            $table->string('iii_2_d',1)->nullable()->comment('');
            $table->string('iii_2_d_a',200)->nullable()->comment('');
            $table->string('iii_2_e',100)->nullable()->comment('');
            $table->string('iii_2_e_a',200)->nullable()->comment('');
            $table->string('iii_3',1)->nullable()->comment('');
            $table->string('iii_4',1)->nullable()->comment('');
            $table->string('iii_5_a',1)->nullable()->comment('');
            $table->string('iii_5_b',1)->nullable()->comment('');
            $table->string('iii_5_c',1)->nullable()->comment('');
            $table->string('iii_5_c_a',200)->nullable()->comment('');
            $table->string('iii_5_d',1)->nullable()->comment('');
            $table->string('iii_5_d_a',200)->nullable()->comment('');
            $table->string('iii_6',1)->nullable()->comment('');
            $table->string('iii_7',1)->nullable()->comment('');
            
            $table->string('iii_8',500)->nullable()->comment('');
            $table->string('iii_8_a',1)->nullable()->comment('');
            $table->string('iii_8_b',1)->nullable()->comment('');
            $table->string('iii_8_c',1)->nullable()->comment('');
            $table->string('iii_8_d',100)->nullable()->comment('');
            $table->string('iii_8_d_a',200)->nullable()->comment('');
            $table->string('iii_9',1)->nullable()->comment('');
            $table->string('iii_9_a',500)->nullable()->comment('');
            $table->string('iii_10_a',1)->nullable()->comment('');
            $table->string('iii_10_b',1)->nullable()->comment('');
            $table->string('iii_10_c',1)->nullable()->comment('');
            $table->string('iii_10_d',1)->nullable()->comment('');
            $table->string('iii_10_d_a',200)->nullable()->comment('');

            $table->string('iii_11_a',1)->nullable()->comment('');
            $table->string('iii_11_b',1)->nullable()->comment('');
            $table->string('iii_11_c',1)->nullable()->comment('');
            $table->string('iii_11_d',1)->nullable()->comment('');
            $table->string('iii_11_e',1)->nullable()->comment('');
            $table->string('iii_11_f',1)->nullable()->comment('');
            $table->string('iii_11_f_a',200)->nullable()->comment('');

            $table->text('iv_1')->comment('Masukan untuk BSN')->nullable();
            
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
        Schema::dropIfExists('kuesioner_umk');
    }
}
