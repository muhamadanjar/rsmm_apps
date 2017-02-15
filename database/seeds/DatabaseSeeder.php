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
        App\Role::insert([
            ['name' => 'admin'],
            ['name' => 'manager'],
            ['name' => 'karyawan'],
        ]);
    
        // Basic permissions data
        App\Permission::insert([
            ['name' => 'access.backend'],
            
            ['name' => 'create.user'],
            ['name' => 'edit.user'],
            ['name' => 'delete.user'],

            ['name' => 'create.rencanakerja'],
            ['name' => 'edit.rencanakerja'],
            ['name' => 'delete.rencanakerja'],

            ['name' => 'create.aktifitaskerja'],
            ['name' => 'edit.aktifitaskerja'],
            ['name' => 'delete.aktifitaskerja'],
        ]);
    
        // Add a permission to a role
        $role = App\Role::where('name', 'admin')->first();
        $role->addPermission('access.backend');
        $role->addPermission('create.user');
        $role->addPermission('edit.user');    
        $role->addPermission('delete.user');
        // ... Add other role permission if necessary
    
        // Create a user, and give roles
        $user = App\User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'name' => 'Admin Aja',
            'password' => bcrypt('password'),
            'isactive' => 1,
        ]);
        $user->assignRole('admin');

        $user1 = App\User::create([
            'username' => 'fauzankamil',
            'email' => 'fzn.aidiel@gmail.com',
            'name' => 'Fauzan Kamil',
            'password' => bcrypt('fauzankamil'),
        ]);
        $user1->assignRole('karyawan');


        /*$user1 = App\User::create([
            'username' => 'fauzankamil',
            'email' => 'fzn.aidiel@gmail.com',
            'name' => 'Fauzan Kamil',
            'password' => bcrypt('fauzankamil'),
        ]);
        $user1->assignRole('karyawan');

        $user2 = App\User::create([
            'username' => 'restu',
            'email' => 'dcrestu@gmail.com',
            'name' => 'Restu DC',
            'password' => bcrypt('restu'),
        ]);
        $user2->assignRole('karyawan');

        $user2 = App\User::create([
            'username' => 'muhamadanjar',
            'email' => 'arvanria@gmail.com',
            'name' => 'Muhamad Anjar',
            'password' => bcrypt('password'),
        ]);
        $user2->assignRole('karyawan');

        $user3 = App\User::create([
            'username' => 'yuliyati',
            'email' => 'uwiyuli37@gmail.com',
            'name' => 'Yuliyati',
            'password' => bcrypt('yuliyati'),
        ]);
        $user3->assignRole('karyawan');*/


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
