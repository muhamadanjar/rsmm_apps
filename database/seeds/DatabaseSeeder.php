<?php

use Illuminate\Database\Seeder;
use App\KriteriaPenilaian;
use App\KriteriaNilai;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // Basic roles data
        $this->call(UsersSeeder::class);

        $kriteria = KriteriaPenilaian::insert([
            ['kriteria' => 'KEJUJURAN','nilai' => 0],
            ['kriteria' => 'LOYALITAS','nilai' => 0],
            ['kriteria' => 'KREATIVITAS & KECERDASAN','nilai' => 0],
            ['kriteria' => 'WAWASAN','nilai' => 0],
            ['kriteria' => 'BERANI MENGAMBIL KEPUTUSAN','nilai' => 0],
            ['kriteria' => 'BERPIKIR & BERTINDAK SISTEMATIS','nilai' => 0],
            ['kriteria' => 'KETEGASAN','nilai' => 0],
            ['kriteria' => 'D I S I P L I N','nilai' => 0],
            ['kriteria' => 'CEKATAN / GESIT','nilai' => 0],
            ['kriteria' => 'PEDULI & RESPONSIF','nilai' => 0],
            ['kriteria' => 'TIDAK SUKA MENUNDA WAKTU','nilai' => 0],
            ['kriteria' => 'KETELITIAN DALAM BEKERJA','nilai' => 0],
        ]);
       

        $nilai = KriteriaNilai::insert([
            ['kode' => 'BS','ket' => 'Bagus Sekali','nilai' => 5],
            ['kode' => 'B','ket' => 'Bagus','nilai' => 4],
            ['kode' => 'C','ket' => 'Cukup','nilai' => 3],
            ['kode' => 'K','ket' => 'Kurang','nilai' => 2],
            ['kode' => 'KS','ket' => 'Kurang Sekali','nilai' => 1]
        ]);



    }
}
